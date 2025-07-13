<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        require_once "./model/userDAO.php";
        $userDAO = new userDAO();
        $auth = $userDAO->authUser($_POST["username"], $_POST["password"]);
        if($auth != null)
        {
            session_start();
            $_SESSION["UID"] = $auth;
            header("Location: ./index.php");
            exit;
        }
        else
        {
            echo "<script>alert('Đăng nhập thất bại');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống</title>
    <link rel="stylesheet" href="res/css/reset.css">
    <link rel="stylesheet" href="res/css/login.css">
</head>
<body>
    <div class="login-main">
        <div class="left-container">

        </div>
        <div class="right-container">
            <h1>Đăng nhập</h1>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
                
                <input type="text" placeholder="Tên đăng nhập" required name="username">
                <input type="password" placeholder="Mật khẩu" required name="password">
                <input type="submit" value="Đăng nhập">
            </form>
        </div>
    </div>
</body>
</html>