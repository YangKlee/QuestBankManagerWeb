<?php
    require_once __DIR__."/../config/database.php";
    class questionDAO
    {
        function getConnection()
        {
            $dbConnect =  new DatabaseConnection();
            return $dbConnect->getConnection();
        }
        function add($idBank, $STT, $title, $ans1, $ans2, $ans3, $ans4, $correctAns, $explan, $usercreate)
        {
            $conn = $this->getConnection();
            $sql = "INSERT INTO question(`STT`, `IDBank`, `Title`, `Ans1`, `Ans2`, `Ans3`, `Ans4`, `CorrectAns`, `Comment`, `UserCreated`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("iisssssssi", $STT, $idBank, $title, $ans1, $ans2, $ans3, $ans4, $correctAns, $explan, $usercreate);

            if ($stmt->execute()) {
                return true;
            } else {
                error_log("Execute failed: " . $stmt->error);
                return false;
            }
        }
        function getAllQuestion($idBank)
        {
            $conn = $this->getConnection();
            $result = mysqli_query($conn, "Select * from question where IdBank = {$idBank}");
            return $result;
        }

        
    }

?>