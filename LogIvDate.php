<?php
        $conn = new mysqli("localhost", "OtherSide", "xQk0IW!1[[o-ER[2", "otherside llc");

        if ($conn->connect_error) {
            echo "Connection error";
        }
        else if($_POST['cName'] != null && $_POST['Pdate'] != null) {
            $id = $_POST["cName"];
            $date = $_POST["Pdate"];

            $sql = "SELECT DatePaid FROM clienttable WHERE ClientID = $id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            if($row['DatePaid'] === null){
                $stmt = $conn->prepare('UPDATE clienttable SET DatePaid="'.$date.'" WHERE ClientID="'.$id.'"');
                $stmt->execute();
                $stmt->close();
    
                $sql = "SELECT ClientName, ServiceName FROM clienttable WHERE ClientID = $id";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $cName = $row['ClientName'];
                $sName = $row['ServiceName'];
    
                $stmt2 = $conn->prepare('INSERT INTO incoivetable(ClientID, ClientName, ServiceName, InvoiceDate) VALUES(?, ?, ?, ?)');
                $stmt2->bind_param('ssss', $id, $cName, $sName, $date);
                $stmt2->execute();
                $conn->close();
            }
            header("Location:Home.php");
        } else {
            header("Location:Home.php");
        }        
?>