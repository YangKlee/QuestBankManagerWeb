<?php
    require_once __DIR__."/../config/database.php";
    class questBankDAO
    {
        function getConnection()
        {
            $dbConnect =  new DatabaseConnection();
            return $dbConnect->getConnection();
        }

        function getAllBank()
        {
            $conn = $this->getConnection();
            $result = mysqli_query($conn,"Select * from questionbank");
            return $result;

        }
        function getFromQuery($sql)
        {
            $conn = $this->getConnection();
            $result = mysqli_query($conn,$sql);
            return $result;
        }
        function countQuestion($idBank)
        {
            $conn = $this->getConnection();
            $result = mysqli_query($conn,"Select count(*) as sl from question where IDBank = {$idBank}");
            if($result->num_rows > 0)
            {
                return $result->fetch_assoc()["sl"];
            }
            else
                return 0;
        }
        function add($name, $limitquest, $UID)
        {
            $conn = $this->getConnection();
            $sql = "Insert into questionbank(NameBank, LimitQuestion, UserCreated ) values(?, ?, ?)";
            $sttm = $conn->prepare($sql);
            $sttm->bind_param("sii", $name, $limitquest, $UID);
            $sttm->execute();
        }
        function delete($idBank)
        {
            $conn = $this->getConnection();
            mysqli_query($conn, "Delete from questionbank where IdBank = '{$idBank}'");
        }
        function getMaxQuestion($idBank)
        {
            $conn = $this->getConnection();
            $result = mysqli_query($conn,"Select LimitQuestion from questionbank where IdBank = {$idBank}");
            return $result->fetch_assoc()['LimitQuestion'];
        }

        
    }

?>