<?php

/**
 * Example: Digistore24 IPN receiver for capturing/inspecting live IPNs.
 *
 * Receives IPN callbacks, stores the full payload (raw + parsed) for later
 * analysis, and always answers "OK" so Digistore24 considers the call a
 * success and does not retry.
 *
 * Stored payloads contain customer data, so they are written OUTSIDE the web
 * root (../ipn-logs). Adjust $logDir to a non-public directory on your server.
 *
 * Setup:
 * 1. Put this script somewhere reachable by Digistore24 (its own web root).
 * 2. Set IPN_PASSPHRASE to the passphrase configured in your Digistore24 IPN
 *    settings to record whether the signature is valid.
 * 3. Enter the script URL as the IPN URL in Digistore24 and trigger an order.
 */

declare(strict_types=1);

// --- Configuration ---------------------------------------------------------

// Your Digistore24 IPN passphrase. Leave empty to log without validating.
// The receiver never rejects a call based on the signature; it only records
// the result, so you can analyze even mismatching signatures.
const IPN_PASSPHRASE = '';

$logDir      = __DIR__ . '/../ipn-logs';            // keep this out of the web root
$libAutoload = __DIR__ . '/../vendor/autoload.php';

// --- Be a good IPN citizen: never abort, never crash -----------------------

ignore_user_abort(true);
@set_time_limit(60);

$record = [
    'received_at' => date('c'),
    'method'      => $_SERVER['REQUEST_METHOD'] ?? 'CLI',
    'remote_addr' => $_SERVER['REMOTE_ADDR'] ?? null,
    'user_agent'  => $_SERVER['HTTP_USER_AGENT'] ?? null,
    'query'       => $_GET,
    'post'        => $_POST,
    'raw_body'    => file_get_contents('php://input') ?: '',
    'parsed'      => null,
    'event'       => $_POST['event'] ?? ($_GET['event'] ?? null),
    'api_mode'    => $_POST['api_mode'] ?? ($_GET['api_mode'] ?? null),
    'signature'   => 'not-checked',
];

// --- Parse with the library (best effort) ----------------------------------

try {
    if (is_file($libAutoload)) {
        require_once $libAutoload;

        $data = $_POST ?: $_GET;

        if ($data !== []) {
            if (IPN_PASSPHRASE !== '') {
                try {
                    \GoSuccess\Digistore24\Ipn\Security\Signature::validateSignature(IPN_PASSPHRASE, $data);
                    $record['signature'] = 'valid';
                } catch (\Throwable $e) {
                    $record['signature'] = 'invalid: ' . $e->getMessage();
                }
            }

            $notification = \GoSuccess\Digistore24\Ipn\Notification::fromArray($data);
            $record['parsed']       = $notification->toArray();
            $record['event']        = $notification->event?->value ?? $record['event'];
            $record['api_mode']     = $notification->api_mode ?? $record['api_mode'];
            $record['is_test_mode'] = $notification->isTestMode();
        }
    } else {
        $record['parse_error'] = 'library autoload not found at ' . $libAutoload;
    }
} catch (\Throwable $e) {
    $record['parse_error'] = $e->getMessage();
}

// --- Persist for analysis --------------------------------------------------

try {
    if (!is_dir($logDir)) {
        @mkdir($logDir, 0700, true);
    }

    $event = preg_replace('/[^a-zA-Z0-9_-]/', '', (string) ($record['event'] ?? 'unknown')) ?: 'unknown';
    $stamp = date('Ymd_His') . '_' . substr((string) microtime(true), -4);

    file_put_contents(
        "{$logDir}/ipn_{$stamp}_{$event}.json",
        json_encode($record, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    );

    file_put_contents(
        "{$logDir}/ipn.jsonl",
        json_encode($record, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n",
        FILE_APPEND
    );
} catch (\Throwable $e) {
    error_log('IPN receiver: failed to persist payload: ' . $e->getMessage());
}

// --- Always acknowledge ----------------------------------------------------

header('Content-Type: text/plain');
echo 'OK';
