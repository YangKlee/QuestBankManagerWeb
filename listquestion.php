<?php
session_start();
    if($_SERVER["REQUEST_METHOD"] != 'GET' || !isset($_GET['idbank']))
    {
        header("Location: index.php");
        exit;
    }
    else
    {
        $_SESSION['id_bank_view'] = $_GET['idbank'];
       
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./res/css/reset.css">
    <link rel="stylesheet" href="./res/css/layout.css">
    <link rel="stylesheet" href="./res/css/listquest.css">
    <title>Danh sách câu hỏi</title>
</head>
<?php require "./partials/header.php" ?>
<?php 
    //session_start();    
    $question_per_page = 10;
    $current_page = $_GET['page'] ?? 1;
    require_once "./model/questBankDAO.php";
    $bankDAO = new questBankDAO();
    $totalQuestion = $bankDAO->countQuestion($_GET['idbank']);
    $totalPage = ceil($totalQuestion / $question_per_page);
?>
<body>
    <div class="main-container">
        <label for="" class="list-questbank-title">Danh sách câu hỏi</label>
        <label for="" class="list-questbank-info">Mã ngân hàng: <?php echo $_GET['idbank'] ?></label>
        <div class="function-warpper">
            <div class="function-button">
                <a href="./addquest.php"><button class="function-button add">Thêm câu hỏi</button></a>
                <a href="#"><button class="function-button export">Xuất Azota</button></a>
                <a href="#"><button class="function-button export">Xuất CSV</button></a>
                <a href="./index.php"><button class="function-button reject">Thoát ngân hàng</button></a>
                <?php if(isset($_GET['search'])): ?>
                <a href="./listquestion.php?idbank=<?php echo $_GET['idbank'] ?>"><button class="function-button reject">Thoát tìm kiếm</button></a>
                <?php endif ?>
                
            </div>
            <div class="search-warpper">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <input type="text" style="display: none;" name="idbank" value="<?php echo $_GET['idbank'] ?>">
                    <input type="text" name="search" placeholder="Tìm kiếm câu hỏi...">
                    <input type="submit" name="sumit-btn" value="Tìm kiếm">
                </form>
            </div>
        </div>
        <table class="list-questbank-table">
            <thead>
                <tr>
                    <th style="width: 5%;">STT</th>
                    <th style="width: 30%;">Nội dung</th>
                    <th style="width: 12.5%;">Đáp án 1</th>
                    <th style="width: 12.5%;">Đáp án 2</th>
                    <th style="width: 12.5%;">Đáp án 3</th>
                    <th style="width: 12.5%;">Đáp án 4</th>
                    <th style="width: 15%;">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    require_once "./model/questionDAO.php";
                    $questDAO = new questionDAO();
                    if(isset($_GET['search']))
                    {
                        $searchKey = htmlspecialchars(trim($_GET['search']));
                        $result = $questDAO->getFromQuery("Select * from question where IDBank = ".$_GET['idbank']." AND Title LIKE '%". $searchKey."%' ORDER BY STT ASC");
                    }
                    else
                    {
                    $result = $questDAO->getFromQuery("Select * from question where IDBank = ".$_GET['idbank']." ORDER BY STT ASC
                     LIMIT ".$question_per_page." OFFSET ".($current_page - 1) * $question_per_page."");
                    }

                    while ($_row = mysqli_fetch_assoc($result))
                    {
                        $correctAns = $_row['CorrectAns'];
                        echo "<tr>";
                        echo "<td>".$_row['STT']."</td>";
                        echo "<td>".$_row['Title']."</td>";
                        for ($i = 1; $i <= 4; $i++) {
                            if ($correctAns == $i && $_row['Comment'] != "")
                                echo "<td class='verifyans'>" . $_row['Ans' . $i] . "</td>";
                            else if ($correctAns == $i)
                                echo "<td class='trueans'>" . $_row['Ans' . $i] . "</td>";
                            else
                                echo "<td>" . $_row['Ans' . $i] . "</td>";
                        }
                        echo '<td><a href="./modifyquest.php?idquest='.$_row['QuestionID'].'">Sửa</a> |<a  href="./process/deleteQuest.php?idquest='.$_row['QuestionID'].'&idbank='.$_GET['idbank'].'">Xóa</a></td>';
                        echo "</tr>";
                    }
                
                ?>
                <!-- <tr>
                    <td>QB001</td>
                    <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat iste reiciendis ullam soluta quasi cum reprehenderit accusantium amet repellat dolor perspiciatis aliquid mollitia sapiente vel, hic saepe, quibusdam dolore itaque.</td>
                    <td>Shikanoko Nokonoko koshi</td>
                    <td class="trueans">Shikanoko Nokonoko koshi</td>
                    <td>Shikanoko Nokonoko koshi</td>
                    <td>Shikanoko Nokonoko koshi</td>
                    <td><a href="#">Sửa</a> | <a href="#">Xóa</a></td>
                </tr> -->

            </tbody>
        </table>
        <?php 
                if(isset($_GET['search']))
                    echo '<div class="page-navigation hidden" >';
                else
                    echo '<div class="page-navigation" >';
                if($current_page > 1)
                {
                    echo '<a href="./listquestion.php?idbank='.$_GET['idbank'].'&page='.($current_page - 1).'">&#8592;</a>';
                }
                for($i = 1; $i <= $totalPage; $i++)
                {
                    if($i < $current_page - 1 || $i > $current_page + 1)
                    {
                        continue;
                    }

                    if($i == $current_page)
                    {
                        echo '<a class="activate">'.$i.'</a>';
                    }
                    else{
                        echo '<a href="./listquestion.php?idbank='.$_GET['idbank'].'&page='.$i.'">'.$i.'</a>';
                    }
                }
                if($current_page < $totalPage)
                {
                    echo '<a href="./listquestion.php?idbank='.$_GET['idbank'].'&page='.($current_page + 1).'">&#8594;</a>';
                }
                echo '</div>';
        
        ?>
    </div>
</body>
</html>