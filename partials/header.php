<?php 
    require_once __DIR__ . "/../process/loadsession.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/QuestBankManagerWeb/res/css/header.css">
</head>
<body>
    <div class="header-container">
        <div class="header-left">
            <h1>Hệ thống quản lý ngân hàng câu hỏi</h1>
        </div>
        <div class="header-right">
            <label for=""><?php echo $_SESSION['Username']?></label>
            <a href="#">Đăng xuất</a>
        </div>
    </div>
</body>
</html>