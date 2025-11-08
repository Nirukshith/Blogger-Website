<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validatePosts.php");

$table ='posts';

$topics =  selectAll('topics');
// $posts =  selectAll($table);
$posts =  getAdminAllPosts();

$errors = array();
$id = '';
$title = '';
$body = '';
$topic_id = '';
$published = '';

    if(isset($_GET['id'])) {
        $post = selectOne($table, ['id' => $_GET['id']]);
        
        $id = $post['id'];
        $title = $post['title'];
        $body = $post['body'];
        $topic_id = $post['topic_id'];
        $published = $post['published'];
    }

    if(isset($_GET['delete_id'])) {
        usersOnly(); 

        $delete_id = $_GET['delete_id'];

        // Check ownership - allow if user owns the post OR is an admin
        $post_to_delete = selectOne($table, ['id' => $delete_id]);
        $is_admin = isset($_SESSION['admin']) && $_SESSION['admin'] == 1;
        if ($post_to_delete['user_id'] != $_SESSION['id'] && !$is_admin) {
            $_SESSION['message'] = 'You can only delete your own posts.';
            $_SESSION['type'] = 'error';
            header('Location: ' . BASE_URL . '/admin/posts/index.php');
            exit();
        }

        $count = delete($table, $_GET['delete_id']);
        if($count) {
            $_SESSION['message'] = "Post deleted successfully";
            $_SESSION['type'] = "success";
            header('Location: ' . BASE_URL . '/admin/posts/index.php');
            exit();
        }
        else {
            $errors = "Failed to delete post";
        }
    }

    if(isset($_GET['published']) && isset($_GET['p_id'])) {
        usersOnly(); 
        $published = $_GET['published'];
        $p_id = $_GET['p_id'];

        $count = update($table, $p_id, ['published' => $published]);
        if($count) {
            $_SESSION['message'] = "Post published status changed";
            $_SESSION['type'] = "success";
            header('Location: ' . BASE_URL . '/admin/posts/index.php');
            exit();
        }
        else {
            $errors = "Failed to change published status";
        }
    }


    if (isset($_POST['add-post'])) { 
        usersOnly(); 
        $errors = validatePost($_POST); 

    if(!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/images/" . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
            $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Failed to upload image");
        }
    }
    else {
        array_push($errors, "Image is required");
    }



    if(count($errors) === 0){ 
        unset($_POST['add-post']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities ($_POST['body']);

        $post_id = create($table, $_POST);
        $_SESSION['message'] = "Post created successfully";
        $_SESSION['type'] = "success";
        header('Location: ' . BASE_URL . '/admin/posts/index.php');
        exit();
    }
    else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $published = isset($_POST['published']) ? 1 : 0;
    }
}

    if(isset($_POST['update-post'])) {
        usersOnly(); 
        $errors = validatePost($_POST);

    // Check ownership - allow if user owns the post OR is an admin
        $post_to_update = selectOne($table, ['id' => $_POST['id']]);
        $is_admin = isset($_SESSION['admin']) && $_SESSION['admin'] == 1;
        if ($post_to_update['user_id'] != $_SESSION['id'] && !$is_admin) {
            $_SESSION['message'] = 'You can only edit your own posts.';
            $_SESSION['type'] = 'error';
            header('Location: ' . BASE_URL . '/admin/posts/index.php');
            exit();
        }

    if(!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/images/" . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
            $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Failed to upload image");
        }
    }
    else {
        $_POST['image'] = selectOne($table, ['id' => $_POST['id']])['image'];
    }


    if(count($errors) === 0){  
        $id = $_POST['id'];
        unset($_POST['update-post'], $_POST['id']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities ($_POST['body']);

        $post_id = update($table, $id, $_POST);
        $_SESSION['message'] = "Post updated successfully";
        $_SESSION['type'] = "success";
        header('Location: ' . BASE_URL . '/admin/posts/index.php');
    }
    else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $published = isset($_POST['published']) ? 1 : 0;
    }


}



