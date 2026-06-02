<?php
// Copy this file to mail-config.php and fill in your real credentials.
// mail-config.php is gitignored so secrets don't end up in the repo.

return [
    // Gmail account used to SEND mail (login on Google's SMTP server).
    // For Gmail you MUST create an "App password" (see: https://myaccount.google.com/apppasswords).
    // Your normal Gmail password will NOT work.
    'smtp_user'     => 'your-sender@gmail.com',
    'smtp_pass'     => 'uzfc dldq ovck zyrf', // 16-char Gmail app password

    // Where form submissions get delivered.
    'mail_to'       => 'mahmous2234@gmail.com',
    'mail_to_name'  => 'missKARIN',

    // What appears in the "From:" header. With Gmail SMTP this MUST equal smtp_user
    // (or an alias added to that Google account), otherwise Gmail rewrites it.
    'mail_from'     => 'your-sender@gmail.com',
    'mail_from_name'=> 'missKARIN Aanmeldformulier',
];
