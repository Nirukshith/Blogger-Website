<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validateTopic.php");


function checkTopicOwnership($topic_id) {
    global $table; // 'topics'
    $topic_to_check = selectOne($table, ['id' => $topic_id]);
    
    // Block if the user is NOT an admin AND they don't own the topic
    if (!$_SESSION['admin'] && (!$topic_to_check || $topic_to_check['user_id'] != $_SESSION['id'])) {
        $_SESSION['message'] = 'You can only modify your own topics.';
        $_SESSION['type'] = 'error';
        header('Location: ' . BASE_URL . '/admin/topics/index.php');
        exit(0);
    }
}

$table = 'topics';

$errors = array();
$id = '';
$name = '';
$description = '';

$topics = selectAll('topics');

if (isset($_POST['add-topic'])) {
    usersOnly(); 
    $errors = validateTopic($_POST);

    if (count($errors) === 0) {

        unset($_POST['add-topic']);
        $_POST['user_id'] = $_SESSION['id'];
        $topic_id = create('topics', $_POST);
        if ($topic_id) {
            $_SESSION['message'] = "Topic created successfully";
            $_SESSION['type'] = "success";
            header('Location: ' . BASE_URL . '/admin/topics/index.php');
            exit();
        } else {
            $errors = "Failed to create topic";
        }
    } else {
        $name = $_POST['name'];
        $description = $_POST['description'];
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $topic = selectOne($table, ['id' => $id]);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}

if (isset($_GET['del_id'])) {
    usersOnly(); 
    $id = $_GET['del_id'];

    checkTopicOwnership($id);  // Check before deleting

    $count = delete($table, $id);
    if ($count) {
        $_SESSION['message'] = "Topic deleted successfully";
        $_SESSION['type'] = "success";
        header('Location: ' . BASE_URL . '/admin/topics/index.php');
        exit();
    } else {
        $errors = "Failed to delete topic";
    }
}

if (isset($_POST['update-topic'])) {
    usersOnly(); 
    $errors = validateTopic($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];

        checkTopicOwnership($id); // Check before updating

        unset($_POST['update-topic'], $_POST['id']);
        $topic_id = update($table, $id, $_POST);
        if ($topic_id) {
            $_SESSION['message'] = "Topic updated successfully";
            $_SESSION['type'] = "success";
            header('Location: ' . BASE_URL . '/admin/topics/index.php');
            exit();
        } else {
            $errors = "Failed to update topic";
        }
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
    }
}
