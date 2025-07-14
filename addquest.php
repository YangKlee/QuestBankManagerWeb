<?php
    if(!isset($_GET['idbank']))
    {
        header("Location: index.php");
        exit;
    }
    require "./partials/header.php";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm câu hỏi - Ngân hàng ???</title>
    <link rel="stylesheet" href="./res/css/reset.css">
    <link rel="stylesheet" href="./res/css/layout.css">
    <link rel="stylesheet" href="./res/css/addquest.css">
</head>

<body>
    
    <div class="main-container">
        <div class="title-container">
            <h1 class="title">Thêm câu hỏi -  Ngân hàng: ???</h1>
            <h2 class="title-info">Tổng số câu hỏi: ???</h2>
        </div>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="input-warpper stt-question">
                <label for="">Số thứ tự câu:</label>
                <input type="number" name="STT" required>
            </div>
            <div class="input-warpper quest-content">
                <label for="">Nội dung câu hỏi</label>
                <textarea name="content" class="content-question"></textarea>
            </div>
            <div class="input-warpper ans-1">
                <label for="">Đáp án 1:</label>
                <textarea name="content-ans1" class="content-ans"></textarea>
            </div>
            <div class="input-warpper ans-2">
                <label for="">Đáp án 2:</label>
                <textarea name="content-ans2" class="content-ans"></textarea>
            </div>
            <div class="input-warpper ans-3">
                <label for="">Đáp án 3:</label>
                <textarea name="content-ans3" class="content-ans"></textarea>
            </div>
            <div class="input-warpper ans-4">
                <label for="">Đáp án 4:</label>
                <textarea name="content-ans4" class="content-ans"></textarea>
            </div>
            <div class="input-warpper choose-ans">
                <label for="">Chọn đáp án đúng:</label>
                <div class="ans-warpper-list">
                    <span> <label for="">1:</label> <input type="radio" name="ans" value="1"></span>
                    <span> <label for="">2:</label> <input type="radio" name="ans" value="2"></span>
                    <span> <label for="">3:</label> <input type="radio" name="ans" value="3"></span>
                    <span> <label for="">4:</label>  <input type="radio" name="ans" value="4"></span> 
                </div>
            </div>
            <div class="input-warpper giaithich">
                <label for="">Giải thích:</label>
                <textarea name="content-explan" id="content-explan"></textarea>
            </div>
            <div class="input-warpper iscontinue">
                <input type="checkbox" name="iscontinue">
                <label for="">Tiếp tục với câu sau</label>
            </div>

            <div class="function-btn-warpper">
                <input class="function-button add" type="submit" value="Thêm">
                <a href="./index.php"><button class="function-button reject" type="button">Hủy</button></a>
            </div>

        </form>
    </div>
</body>
</html>