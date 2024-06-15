<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/main.css">
    <script src="public/scripts/mobile-nav.js" defer></script>
    <title><?= $title; ?></title>
</head>

<body class="flex-column-center-center">
    <form action="/main" method="POST" class="loginForm flex-column-center-center">
        <input type="text" name="username" placeholder="username or email"></input>
        <input type="password" name="password" placeholder="password"></input>
        <label><?= $message; ?></label>
        <div class="loginForm flex-row-center-center">
            <button name="login" value="login" type="submit">Log in</button>
            <button name="signup" value="signup" type="submit">Sign up</button>
        </div>
    </form>
</body>
</html>