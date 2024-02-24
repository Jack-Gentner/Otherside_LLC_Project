<!doctype html> <!--IMPORTANT: CHANGE SRC LINKS ONCE UPLOADED TO WEBSERVER-->
<html lang="en">

    <?php
        session_start();
    ?>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="edgewood.ico">
    <title>Create Account</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.4.1\dist\css\bootstrap.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="bootstrap-3.4.1\docs\assets\css\ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="createAcc.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Create an Account</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form method="post" role="form" class="create-form" name="signup">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name">
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
			    					</div>
			    				</div>
                                <div class="form-select form-select-sm">
                                    <select aria-label=".form-select-sm example" id='role' name='role'>
                                        <option selected>Select your role</option>
                                        <option value="Visitor">Visitor</option>
                                        <option value="Student">Student</option>
                                        <option value="Faculty">Faculty</option>
                                        <option value="Admin">Admin</option>
                                      </select>
                                </div>
			    			</div>
			    			
			    			<input type="submit" value="Register" name="Register" class="btn btn-info btn-block">
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
    <footer class="footer">
        <div class="container">
          <button type="button" class="btn btn-success left">Go Back</button>
        </div>
      </footer>
        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="bootstrap-3.4.1\docs\assets\js\vendor\jquery.min.js"><\/script>')</script>
    <script src="bootstrap-3.4.1\dist\js\bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="bootstrap-3.4.1\docs\assets\js\vendor\holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap-3.4.1\docs\assets\js\ie10-viewport-bug-workaround.js"></script>
  </body>

  <?php  

    $conn = new mysqli("localhost", "Admin", "pfsense", "tptest");

    if ($conn->connect_error) {
        echo "Connection error";
    }
      
    if(isset($_POST['Register'])){

      $email = $_REQUEST['email'];
      $f_name = $_REQUEST['first_name'];
      $l_name = $_REQUEST['last_name'];
      $pass = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
      $pass2 = password_hash($_REQUEST['password_confirmation'], PASSWORD_DEFAULT);
      $role = $_REQUEST['role'];

      if(empty($f_name)){
        echo("Missing First Name!");
      }elseif(empty($l_name)){
        echo("Missing Last Name!");
      }elseif(empty($email)){
        echo("Missing Email!");
      }elseif(empty($pass) || empty($pass2)){
        echo("Missing passwords");
      }elseif($_REQUEST['password'] != $_REQUEST['password_confirmation']){
        echo("Passwords do not match");
      }elseif(empty($role)){
        echo("Missing role");
      }else{
        $stmt = $conn->prepare("INSERT INTO newuser (Firstname, Lastname, Email, Password, RequstedRole) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $f_name, $l_name, $email, $pass, $role);
        $stmt->execute();
        $stmt->close();

        $_SESSION["email"] = $_REQUEST["email"];
        $_SESSION["hash"] = $pass;

        //add header to send user to site selection

      }


    }
    





  ?>
</html>