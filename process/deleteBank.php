<?php 
    if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idbank']))
    {
        require_once "../model/questBankDAO.php";
        $bank = new questBankDAO();
        $bank->delete($_GET["idbank"]);
        header("Location: ../index.php");
        
    }
?>