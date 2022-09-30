<?php
session_start();
$_SESSION['token'] = md5(uniqid(mt_rand(), true));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>X-CSRFToken</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/htmx.org@1.8.0"></script>
</head>
<!-- <body hx-headers='{"X-CSRFToken": "< ?php echo $_SESSION['token'] ?>"}'> -->
<body>



<script>
document.body.addEventListener('htmx:configRequest', function(evt) {
    evt.detail.parameters['auth_token'] = <?php echo $_SESSION['token'] ?>; // add a new parameter into the request
    evt.detail.headers['Authentication-Token'] = <?php echo $_SESSION['token'] ?>; // add a new header into the request
});
</script>
</body>
</html>
