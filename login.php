<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: assets/cms/cms.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'root') {
        $_SESSION['logged_in'] = true;
        header('Location: assets/cms/cms.php');
        exit;
    } else {
        $error = "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - missKARIN CMS</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .login-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: var(--gray);
            padding: 20px;
        }
        .login-box {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 400px;
        }
        .login-box h2 {
            text-align: center;
            margin-bottom: 24px;
            color: var(--dark);
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text);
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: 4px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.2s;
        }
        .form-group input:focus {
            border-color: var(--teal);
        }
        .error-msg {
            background: #ffe6e6;
            color: #d93025;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            text-align: center;
        }
        .btn-full {
            width: 100%;
            padding: 14px;
            font-size: 1rem;
            margin-top: 10px;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--teal);
            text-decoration: none;
            font-size: 0.9rem;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-box">
            <h2>CMS Login</h2>
            <?php if (!empty($error)): ?>
                <div class="error-msg"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label for="username">Gebruikersnaam</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Wachtwoord</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-full">Inloggen</button>
            </form>
            <a href="index.php" class="back-link">&larr; Terug naar website</a>
        </div>
    </div>
</body>
</html>
