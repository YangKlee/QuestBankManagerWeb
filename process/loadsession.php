<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if(!isset($_SESSION['UID']))
    {

        header("Location: login.php");
        exit;
    }
    else
    {
        require_once __DIR__ ."/../model/userDAO.php";
        $userDAO = new UserDAO();

        $userData = $userDAO->getUser($_SESSION['UID']);
        $_SESSION['Username'] = $userData['UserName'];
        $_SESSION['Role'] = $userData['role'];
    }
?>