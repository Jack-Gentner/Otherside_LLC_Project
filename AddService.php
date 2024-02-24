 
<html> 

        <script>
        function success() {
            if(document.getElementById("Name").value==="" || document.getElementById("Description").value==="" ) { 
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
            <form id="serviceForm" method="post" action="SubmitService.php"> 

                <h2> Add New Service </h2>
                <br>
                    <table id="table2">
                        <tr> 
                            <td > Service name: </td>
                            <td > <input onkeyup="success()" name="Name" id="Name" type="text"></td>
                        </tr>

                        <tr>
                            <td > Service description: </td>
                            <td > <input onkeyup="success()" name="Description" id="Description" type="text"></td>
                        </tr>
                    </table>

                    <br>
                <button class="otherButtons" type="submit" id="button" disabled> Enter Service </button>
                <button class="otherButtons" id="notButton" > <a href="UpdateService.php"> Update Service</a></button>
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
    <php
    ?>
</html>