<?php 
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idquest']) && isset($_GET['idbank']))
    {
        require_once "../model/questionDAO.php";
        $questDAO = new questionDAO();
        $questDAO->delete($_GET["idquest"], $_GET['idbank']);
        header("Location: ../listquestion.php?idbank=". $_SESSION['id_bank_view']);
        
    }
?>