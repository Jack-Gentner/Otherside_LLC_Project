 
<html> 
    <script>
        function success() {
            if(document.getElementById("cName").value==="" || document.getElementById("Address").value==="") { 
                    document.getElementById('button').disabled = true; 
                } else { 
                    document.getElementById('button').disabled = false;
                }
            }

    </script>
    <?php 

        session_start();

        if (isset($_REQUEST["logout"])){
            session_unset();
            header('Location: /otherside/Login.php');
        }

        $conn = new mysqli("localhost", "OtherSide", "xQk0IW!1[[o-ER[2", "otherside llc");

        if ($conn->connect_error) {
            echo "Connection error";
        }

    ?>
    <style> 
        <?php include "Style.css" ?>
    </style>

    <head> 
        <title> Add Job</title>
               
    </head>

    <body>

        <div id="bar"> 
            <form style="float: left; margin: 2%;" >
                <input type="hidden" name="logout" value="1" />
                <button class="logout" type="submit"> Logout </button>
            </form>
            Other Side Lawn and Landscape
        </div>

        <br>

        <div> 
            <form id="clientForm" style="text-align: center;" method="post" action="UpdateClientSubmit.php"> 

                <h2> Update Job Information </h2> <br>

                <table id="table2"> 
                    <tr>
                        <td> Select a job to update:</td>
                        <td> 
                            <?php

                                $conn1 = new mysqli("localhost", "OtherSide", "xQk0IW!1[[o-ER[2", "otherside llc"); 
                                if ($conn1->connect_error) {
                                    echo "Connection error";
                                }
                                else {

                                $sql1 = 'SELECT ClientID, ClientName FROM clienttable';
                                $result1 = $conn1->query($sql1);

                                echo "<select name='cName1' id='cName1'>";

                                while ($row1 = $result1->fetch_assoc()) {

                                    $cName = $row1['ClientName']; 
                                    $id = $row1['ClientID'];
                                    echo '<option value="'.$id.'">'.$id.'</option>';

                                    }

                                echo "</select>";

                                }
                                $conn1->close();
                            ?> 
                        </td>
                    </tr>
                    <tr> 
                        <td> Client Name: </td>
                        <td> <input onkeyup="success()" name="cName" id="cName" type="text"></td>
                    </tr>
                    <tr> 
                        <td>Client Address:</td>
                        <td> <input onkeyup="success()" name="Address" id="Address" type="text"></td>
                    </tr>
                                        <tr> 
                        <td> Service Name: </td>
                        <td> 

                        <?php

                        $conn1 = new mysqli("localhost", "OtherSide", "xQk0IW!1[[o-ER[2", "otherside llc"); 
                        if ($conn1->connect_error) {
                            echo "Connection error";
                        }
                        else {

                        $sql1 = 'SELECT ServiceName FROM Servicetable';
                        $result1 = $conn1->query($sql1);

                        echo "<select name='sName' id='sName'>
                        <option> </option>";

                        while ($row1 = $result1->fetch_assoc()) {

                            $sName = $row1['ServiceName']; 
                            echo '<option>'.$sName.'</option>';

                            }

                        echo "</select>";
                        }
                        $conn1->close();
                        ?>

                        </td>
                    </tr>
                    <tr> 
                        <td> Service Date:</td>
                        <td><input onclick="success()" name="Sdate" id="Sdate" type="date"> </td>
                    </tr>
                    <tr> 
                        <td> Payment Date:</td>
                        <td> <input name="Pdate" id="Pdate" type="date"></td>
                    </tr>
                </table>

                <br> <br>

                <button class="otherButtons" id="notButton" type="submit" > Update Job</button>
                <button class="otherButtons" id="button"> <a href="AddClient.php"> Go Back</a> </button>
                <button class="otherButtons"> <a href="Home.php"> Return Home</a></button>
                <br> <br>
         
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
                $sql = 'SELECT ClientID, ClientName, Address, ServiceName, ServiceDate, DatePaid FROM clienttable order by ClientID';
                $result = $conn->query($sql);
                $conn->close();
                }

            ?>

            <table id="table1">

                <tr> 
                    <th> Job Number </th>
                    <th> Client Name</th>
                    <th> Client Address</th>
                    <th> Service Name</th>
                    <th> Payment Date</th>
                    <th> Service Date</th>


                </tr>
                <?php   
                            while($rows=$result->fetch_assoc())
                            {
                        ?>
                        <tr>
                            <td><?php echo $rows['ClientID'];?></td>
                            <td><?php echo $rows['ClientName'];?></td>
                            <td class="hidetext"><?php echo $rows['Address'];?></td>
                            <td><?php echo $rows['ServiceName'];?></td>
                            <td><?php echo $rows['DatePaid'];?></td>

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
                        ?>
            <table>
        </div>
    </body> 
    <php
    ?>
</html>