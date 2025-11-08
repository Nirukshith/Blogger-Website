<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); ?>

<?php
include("path.php");
include(ROOT_PATH . "/app/controllers/topics.php");

$posts = array();
$postsTitle = 'Recent Posts';

if(isset($_GET['t_id'])) {
    $posts = getPostsByTopicId($_GET['t_id']);
    // $topic = selectOne('topics', ['id' => $_GET['t_id']]);
    $postsTitle = "You searched for posts under '" . $_GET['name'] . "'";
}
elseif(isset($_POST['search-term'])) {
    $postsTitle = "You searched for '" . $_POST['search-term'] . "'";
    $posts = searchPosts($_POST['search-term']);
}
else{
    $posts = getPublishedPosts();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog</title>

    <!-- font awesome-->
    <script src="https://kit.fontawesome.com/1350ce7307.js" crossorigin="anonymous"></script>


    <!-- custom styling -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- frontend footer/blog styles (fixed path & single include) -->
    <link rel="stylesheet" href="../Blog_Frontend/css/blog.css">


    <!-- font -->

    <!-- Google Fonts: preconnect + stylesheet -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Lato:wght@300;400;700&family=Bebas+Neue&family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/blog.css">
</head>

<body>
    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>
    <!-- page wrapper -->
    <div class="page-wrapper">

        <!-- post slider -->
        <div class="post-slider">
            <h1 class="slider-title" style="color: rgb(103, 103, 103);">Trending Posts</h1>
            <i class="fas fa-chevron-left prev"></i>
            <i class="fas fa-chevron-right next"></i>

            <div class="post-wrapper">

            <?php foreach ($posts as $post): ?>             
                <div class="post">
                    <img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="" class="slider-image">
                    <div class="post-info">
                        <h4><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h4>
                        <i class="far fa-user"> </i> <?php echo $post['username'];?>
                        &nbsp;
                        <i class="far fa-calendar"></i> <?php echo date('F j, Y', strtotime($post['created_at'])); ?>
                    </div>
                </div>
            <?php endforeach; ?> 

            </div>

        </div>
        <!-- //post slider -->

        <!-- content -->
        <div class="content cleanfix">
            <!-- main content -->
            <div class="main-content">
                <h1 class="recent-post-title" style="color: rgb(103, 103, 103)"> <?php echo $postsTitle ?></h1>

                <?php foreach ($posts as $post): ?>
                    <div class="post">
                        <img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" class="post-image"  alt="">
                        <div class="post-preview">
                            <h2><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
                            <i class="far fa-user"></i>   <?php echo $post['username'];?>
                            &nbsp;
                            <i class="far fa-calendar"></i>  <?php echo date('F j, Y', strtotime($post['created_at'])); ?>
                            <p class="preview-text">
                                <?php echo html_entity_decode(substr($post['body'], 0, 150) . '...'); ?>
                            </p>
                            <a href="single.php?id=<?php echo $post['id']; ?>" class="btn read-more">Read More</a>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <!-- // main content -->

            <!-- sidebar -->
            <div class="sidebar">
                <div class="section search">
                    <h2 class="section-title">Search</h2>
                    <form action="index.php" method="post">
                        <input type="text" name="search-term" class="text-input" placeholder="search..">
                    </form>
                </div>

                <div class="section topics">
                    <h2 class="section-title">Topics</h2>
                    <ul>
                        <?php foreach ($topics as $key => $topic) : ?>
                            <li> <a href="<?php echo BASE_URL. '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?> </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <!-- //sidebar -->




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