<?php
ob_start();
session_start();
?>
<html>     
    <head>
        <title>
            Other Side Lawn and Landscape
        </title> 
        <script>

        </script>
        <style> 
            <?php include "Style.css" ?>
        </style>
    </head> 
    
    <body> 
        <div id="bar"> 
            <form style="float: left; margin: 2%;" >
                <input type="hidden" name="logout" value="1" />
                <button class="logout" type="submit">Logout </button>
            </form>
            Other Side Lawn and Landscape
        </div>

        <br>
        
        <div id="services">
            <button id="serviceButton" > <a href="AddService.php"> Add Service </a></button> 
            <br>
            <br>
            <br>
            Services Offered:
            <br>
            <br>

            <?php

                if (isset($_REQUEST["logout"])){
                    session_unset();
                    header('Location: /otherside/Login.php');
                }
            
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
                    <th> Name</th>
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
            </table>
            <br>
            <br>

            
        </div>

        <div id="clients"> 
            <button id="clientButton"> <a href="AddClient.php"> Add Job </a></button>
            <button id="invoiceButton" > <a href="Invoice.php"> Invoices </a> </button>
            <br>
            <br>
            <br>
            Completed Jobs:
            <br>
            <br>

             <?php
                $conn = new mysqli("localhost", "OtherSide", "xQk0IW!1[[o-ER[2", "otherside llc");

                if ($conn->connect_error) {
                    echo "Connection error";
                }
                else {
                $sql = 'SELECT ClientName, Address, ServiceName, ServiceDate, DatePaid FROM clienttable order by ServiceDate';
                $result = $conn->query($sql);
                $conn->close();
                }

            ?>

            <table id="table1">

                <tr> 
                    <th> Client Name</th>
                    <th> Client Address</th>
                    <th> Service Name</th>
                    <th> Service Date</th>


                </tr>
                <?php   
                            while($rows=$result->fetch_assoc())
                            {
                        ?>
                        <tr>
                            <td><?php echo $rows['ClientName'];?></td>
                            <td class="hidetext" ><?php echo $rows['Address'];?></td>
                            <td><?php echo $rows['ServiceName'];?></td>
                            <?php

                            if($rows['DatePaid'] == null) {
                                ?>
                                <td bgcolor="red"><?php echo $rows['ServiceDate'];?></td>
                                <?php
                            }else{
                                ?>
                                <td bgcolor="green"><?php echo $rows['ServiceDate'];?></td>


                        </tr>
                        <?php
                            }}
                            ob_end_flush();
                        ?>
                
            <table>

            <br> <br>

            Log Payment Date
            <form method='post' action='LogIvDate.php'>
                <table id='table3'> 
                    <tr> 
                        <th> Select Client </th>
                        <th> Invoice Date </th> 
                    </tr>
                    <tr> 
                        <td>                        
                             <?php

                                $conn1 = new mysqli("localhost", "OtherSide", "xQk0IW!1[[o-ER[2", "otherside llc"); 
                                if ($conn1->connect_error) {
                                    echo "Connection error";
                                }
                                else {

                                $sql1 = 'SELECT ClientID, ClientName FROM clienttable';
                                $result1 = $conn1->query($sql1);

                                echo "<select name='cName' id='cName'>
                                <option> </option>";

                                while ($row1 = $result1->fetch_assoc()) {

                                    $cName = $row1['ClientName']; 
                                    $id = $row1['ClientID'];
                                    echo '<option value="'.$id.'">'.$cName.'</option>';

                                    }

                                echo "</select>";
                                }
                                $conn1->close();
                            ?>  
                        </td>
                        <td> 
                            <input name="Pdate" id="Pdate" type="date">
                        </td>
                    </tr>
                </table>
                <br> 
                <button class="otherButtons" type="submit" id="button"> Log Invoice Date </button>
            </from>
            <br>
            <br>
        </div>
    </body>
</html>