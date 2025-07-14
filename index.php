<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./res/css/reset.css">
    <link rel="stylesheet" href="./res/css/layout.css">
    <link rel="stylesheet" href="./res/css/index.css">
    <title>Document</title>
</head>
<?php require "./partials/header.php" ?>
<?php 
    //session_start();    

?>
<body>
    <div class="main-container">
        <label for="" class="list-questbank-title">Danh sách ngân hàng câu hỏi</label>
        <div class="function-button">
            <a href="./addbank.php"><button class="function-button add">Thêm ngân hàng</button></a>
        </div>
        <table class="list-questbank-table">
            <thead>
                <tr>
                    <th style="width: 10%;">Mã ngân hàng</th>
                    <th style="width: 40%;">Tên ngân hàng</th>
                    <th style="width: 20%;">Số lượng</th>
                    <th style="width: 30%;">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once "./model/questBankDAO.php";
                    $bankDAO = new questBankDAO();
                    $result = $bankDAO->getAllBank();
                    while ($row = $result->fetch_assoc()) 
                    {
                        echo "<tr>";
                        echo "<td>".$row['IDBank']."</td>";
                        echo "<td>".$row['NameBank']."</td>";
                        if($row['LimitQuestion'] == 0)
                            echo "<td>" . $bankDAO->countQuestion($row['IDBank']). "</td>";
                        else
                            echo "<td>" . $bankDAO->countQuestion($row['IDBank'])."/".$row['LimitQuestion']. "</td>";
                        echo '<td><a href="./listquestion.php?idbank='.$row['IDBank'].'">Truy cập</a> | <a href="#">Sửa </a> | <a href="./process/deleteBank.php?idbank='.$row['IDBank'].'">Xóa</a></td>';
                        echo "</tr>";
                    }
                ?>
                <!-- <tr>
                    <td>QB001</td>
                    <td>Ngân hàng Toán 12</td>
                    <td>120</td>
                    <td><a href="#">Truy cập</a> | <a href="#">Sửa </a> | <a href="#">Xóa</a></td>
                </tr> -->

            </tbody>
        </table>
    </div>
</body>
</html>