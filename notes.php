
<html>
    
    <?php
        $conn = new mysqli("localhost", "Admin", "pfsense", "tptest");

                if ($conn->connect_error) {
                    echo "Connection error";
                }


                if(isset($_REQUEST["roles"]) && $_REQUEST["roles"]!="False"){
 
                    $Num = $_REQUEST['email'];
                    $Role = $_REQUEST['roles'];
                    $stmt = $conn->prepare('UPDATE adminpage SET Role = "'.$Role.'" WHERE UserNumber= "'.$Num.'"');
                    $stmt->execute();
                    $stmt->close();
                    
                }else{
                    echo '<script>alert("Please select a role to assign")</script>';
                }

    ?>

    <head> 
        <title> Admin Page </title>

        <script>            

        </script>

    </head>

    <body>
            <?php
                

                $conn1 = new mysqli('localhost', "Admin", "pfsense", "tptest"); 
                if ($conn->connect_error) {
                    echo "Connection error";
                }
                else {

                    $sql = 'SELECT Name, Email, RequestedRole FROM adminpage';
                    $result = $conn->query($sql);

                    $sql2 = 'SELECT UserNumber, Email FROM adminpage';
                    $result2 = $conn->query($sql2);

                    echo "
                    <table>
                        <tr>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Requested Role </th>       
                        </tr>";

                        while ($row = $result->fetch_assoc()) {

                            $name = $row['Name'];
                            $email = $row['Email'];
                            $rrole = $row['RequestedRole'];

                            echo "
                            <tr>
                                <td> $name </td>
                                <td> $email </td>
                                <td> $rrole </td>
                            </tr>
                            ";

                        }

                    echo"
                    </table>
                    <select name='email' id='email'>
                    ";

                    }
                    while($row2 = $result2->fetch_assoc()){
                        
                        $id2 = $row['UserNumber'];
                        $email2 = $row2['Email'];
                        echo '<option value="'.$id2.'">'.$email2.'</option>';
                    }

                    echo"</select>";
                
                
            ?> 
              
            <select name="roles" id="roles"> 

                    <option value="False"> </option>
                    <option value="Admin">Admin</option>
                    <option value="Student">Student</option>
                    <option value="Faculty">Faculty</option>
                    <option value="Visitor">Visitor</option>

                </select>
         <br>
            <button type="submit" id="submitBtn"> Submit changes </button>
            </form>
        
    </body>
</html>