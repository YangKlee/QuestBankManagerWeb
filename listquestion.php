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

?>
<body>
    <div class="main-container">
        <label for="" class="list-questbank-title">Danh sách câu hỏi</label>
        <div class="function-button">
            <a href="./addquest.php"><button class="function-button add">Thêm câu hỏi</button></a>
            <a href="#"><button class="function-button export">Xuất Azota</button></a>
            <a href="#"><button class="function-button export">Xuất CSV</button></a>
            <a href="./index.php"><button class="function-button reject">Thoát ngân hàng</button></a>
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
                    $result = $questDAO->getAllQuestion($_GET['idbank']);
                    while ($_row = mysqli_fetch_assoc($result))
                    {
                        $correctAns = $_row['CorrectAns'];
                        echo "<tr>";
                        echo "<td>".$_row['STT']."</td>";
                        echo "<td>".$_row['Title']."</td>";
                        if($correctAns == 1)
                            echo "<td class='trueans'>".$_row['Ans1']."</td>";
                        else
                            echo "<td>".$_row['Ans1']."</td>";

                        if($correctAns == 2)
                            echo "<td class='trueans'>".$_row['Ans2']."</td>";
                        else
                            echo "<td>".$_row['Ans2']."</td>";

                        if($correctAns == 3)
                            echo "<td class='trueans'>".$_row['Ans3']."</td>";
                        else
                            echo "<td>".$_row['Ans3']."</td>";

                        if($correctAns == 4)
                            echo "<td class='trueans'>".$_row['Ans4']."</td>";
                        else
                            echo "<td>".$_row['Ans4']."</td>";
                        echo '<td><a href="#">Sửa</a> | <a href="#">Xóa</a></td>';
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
    </div>
</body>
</html>