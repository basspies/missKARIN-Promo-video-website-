# missKARIN — Website

Built with **PHP + MySQL**, runs on **XAMPP**. The course list on the homepage
comes from the database, and the signup form emails each submission to us.

## What you need

- [XAMPP](https://www.apachefriends.org/) (gives you Apache + MySQL + PHP 8.2)
- [Composer](https://getcomposer.org/) (to install the mail library)
- A Gmail account + an **app password** (only needed if you want the contact form to send mail)

## Setup

### 1. Put the project in htdocs
Clone or copy this folder into your XAMPP `htdocs`, for example:
```
C:\xampp\htdocs\Web\missKARIN
```

### 2. Install the dependencies
The `vendor/` folder is **not** in git, so you have to install it yourself.
Open a terminal in the project folder and run:
```
composer install
```
This downloads PHPMailer (used to send the emails).

### 3. Import the database
1. Start **Apache** and **MySQL** in the XAMPP control panel.
2. Open phpMyAdmin: http://localhost/phpmyadmin
3. Create a new database called **`misskarin`**.
4. Select it, go to the **Import** tab, choose the file `assets/sql/misskarin.sql`, and click **Go**.

> The database login is the XAMPP default (user `root`, no password). If yours is
> different, change it in `assets/includes/conn.php`.

### 4. Set up the email config
The file with the real email password is **not** in git. Create your own:

1. Copy `assets/includes/mail-config.example.php` to `assets/includes/mail-config.php`
2. Open the new file and fill in your own Gmail address and app password:
   ```php
   'smtp_user' => 'your-account@gmail.com',
   'smtp_pass' => 'your 16-char app password',
   'mail_to'   => 'where-you-want-to-receive@gmail.com',
   'mail_from' => 'your-account@gmail.com',   // must be the same as smtp_user
   ```

**How to get a Gmail app password:**
- Turn on 2-Step Verification: https://myaccount.google.com/security
- Then create an app password: https://myaccount.google.com/apppasswords
- Use that 16-character code as `smtp_pass` (your normal Gmail password will NOT work).

### 5. Open the site
With Apache + MySQL running, go to:
```
http://localhost/Web/missKARIN/index.php
```
(Adjust the path if you put the folder somewhere else.)

## Project structure

```
index.php                  Homepage (course list is loaded from the database)
contact.php                Signup form + the JavaScript that sends it
submit.php                 Receives the form and sends the email (PHPMailer)
README.md                  This file

assets/
  css/
    style.css              Styles for the homepage
    contact.css            Styles for the contact form
  includes/
    conn.php               Database connection (PDO)
    mail-config.php         Email login  -> you create this, not in git
    mail-config.example.php Template for mail-config.php
  cms/
    cms.php                Simple dashboard that lists the courses
    delete.php             Delete a course
  sql/
    misskarin.sql          Database export (import this in phpMyAdmin)
  img/                     Images / logo

vendor/                    PHPMailer library  -> created by "composer install", not in git
```

These files are **ignored by git** on purpose, so every person sets them up locally:
- `vendor/` — run `composer install` to get it.
- `assets/includes/mail-config.php` — copy from the example and add your own password.
- `.claude/` — local editor settings.

Never commit `mail-config.php` — it holds a real password.
