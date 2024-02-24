<?php

$conn = new mysqli("localhost", "kmkelmo1", "vYV7v[66(kX9lD", "kmkelmo1_CS302_Project_Combined");

if ($conn->connect_error) {
    echo "Connection error";
}
else {
 
    $UName = $_REQUEST['id'];
    $Role = $_REQUEST['roles'];
    $stmt = $conn->prepare('UPDATE User SET Role = "'.$Role.'" WHERE UName= "'.$UName.'"');
    $stmt->execute();
    $stmt->close();
    
    header("Location: AdminPage.php");
 
}
?> 