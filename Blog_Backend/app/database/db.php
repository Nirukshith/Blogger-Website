<?php

session_start();
require('connect.php');

function dd($value)
{
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}

function executeQuery($sql, $data=[])
{
    global $conn;
    $stmt = $conn->prepare($sql);
    if(!empty($data)){
        $values = array_values($data);
        $types = str_repeat('s', count($values));
        $stmt->bind_param($types, ...$values);
    }

    $stmt->execute();
    return $stmt;
}


function selectALL($table, $conditions = [])
{
    global $conn; // use the $conn variable from connect.php
    $sql = "SELECT * FROM $table";

    if (empty($conditions)) {
        $stmt = $conn->prepare($sql); // prepare the SQL statement
        $stmt->execute(); // execute the query
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); // fetch all rows as associative arrays
        return $records; // return the result
    } else {
        // return records that match conditions
        // $sql = "SELECT * FROM $table where username='Nirukshith' AND admin=0";

        $i = 0;
        foreach ($conditions as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }
        $stmt = executeQuery($sql, $conditions); // store the returned statement
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
}

function selectOne($table, $conditions)
{
    global $conn; // use the $conn variable from connect.php
    $sql = "SELECT * FROM $table";
    // return records that match conditions
    // $sql = "SELECT * FROM $table where username='Nirukshith' AND admin=0";

    $i = 0;
    foreach ($conditions as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " WHERE $key=?";
        } else {
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }
    $sql = $sql . " LIMIT 1";
    $stmt = executeQuery($sql, $conditions); // store the returned statement
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
}

function create($table, $data)
{
    global $conn;
    // $sql = "CREATE users SET username=?, admin=?, email=?, password=?"
    $sql = "INSERT INTO $table SET ";

    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . "$key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }
    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $id;
}

function update($table, $id, $data)
{
    global $conn;
    // $sql = "UPDATE users SET username=?, admin=?, email=?, password=? WHERE id=?"
    $sql = "UPDATE $table SET ";

    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . "$key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $sql = $sql . " WHERE id=?";
    $data['id'] = $id;

    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $stmt->affected_rows;
}


function delete($table, $id)
{
    global $conn;
    $sql = "DELETE FROM $table WHERE id=?";
    $stmt = executeQuery($sql, ['id' => $id]);
    return $stmt->affected_rows;
}


// $id = delete('users', 24);
// dd($id);

function getPublishedPosts()
{
    global $conn;
    $sql = "SELECT p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=?";

    $stmt = executeQuery($sql, ['published' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

 function getPostsByTopicId($topic_id)
{
    global $conn;
    $sql = "SELECT p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=? AND p.topic_id=?";

     $stmt = executeQuery($sql, ['published' => 1, 'topic_id' => $topic_id]);
     $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
     return $records;

    $stmt = executeQuery($sql, ['published' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function searchPosts($term)
{
    $match = '%' . $term . '%';
    global $conn;
    $sql = "SELECT
            p.*, u.username
        FROM posts AS p 
        JOIN users AS u 
        ON p.user_id=u.id 
        WHERE p.published=?
        AND p.title LIKE ? OR p.body LIKE ?";

    $stmt = executeQuery($sql, ['published' => 1, 'title' => $match, 'body' => $match]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getAdminAllPosts()
{
    global $conn;
    // This query joins the posts table (p) with the users table (u) 
    // where p.user_id matches u.id, and selects all post columns (p.*) 
    // PLUS the user's username (u.username).
    $sql = "SELECT p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id ORDER BY p.created_at DESC";

    $stmt = executeQuery($sql);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}