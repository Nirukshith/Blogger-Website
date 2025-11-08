<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/users.php"); 
adminOnly(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Section - Edit Users</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>

    <!-- font awesome-->
    <script src="https://kit.fontawesome.com/1350ce7307.js" crossorigin="anonymous"></script>

    <!-- font -->

    <!-- Google Fonts: preconnect + stylesheet -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Lato:wght@300;400;700&family=Bebas+Neue&family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">

    <!-- custom styling -->
    <link rel="stylesheet" href="../../assets/css/style.css">

    <!-- admin styling -->
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>

<body>
    <!-- Admin header here -->
    <?php include(ROOT_PATH . "/app/includes/adminHeader.php"); ?>
    <!--Admin page wrapper -->
    <div class="admin-wrapper">

        <!-- left sidebar -->
        <?php include(ROOT_PATH . "/app/includes/adminSidebar.php"); ?>
        <!-- //left sidebar -->


        <!-- Admin content -->
        <div class="admin-content">
            <div class="button-group">
                <a href="create.php" class="btn btn-big">Add User</a>
                <a href="index.php" class="btn btn-big">Manage Users</a>
            </div>

            <div class="content">
                <h2 class="page-title">Edit Users</h2>

                <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

                <form action="edit.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>">

                    <div>
                        <label>Username</label>
                        <input type="text" name="username" value="<?php echo $username;?>" class="text-input">
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo $email;?>" class="text-input">
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="password" value="<?php echo $password;?>" class="text-input">
                    </div>
                    <div>
                        <label>Confirm Password</label>
                        <input type="password" name="passwordConf" value="<?php echo $passwordConf; ?>" class="text-input">
                    </div>
                    <div>
                        <?php if (isset($admin) && $admin == 1  ) : ?>
                            <label>
                            <input type="checkbox" name="admin" checked>
                            Admin
                            </label>
                        <?php else : ?>
                            <label>
                            <input type="checkbox" name="admin">
                            Admin
                            </label>
                        <?php endif; ?>
                    </div>

                    <div>
                        <button type="submit" name="update-user" class="btn btn-big">Update User</button>
                    </div>
                </form>
            </div>

        </div>
        <!-- //Admin content -->




    </div>
    <!-- //Admin page wrapper -->


    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- ckEditor -->
    <script>
        ClassicEditor
            .create(document.querySelector("#body"), {
                toolbar: [
                    'heading', '|', 'bold', 'italic', 'fontSize', 'fontFamily', 'fontColor',
                    '|', 'link', 'bulletedList', 'numberedList', 'blockQuote'
                ]
            })
            .catch(error => console.error(error));
    </script>

    <!-- script -->
    <script src="../../assets/js/script.js"></script>

</body>

</html>