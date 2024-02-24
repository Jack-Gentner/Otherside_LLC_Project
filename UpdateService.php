 
<html> 

<script>     
</script>
<?php 

session_start();

if (isset($_REQUEST["logout"])){
    session_unset();
    header('Location: /otherside/Login.php');
}


?>
<style> 
<?php include "Style.css" ?>
</style>

<head> 
<title> Add Service</title>        
</head>

<body>

<div id="bar"> 
    <form style="float: left; margin: 2%;" >
        <input type="hidden" name="logout" value="1" />
        <button class="logout" type="submit"> Logout</button>
    </form>
    Other Side Lawn and Landscape
</div>

<br>

<div> 
    <form id="serviceForm" method="post" action="UpdateSubmit.php"> 

        <h2> Update Service </h2>
        <br>
            <table id="table2">
                <tr> 
                    <td > Select a service to update: </td>
                    <td> 

                        <?php

                        $conn1 = new mysqli("localhost", "OtherSide", "xQk0IW!1[[o-ER[2", "otherside llc"); 
                        if ($conn1->connect_error) {
                            echo "Connection error";
                        }
                        else {

                        $sql1 = 'SELECT ServiceName, ServiceID FROM Servicetable';
                        $result1 = $conn1->query($sql1);

                        echo "<select name='sName' id='sName'>";

                        while ($row1 = $result1->fetch_assoc()) {

                            $sName = $row1['ServiceName']; 
                            $id = $row1['ServiceID'];
                            echo '<option value="'.$id.'">'.$sName.'</option>';

                            }

                        echo "</select> </td> </tr>";             
                        }
                        $conn1->close();
                        ?>   
                        <tr>
                            <td > Updated service name: </td>
                            <td > <input name='name1' id='name1' type='text'></td>
                        </tr>            
                        <tr>
                            <td > Updated service description: </td>
                            <td > <input name='Description' id='Description' type='text'></td>
                        </tr>
                    </table>

            <br>
        <button class="otherButtons" type="submit" id="button"> Update Service </button>
        <button class="otherButtons" id="notButton" > <a href="AddService.php"> Go Back</a></button>
        <button class="otherButtons" id="notButton" > <a href="Home.php"> Return Home</a></button>
 
    </form>
</div>

<br>
<br>

<div> 
            <?php
                $conn = new mysqli("localhost", "OtherSide", "xQk0IW!1[[o-ER[2", "otherside llc");

                if ($conn->connect_error) {
                    echo "Connection error";
                }
                else {
                $sql = 'SELECT ServiceName, ServiceDescription FROM servicetable order by ServiceID';
                $result = $conn->query($sql);
                $conn->close();
                }

            ?>

            <table id="table1">

                <tr> 
                    <th> Existing Services</th>
                    <th> Service Description</th>
                </tr>
                <?php   
                            while($rows=$result->fetch_assoc())
                            {
                        ?>
                        <tr>
                            <td><?php echo $rows['ServiceName'];?></td>
                            <td><?php echo $rows['ServiceDescription'];?></td>
                        </tr>
                        <?php
                            }
                        ?>
            <table>
        </div>

</body> 
</html>