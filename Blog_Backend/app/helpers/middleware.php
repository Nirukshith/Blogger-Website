<?php

function usersOnly($redirect = '/index.php')
{
    if (empty($_SESSION['id'])) {
        $_SESSION['message'] = 'You must be logged in to access that page';
        $_SESSION['type'] = 'error';
        header('Location: ' . BASE_URL . $redirect);
        exit(0);
    }
}

function adminOnly($redirect = '/index.php')
{
    if (empty($_SESSION['id']) || empty($_SESSION['admin'])) {
        $_SESSION['message'] = 'You must be an admin to access that page';
        $_SESSION['type'] = 'error';
        header('Location: ' . BASE_URL . $redirect);
        exit(0);
    }
}

function guestOnly($redirect = '/index.php')
{
    if (isset($_SESSION['id'])) {
        header('Location: ' . BASE_URL . $redirect);
        exit(0);
    }
}