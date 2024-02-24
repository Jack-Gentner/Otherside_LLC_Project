<?php
        $conn = new mysqli("localhost", "OtherSide", "xQk0IW!1[[o-ER[2", "otherside llc");

        if ($conn->connect_error) {
            echo "Connection error";
        }
        else  {
            $Name = $_POST["name1"];
            $Description = $_POST["Description"];
            $service = $_POST['sName'];

            $sql = "SELECT ServiceName FROM servicetable WHERE ServiceID=$service";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $oldService = $row['ServiceName'];

            if($_POST['name1'] != null){
                
                $stmt = $conn->prepare('UPDATE servicetable SET ServiceName="'.$Name.'" WHERE ServiceID="'.$service.'"');
                $stmt->execute();
                $stmt->close();

                $stmt = $conn->prepare('UPDATE clienttable SET ServiceName="'.$Name.'" WHERE ServiceName="'.$oldService.'"');
                $stmt->execute();
                $stmt->close();

                $stmt = $conn->prepare('UPDATE incoivetable SET ServiceName="'.$Name.'" WHERE ServiceName="'.$oldService.'"');
                $stmt->execute();
                $stmt->close();
            }
            if ($_POST['Description'] != null){

                $stmt = $conn->prepare('UPDATE servicetable SET ServiceDescription="'.$Description.'" WHERE ServiceID="'.$service.'"');
                $stmt->execute();
                $stmt->close();
            }

            header("Location:UpdateService.php");
        }
?>