<html> 
    <head>
<style>
    <?php 

        include "Style.css";

        session_start();

        if (isset($_REQUEST["logout"])){
            session_unset();
            header('Location: /otherside/Login.php');
        }
    ?>
</style>

<title> Invoices </title>
</head>
    <body>

        <div id="bar"> 
            <form style="float: left; margin: 2%;" >
                <input type="hidden" name="logout" value="1" />
                <button class="logout" type="submit">Logout</button>
            </form>
            Other Side Lawn and Landscape
        </div> <br> <br>


        <div id="Invoices"> 
            <?php
                $conn = new mysqli("localhost", "OtherSide", "xQk0IW!1[[o-ER[2", "otherside llc");

                if ($conn->connect_error) {
                    echo "Connection error";
                }
                else {
                $sql = 'SELECT ClientName, ServiceName, InvoiceDate FROM incoivetable order by InvoiceDate';
                $result = $conn->query($sql);
                }


            ?>

            <button class="otherButtons" style="float:left; margin-top: 2%; margin-left: 2%;"> <a href="Home.php"> Return Home</a></button>
            <br> <br> <br>
            Invoices:
            <br> <br>

            <table id="table1"> 
            

                <tr> 
                
                    
                    <th> Client Name</th>
                    <th> Service Name</th>
                    <th> Date Paid</th>


                </tr>
                <?php   
                            while($rows=$result->fetch_assoc())
                            {
                        ?>
                        <tr>
                            <td><?php echo $rows['ClientName'];?></td>
                            <td><?php echo $rows['ServiceName'];?></td>
                            <td><?php echo $rows['InvoiceDate'];?></td>


                        </tr>
                        <?php
                            }
                        ?>
            <table>
        <br> <br>
        </div>
    </body>

</html>