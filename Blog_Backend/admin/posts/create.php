<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/posts.php");
usersOnly(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Section - Add Post</title>
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
                <a href="create.php" class="btn btn-big">Add Post</a>
                <a href="index.php" class="btn btn-big">Manage Posts</a>
            </div>

            <div class="content">
                <h2 class="page-title">Add Post</h2> 

                <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

                <form action="create.php" method="post" enctype="multipart/form-data">
                    <div>
                        <label>Title</label>
                        <input type="text" name="title" value="<?php echo $title ?>" class="text-input">
                    </div>
                    <div>
                        <label>Body</label>
                        <textarea id="body" name="body" class="text-input"  placeholder="Start writing here...">
                            <?php echo $body ?> 
                        </textarea>
                    </div>
                    <div>
                        <label>Image</label>
                        <input type="file" name="image" class="text-input">
                    </div>
                    <div>
                        <label>Topic</label>
                        <select name="topic_id" class="text-input">
                            <option value=""></option> 

                            <?php foreach ($topics as $key => $topic): ?>

                                <?php if (!empty($topic_id) && $topic_id == $topic['id'] ): ?>
                                    <option selected value="<?php echo $topic['id']; ?>"><?php echo $topic['name'];?>
                                </option>
                                <?php else: ?>
                                    <option value="<?php echo $topic['id']; ?>"><?php echo $topic['name']; ?></option>
                                <?php endif; ?> 
                            <?php endforeach; ?>
 
                        </select>
                    </div>
                    <div>
                        <?php if (empty($published)): ?>
                            <label>
                                <input type="checkbox" name="published">
                                Publish
                            </label>
                        <?php else: ?>
                            <label>
                                <input type="checkbox" name="published" checked>
                                Publish
                            </label>
                        <?php endif; ?>
                    </div>
                    <div>
                        <button type="submit" name="add-post" class="btn btn-big">Add Post</button>
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