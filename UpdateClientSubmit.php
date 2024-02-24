<?php
        $conn = new mysqli("localhost", "OtherSide", "xQk0IW!1[[o-ER[2", "otherside llc");

        if ($conn->connect_error) {
            echo "Connection error";
        }else{
            $id = $_POST['cName1'];
            $cName = $_POST["cName"];
            $Address = $_POST["Address"];
            $sname = $_POST['sName'];
            $Sdate = $_POST['Sdate'];
            $Pdate = $_POST['Pdate'];

            if($cName != null){
                $stmt = $conn->prepare('UPDATE clienttable SET ClientName="'.$cName.'" WHERE ClientID="'.$id.'"');
                $stmt->execute();
            }
            if($Address != null){
                $stmt = $conn->prepare('UPDATE clienttable SET Address="'.$Address.'" WHERE ClientID="'.$id.'"');
                $stmt->execute();
            }
            if($sname != null){
                $stmt = $conn->prepare('UPDATE clienttable SET ServiceName="'.$sname.'" WHERE ClientID="'.$id.'"');
                $stmt->execute();

                $stmt = $conn->prepare('UPDATE incoivetable SET ServiceName="'.$sname.'" WHERE ClientID="'.$id.'"');
                $stmt->execute();
            }
            if($Sdate != null){
                $stmt = $conn->prepare('UPDATE clienttable SET ServiceDate="'.$Sdate.'" WHERE ClientID="'.$id.'"');
                $stmt->execute();
            }
            if($Pdate != null){
                $stmt = $conn->prepare('UPDATE clienttable SET DatePaid="'.$Pdate.'" WHERE ClientID="'.$id.'"');
                $stmt->execute();

                $stmt = $conn->prepare('UPDATE incoivetable SET InvoiceDate="'.$Pdate.'" WHERE ClientID="'.$id.'"');
                $stmt->execute();
            }

            
            header("Location: UpdateClient.php");
        }
?>