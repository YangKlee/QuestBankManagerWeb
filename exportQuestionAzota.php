<?php 
    if($_SERVER['REQUEST_METHOD'] != "GET" || !isset($_GET['idbank']))
    {
        exit;
    }
    else
    {
        require_once "./model/questionDAO.php";
        $questDAO = new questionDAO();
        $data = $questDAO->getAllQuestion($_GET['idbank']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .txtbox{
            width: 100%;
            height: 100vh;
        }
    </style>
</head>
<body>
    <button class="coppy_btn">Coppy</button>
    <textarea class="txtbox" name="" id="">
        <?php 
            while($row = $data->fetch_assoc())
            {
                echo "Câu " . $row['STT'] - 20 . ": ";
                echo $row['Title'] . "\n" ;
                $partern = ["A. ", "B. ", "C. ", "D. "];
                for ($i = 1; $i <= 4; $i++)
                {
                    if($row['CorrectAns'] == $i)
                    {
                        echo "*".$partern[$i-1]. $row['Ans'.$i.''] ;
                    }
                    else
                    {
                        echo $partern[$i-1]. $row['Ans'.$i.''] ;
                    }
                    echo "\n";
                }
            }
        
        ?>

    </textarea>
</body>
</html>