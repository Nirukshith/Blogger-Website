<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include("../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/posts.php");
usersOnly(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Section - Dashboard</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>

    <!-- font awesome-->
    <script src="https://kit.fontawesome.com/1350ce7307.js" crossorigin="anonymous"></script>

    <!-- font -->

    <!-- Google Fonts: preconnect + stylesheet -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Lato:wght@300;400;700&family=Bebas+Neue&family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">

    <!-- custom styling -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- admin styling -->
    <link rel="stylesheet" href="../assets/css/admin.css">
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

            <div class="content">
                    <h2 class="page-title">Dashboard</h2> 

                    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

                    <?php
                // --- 1. DATA CALCULATION ---
                // This assumes $posts and $topics are available from the included posts.php controller.
                
                // Filter $posts to only include the current user's posts
                $my_posts = array_filter($posts, function($post) {
                    return $post['user_id'] == $_SESSION['id'];
                });

                $my_total_posts = count($my_posts);
                $my_published_posts = count(array_filter($my_posts, function($post) {
                    return $post['published'] == 1;
                }));
                $total_topics = count($topics);
                // ---------------------------
                ?>

                <div class="dashboard-metrics">
                    
                    <div class="metric-card total">
                        <i class="fas fa-file-alt"></i>
                        <h3><?php echo $my_total_posts; ?></h3>
                        <p>Your Total Posts</p>
                        <a href="<?php echo BASE_URL . '/admin/posts/index.php'; ?>">View All &rarr;</a>
                    </div>

                    <div class="metric-card published">
                        <i class="fas fa-check-circle"></i>
                        <h3><?php echo $my_published_posts; ?></h3>
                        <p>Published Posts</p>
                    </div>

                    <div class="metric-card draft">
                        <i class="fas fa-edit"></i>
                        <h3><?php echo $my_total_posts - $my_published_posts; ?></h3>
                        <p>Draft Posts</p>
                    </div>

                    <div class="metric-card topics">
                        <i class="fas fa-tags"></i>
                        <h3><?php echo $total_topics; ?></h3>
                        <p>Available Topics</p>
                        <a href="<?php echo BASE_URL . '/admin/topics/index.php'; ?>">Manage Topics &rarr;</a>
                    </div>
                </div>
                
                <div class="dashboard-activity">
                    <h3>Quick Actions</h3>
                    <div class="quick-links">
                        <a href="<?php echo BASE_URL . '/admin/posts/create.php'; ?>" class="btn btn-big quick-add-post">
                            <i class="fas fa-plus"></i> Create New Post
                        </a>
                        <a href="<?php echo BASE_URL . '/admin/posts/index.php'; ?>" class="btn btn-big quick-view-all">
                            <i class="fas fa-list"></i> Manage All Posts
                        </a>
                    </div>
                </div>

                    
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
    <script src="../assets/js/script.js"></script>

</body>

</html>