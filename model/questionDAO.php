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
                $title  = str_replace(array("\n", "\r"), ' ', $title);
                $title  = trim($title);

                $ans1   = str_replace(array("\n", "\r"), ' ', $ans1);
                $ans1   = trim($ans1);

                $ans2   = str_replace(array("\n", "\r"), ' ', $ans2);
                $ans2   = trim($ans2);

                $ans3   = str_replace(array("\n", "\r"), ' ', $ans3);
                $ans3   = trim($ans3);

                $ans4   = str_replace(array("\n", "\r"), ' ', $ans4);
                $ans4   = trim($ans4);

                $explan = str_replace(array("\n", "\r"), ' ', $explan);
                $explan = trim($explan);

            $stmt->bind_param("iisssssssi", $STT, $idBank, $title, $ans1, $ans2, $ans3, $ans4, $correctAns, $explan, $usercreate);

            if ($stmt->execute()) {
                return true;
            } else {
                error_log("Execute failed: " . $stmt->error);
                return false;
            }
        }
        function modify($idQuestion, $STT, $idBank, $title, $ans1, $ans2, $ans3, $ans4, $correctAns, $explan)
        {
            $conn = $this->getConnection();
            $sql = "UPDATE question 
                    SET STT = ?, Title = ?, Ans1 = ?, Ans2 = ?, Ans3 = ?, Ans4 = ?, CorrectAns = ?, Comment = ?
                    WHERE QuestionID = ? and IDBank = ?";

            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
            $title  = str_replace(array("\n", "\r"), ' ', $title);
            $title  = trim($title);

            $ans1   = str_replace(array("\n", "\r"), ' ', $ans1);
            $ans1   = trim($ans1);

            $ans2   = str_replace(array("\n", "\r"), ' ', $ans2);
            $ans2   = trim($ans2);

            $ans3   = str_replace(array("\n", "\r"), ' ', $ans3);
            $ans3   = trim($ans3);

            $ans4   = str_replace(array("\n", "\r"), ' ', $ans4);
            $ans4   = trim($ans4);

            $explan = str_replace(array("\n", "\r"), ' ', $explan);
            $explan = trim($explan);

            $stmt->bind_param("isssssisii", $STT, $title, $ans1, $ans2, $ans3, $ans4, $correctAns, $explan, $idQuestion , $idBank);

            if ($stmt->execute()) {
                return true;
            } else {
                error_log("Execute failed: " . $stmt->error);
                return false;
            }
        }
        function delete($idQuestion, $idBank)
        {
            $conn = $this->getConnection();
            $sql = "DELETE FROM question WHERE QuestionID = ? and idBank = ?";

            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("ii", $idQuestion, $idBank);

            if ($stmt->execute()) {
                return true;
            } else {
                error_log("Delete failed: " . $stmt->error);
                return false;
            }
        }

        function getAllQuestion($idBank)
        {
            $conn = $this->getConnection();
            $result = mysqli_query($conn, "Select * from question where IdBank = {$idBank}");
            return $result;
        }
        function getQuestion($idquest, $idBank)
        {
            $conn = $this->getConnection();
            $result = mysqli_query($conn,"Select * from question where QuestionID = {$idquest} and IdBank = {$idBank}");
            return $result->fetch_assoc();
        }
        function getFromQuery($sql)
        {
             $conn = $this->getConnection();
            return mysqli_query($conn, $sql);
        }
        

        
    }

?>