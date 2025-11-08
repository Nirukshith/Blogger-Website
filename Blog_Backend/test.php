<?php
function dd($value)
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";
    die();
}

if (isset($_POST['login-btn'])) {
    dd($_POST);
}
?>

<form action="" method="POST">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <button type="submit" name="login-btn">Login</button>
</form>