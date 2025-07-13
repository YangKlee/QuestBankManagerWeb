<?php require "./partials/header.php";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        require "./model/questBankDAO.php";
        $bankDAO = new questBankDAO();
        $bankDAO->add($_POST['namebank'], $_POST['questlimit'], $_SESSION['UID']);
        header('Location: index.php');
        exit;
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm ngân hàng</title>
    <link rel="stylesheet" href="./res/css/reset.css">
    <link rel="stylesheet" href="./res/css/layout.css">
    <link rel="stylesheet" href="./res/css/addbank.css">
</head>

<body>
    
    <div class="main-container">
        <h1 class="title">Thêm ngân hàng</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="input-warpper title-bank">
                <label for="">Tên ngân hàng:</label>
                <input type="text" name="namebank" required>
            </div>
            <div class="input-warpper quest-limit">
                <label for="">Giới hạn câu hỏi (nhập 0 để không giới hạn)</label>
                <input type="number" name="questlimit" required>
            </div>
            <input class="function-button add" type="submit" value="Thêm">
            <a href="./index.php"><button class="function-button reject" type="button">Hủy</button></a>
        </form>
    </div>
</body>
</html>