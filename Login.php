<?php
ob_start();
session_start();
?>
<html> 
    <head>
        <title> Login Page </title>

        <script> 

        </script>
        
        <style> 
            <?php include "Style.css" ?>

        </style>

    </head>

    <body>
        <div id="bar"> 
            Other Side Lawn and Landscape
            </div><br><br>

            <div id="LoginDiv">
                <h1 style="padding: 5%;"> Login </h1>
                <form name="login" method="post" enctype="multipart/form-data"> 
                

                <table id="table2"> 
                    <tr> 
                        <td> Username:</td>
                        <td> <input name="Uname" id="Uname" type="text"></td>
                    </tr>
                    <tr> 
                        <td> Password:</td>
                        <td> <input name="password1" id="password1" type="password"></td>
                    </tr>
                </table>

                <br> 

                <button type="submit" class="otherButtons">Login </button> <br> <br>
                </form>
            </div>
    </body>
    <?php 

        function is_data_valid() {
            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                return false;
            }

            if (empty($_REQUEST["Uname"]) || empty($_REQUEST["password1"])) {
                return false;
            }

            return true;
        }

        $conn = new mysqli("localhost", "root", "", "otherside llc");
        if ($conn->connect_error) {
            echo "Connection error";
        } 

        else if(is_data_valid()) {

            $email = $_REQUEST["Uname"];

            $stmt = $conn->prepare("SELECT Username, Password FROM User WHERE Username = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row) {
                $hash = $row["Password"];

                if (password_verify($_REQUEST["password1"], $hash)) {
                    
                    $_SESSION["Uname"] = $_REQUEST["Uname"];
                    $_SESSION["hash"] = $hash;
                    header("Location: /otherside/Home.php");
                } else {
                    echo "Login failed";
                }
            } else {
                echo "Login failed2";
            }

            $stmt->close();
        }           

        ob_end_flush();
    ?>
</html>