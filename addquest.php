<?php
    session_start();
    require "./partials/header.php";
    if(!isset($_SESSION['id_bank_view']))
    {
        header("Location: index.php");
        exit;
    }
    $message = "";
    $nextvalue = "";
    function checkTrungDapAn()
    {
        for ($i = 1; $i <=4; $i++)
        {
            for ($j = $i+1; $j <=4; $j++)
            {
                if($_POST['content-ans'.$i] == $_POST['content-ans'.$j])
                    return false;
            }
            return true;
        }
    }
    require "./model/questBankDAO.php";
    $bankDAO = new questBankDAO();
    $totalQuestion =  $bankDAO->countQuestion($_SESSION['id_bank_view']);
    $maxQuestion = $bankDAO->getMaxQuestion($_SESSION['id_bank_view']);
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        require "./model/questionDAO.php";
        $questDAO = new questionDAO();
        
        if(!checkTrungDapAn())
        {
            $message ="Trùng đáp án kìa!";
        }
        else if($totalQuestion >= $maxQuestion && $maxQuestion != 0)
        {
            $message = "Vượt quá số lượng câu hỏi có trong ngân hàng";
        }
        else
        {
            $ans = 0;
            if(isset($_POST['ans']))
            {
                $ans = $_POST['ans'];
            }
            $kq = $questDAO->add($_SESSION['id_bank_view'], $_POST['STT'], $_POST['content-quest'],
             $_POST['content-ans1'], $_POST['content-ans2'], $_POST['content-ans3'], $_POST['content-ans4'], $ans,
              $_POST['content-explan'], $_SESSION['UID'] );
            if($kq)
            {
                if($_POST['iscontinue'])
                {
                    // cập nhật lại số câu
                    $totalQuestion =  $bankDAO->countQuestion($_SESSION['id_bank_view']);
                    $maxQuestion = $bankDAO->getMaxQuestion($_SESSION['id_bank_view']);
                    $nextvalue = $_POST['STT'] +1;
                }
                else
                {
                    header("Location: ./listquestion.php?idbank=".$_SESSION['id_bank_view']);
                }
            } 
            else
            {
                $message  = "Thêm thất bại ròi!";
            }
            
        }

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm câu hỏi - Ngân hàng <?php echo $_SESSION['id_bank_view']  ?></title>
    <link rel="stylesheet" href="./res/css/reset.css">
    <link rel="stylesheet" href="./res/css/layout.css">
    <link rel="stylesheet" href="./res/css/addquest.css">
</head>

<body>
    
    <div class="main-container">
        <div class="title-container">
            <h1 class="title">Thêm câu hỏi -  Ngân hàng: <?php echo $_SESSION['id_bank_view'] ?></h1>
            <h2 class="title-info">Tổng số câu hỏi: <?php echo $totalQuestion  .'/' .  $maxQuestion ?></h2>
        </div>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="input-warpper stt-question">
                <label for="">Số thứ tự câu:</label>
                <input type="number" name="STT" required value="<?php echo $nextvalue ?>">
            </div>
            <div class="input-warpper quest-content">
                <label for="">Nội dung câu hỏi</label>
                <textarea name="content-quest" class="content-question"></textarea>
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
            <script>
                function showHintQuestion(numQuest)
                {
                    listAns = document.querySelectorAll(".content-ans");
                    // reset về màu mặc định
                    for (i = 0; i < listAns.length; i++)
                    {
                        listAns[i].style.backgroundColor = "white";
                    }
                     listAns[numQuest-1].style.backgroundColor = "yellow";
                }
            </script>
            <div class="input-warpper choose-ans">
                <label for="">Chọn đáp án đúng:</label>
                <div class="ans-warpper-list">
                    <span> <label for="">1:</label> <input onclick="showHintQuestion(1)" type="radio" name="ans" value="1"></span>
                    <span> <label for="">2:</label> <input  onclick="showHintQuestion(2)" type="radio" name="ans" value="2"></span>
                    <span> <label for="">3:</label> <input  onclick="showHintQuestion(3)" type="radio" name="ans" value="3"></span>
                    <span> <label for="">4:</label>  <input   onclick="showHintQuestion(4)"type="radio" name="ans" value="4"></span> 
                </div>
            </div>
            <div class="input-warpper giaithich">
                <label for="">Giải thích:</label>
                <textarea name="content-explan" id="content-explan"></textarea>
            </div>
            <div class="input-warpper iscontinue">
                
                <?php 
                    if(isset($_POST['iscontinue']))
                    {
                        if($_POST['iscontinue'])
                        {
                            echo '<input type="checkbox" name="iscontinue" checked>';
                        }
                        else
                        {
                            echo '<input type="checkbox" name="iscontinue">';
                        }
                    }
                    else
                    {
                        echo '<input type="checkbox" name="iscontinue">';
                    }
                    
                ?>
                <label for="">Tiếp tục với câu sau</label>
            </div>
            
            <label style="color: red;" for=""><?php echo $message ?></label>
            <div class="function-btn-warpper">
                <input class="function-button add" type="submit" value="Thêm">
                <a href="./listquestion.php?idbank=<?php echo $_SESSION['id_bank_view'] ?>"><button class="function-button reject" type="button">Hủy</button></a>
            </div>

        </form>
    </div>
</body>
</html>