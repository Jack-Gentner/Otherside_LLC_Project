
<html>
<head> 
        <title> Admin Page </title>

        <script>            

        </script>

    </head>

    <body>
    <table>
    <?php
        $conn = new mysqli('localhost', "Admin", "pfsense", "tptest");

                if ($conn->connect_error) {
                    echo "Connection error";
                }
                else {
                    $sql = 'SELECT Name, Email, RequestedRole, Role FROM adminpage';
                    $result = $conn->query($sql);

                    echo "
                        <tr>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Requested Role </th>
                            <th> Current Role </th>       
                        </tr>";

                        while ($row = $result->fetch_assoc()) {

                            $name = $row['Name'];
                            $email = $row['Email'];
                            $rrole = $row['RequestedRole'];
                            $currRole = $row['Role'];

                            echo "
                            <tr>
                                <td> $name </td>
                                <td> $email </td>
                                <td> $rrole </td>
                                <td> $currRole </td>
                            </tr>
                            ";

                        }

                    
                }
                
                


    ?>
</table>

    <form action="submit.php" method="post">

            <?php

                $conn1 = new mysqli('localhost', "Admin", "pfsense", "tptest"); 
                if ($conn1->connect_error) {
                    echo "Connection error";
                }
                else {

                $sql1 = 'SELECT UserNumber, Email FROM adminpage';
                $result1 = $conn1->query($sql1);

                echo "<select name='id'>";

                while ($row1 = $result1->fetch_assoc()) {

                    $id = $row1['UserNumber'];
                    $email = $row1['Email']; 
                    echo '<option value="'.$id.'">'.$email.'</option>';

                    }

                echo "</select>";
                }
            ?> 
              </tr>
            <select name="roles" id="roles"> 

                <option value="False"> </option>
                <option value="Admin">Admin</option>
                <option value="Student">Student</option>
                <option value="Faculty">Faculty</option>
                <option value="Visitor">Visitor</option>

            </select>
            
         <br>
            <button type="submit"> Submit changes </button>
            </form>
        
    </body>
</html>