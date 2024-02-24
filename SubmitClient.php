<?php
        $conn = new mysqli("localhost", "OtherSide", "xQk0IW!1[[o-ER[2", "otherside llc");

        if ($conn->connect_error) {
            echo "Connection error";
        }else if ($_POST['Pdate'] != null){
            $cName = $_POST["cName"];
            $Address = $_POST["Address"];
            $sName = $_POST["sName"];
            $Sdate = $_POST["Sdate"];
            $Pdate = $_POST['Pdate'];
            

            $stmt = $conn->prepare("INSERT INTO clienttable(ClientName, Address, ServiceName, ServiceDate, DatePaid) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $cName, $Address, $sName, $Sdate, $Pdate);
            $stmt->execute();
            $stmt->close();

            $sql = "SELECT MAX(ClientID) as clientid FROM clienttable";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['clientid'];

            $stmt2 = $conn->prepare("INSERT INTO incoivetable (ClientID, ClientName, ServiceName, InvoiceDate) VALUES (?, ?, ?, ?)");
            $stmt2->bind_param("ssss", $id, $cName, $sName, $Pdate);
            $stmt2->execute();
            $stmt2->close();

            header("Location:AddClient.php");
        }else if(isset($_POST['cName']) && isset($_POST['Address']) && isset($_POST['sName']) && $_POST['Sdate'] != null){
            $cName = $_POST["cName"];
            $Address = $_POST["Address"];
            $sName = $_POST["sName"];
            $Sdate = $_POST["Sdate"];
            

            $stmt = $conn->prepare("INSERT INTO clienttable(ClientName, Address, ServiceName, ServiceDate) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $cName, $Address, $sName, $Sdate);
            $stmt->execute();
            $stmt->close();

            header("Location:AddClient.php");
        }else{
            header("Location:AddClient.php");
        

        }
?>