<?php include("path.php") ?>
<?php include(ROOT_PATH . "/app/controllers/users.php");
    guestOnly(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <!-- font awesome-->
    <script src="https://kit.fontawesome.com/1350ce7307.js" crossorigin="anonymous"></script>

    <!-- font -->

    <!-- Google Fonts: preconnect + stylesheet -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Lato:wght@300;400;700&family=Bebas+Neue&family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Header Include -->
    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

    <div class="auth-content">
        <form action="login.php" class="post" method="post">
            <h2 class="form-title">Login</h2>

            <!-- <div class="msg error">
                <li>Username Required</li>
            </div> -->

            <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

            <div>


                <label class="label">Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>" class="text-input">
            </div>
            <div>
                <label class="label">Password</label>
                <input type="password" name="password" value="<?php echo $username; ?>" class="text-input">
            </div>
            <div>
                <button type="submit" name="login-btn" class="btn btn-big">Login</button>
            </div>
            <div>
                <p class="label">Or<a href="<?php echo BASE_URL . '/register.php' ?>"> Sign Up</a></p>
            </div>
        </form>

    </div>



    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="assets/js/script.js"></script>

</body>

</html>