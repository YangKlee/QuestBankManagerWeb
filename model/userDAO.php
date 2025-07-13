<?php
    require_once __DIR__."/../config/database.php";
    class userDAO
    {
        function getConnection()
        {
            $dbConnect =  new DatabaseConnection();
            return $dbConnect->getConnection();
        }

        function authUser($username, $password)
        {
            $conn = $this->getConnection();
            $sql =  "Select * from userdata where username = ? and password = ?";
            $sttm = $conn->prepare($sql);
            $sttm->bind_param("ss", $username, $password);
            $sttm->execute();
            $result = $sttm->get_result();
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                return $row["UID"];
            }
            else
            {
                return null;
            }
            $conn->close();
        }
        function getUser($uid)
        {
            $conn = $this->getConnection();
            $result = mysqli_query($conn,"Select * from userdata where uid = {$uid}");
            if ($result->num_rows > 0)
            {
                return $result->fetch_assoc();
            }
            else
            {
                return null;
            }
            $conn->close();
        }
    }

?>