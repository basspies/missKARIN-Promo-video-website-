<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

require __DIR__ . '/vendor/autoload.php';
$cfg = require __DIR__ . '/assets/includes/mail-config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$clean = function ($key) {
    return isset($_POST[$key]) ? trim((string)$_POST[$key]) : '';
};

$naam      = $clean('naam');
$email     = $clean('email');
$telefoon  = $clean('telefoon');
$straat    = $clean('straat');
$huisnr    = $clean('huisnummer');
$postcode  = $clean('postcode');
$plaats    = $clean('plaats');
$cursus    = $clean('cursus');
$bericht   = $clean('bericht');

if ($naam === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'Naam en een geldig e-mailadres zijn verplicht.']);
    exit;
}

$esc = fn($v) => htmlspecialchars($v, ENT_QUOTES, 'UTF-8');

$rows = [
    'Naam'         => $naam,
    'E-mail'       => $email,
    'Telefoon'     => $telefoon,
    'Adres'        => trim("$straat $huisnr"),
    'Postcode'     => $postcode,
    'Plaats'       => $plaats,
    'Cursus'       => $cursus,
    'Bericht'      => $bericht,
];

$htmlRows = '';
$textLines = [];
foreach ($rows as $label => $value) {
    $display = $value === '' ? '—' : $value;
    $htmlRows .= "<tr><td style='padding:6px 12px;background:#f4f4f4;font-weight:bold;vertical-align:top;'>"
              . $esc($label)
              . "</td><td style='padding:6px 12px;'>"
              . nl2br($esc($display))
              . "</td></tr>";
    $textLines[] = "$label: $display";
}

$html = "<h2 style='font-family:sans-serif;'>Nieuwe aanmelding via het formulier</h2>"
      . "<table style='border-collapse:collapse;font-family:sans-serif;font-size:14px;'>"
      . $htmlRows
      . "</table>";
$text = "Nieuwe aanmelding via het formulier\n\n" . implode("\n", $textLines);

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $cfg['smtp_user'];
    $mail->Password   = $cfg['smtp_pass'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom($cfg['mail_from'], $cfg['mail_from_name']);
    $mail->addAddress($cfg['mail_to'], $cfg['mail_to_name']);
    $mail->addReplyTo($email, $naam);

    $mail->isHTML(true);
    $mail->Subject = 'Nieuwe aanmelding: ' . $naam . ($cursus ? " ($cursus)" : '');
    $mail->Body    = $html;
    $mail->AltBody = $text;

    $mail->send();
    echo json_encode(['ok' => true]);
} catch (Exception $e) {
    error_log('Mail error: ' . $mail->ErrorInfo);
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Kon e-mail niet verzenden. Probeer het later opnieuw.']);
}
