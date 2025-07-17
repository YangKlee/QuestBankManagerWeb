<?php 
    require_once __DIR__ . "/../process/loadsession.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./res/css/header.css">
</head>
<body>
    <div class="header-container">
        <div class="header-left">
            <h1><a href="index.php" style="text-decoration: none; color: inherit;">Hệ thống quản lý ngân hàng câu hỏi</a></h1>

        </div>
        <div class="header-right">
            <label for=""><?php echo $_SESSION['Username']?></label>
            <a href="./process/dangxuat.php">Đăng xuất</a>
        </div>
    </div>
</body>
</html>