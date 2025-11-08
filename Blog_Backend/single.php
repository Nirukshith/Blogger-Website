<?php include("path.php") ?>
<?php include(ROOT_PATH . "/app/controllers/posts.php"); 

if(isset($_GET['id'])){
$posts = selectOne('posts', ['id' => $_GET['id']]);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $posts['title']; ?> | Truman Writes </title>

    <!-- font awesome-->
    <script src="https://kit.fontawesome.com/1350ce7307.js" crossorigin="anonymous"></script>

    <!-- font -->


    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="../Blog_Frontend/css/blog.css">
    <!-- Google Fonts: preconnect + stylesheet -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Lato:wght@300;400;700&family=Bebas+Neue&family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Header Include -->
    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

    <!-- page wrapper -->
    <div class="page-wrapper">


        <!-- content -->
        <div class="content cleanfix">

            <!-- main content -->
            <div class="main-content single">
                <h1 class="post-title"><?php echo $posts['title']; ?></h1>

                <div class="post-content">
                    <?php echo html_entity_decode($posts['body']); ?>
                </div>
            </div>
            <!-- //main content -->

            <!--side bar -->
            <div class="sidebar single">

                <div class="section topics">
                    <h2 class="section-title">Topics</h2>
                    <ul>
                        <?php foreach ($topics as $topic): ?>
                            <li> <a href="<?php echo BASE_URL. '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <!--side bar -->





        </div>
        <!-- // content -->

    </div>
    <!-- //page wrapper -->






    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="assets/js/script.js"></script>

    <!-- slick caraousel -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

</body>

</html>