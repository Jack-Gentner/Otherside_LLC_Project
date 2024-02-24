<?php

$conn1 = new mysqli('localhost', "Admin", "pfsense", "tptest"); 
if ($conn1->connect_error) {
    echo "Connection error";
}
else {
 
 $Num = $_POST['id'];
 $Role = $_POST['roles'];
 $stmt = $conn1->prepare('UPDATE adminpage SET Role = "'.$Role.'" WHERE UserNumber= "'.$Num.'"');
 $stmt->execute();
 $stmt->close();

 header("Location:Admin.php");
 
}
?> 