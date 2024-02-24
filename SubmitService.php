<?php
        $conn = new mysqli("localhost", "OtherSide", "xQk0IW!1[[o-ER[2", "otherside llc");

        if ($conn->connect_error) {
            echo "Connection error";
        }
        else if($_POST['Name'] != null && $_POST['Description'] != null) {
            $Name = $_POST["Name"];
            $Description = $_POST["Description"];

            $stmt = $conn->prepare("INSERT INTO servicetable(ServiceName, ServiceDescription) VALUES (?, ?)");
            $stmt->bind_param("ss", $Name, $Description);
            $stmt->execute();
            $stmt->close();

            header("Location:AddService.php");
        } else {
            header("Location:AddService.php");
        }

        
?>