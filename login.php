<?php
  require("res/config.php");
  session_start();

  if(isset($_POST['submit'])) {
    $idno = htmlentities($_POST['idno']);
    $password = htmlentities($_POST['password']);

    $query = "SELECT `ID`, `Password` FROM `user` WHERE ID = '$idno'";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
		  $row = mysqli_fetch_assoc($result);
		  if($row["Password"] == $password) {
        $_SESSION["idno"] = $idno;
        header("location: index.php");
      }
		  else {
        echo '<script type="text/javascript">';
        echo ' alert("Invalid Password!")';
        echo '</script>';
      }
	  }
	  else {
      echo '<script type="text/javascript">';
      echo ' alert("Invalid ID!")';
      echo '</script>';
    }

    mysqli_free_result($result);
  }
  mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
  <head>
      <?php require("res/header.php"); ?>
      <title>Listigo - Sign up</title>
      <style>
        .titler {
          border-top: 2px solid #5ea4f3;
          background-color: #fff;
          max-width: 400px;
          margin: auto;
          padding: 40px;
          box-shadow: 0 2px 10px rgba(0,0,0,.075);
          margin-top: 70px;
          margin-bottom: 50px;
        }

        .new {
          margin-top: 20px;
          margin-bottom: -30px;
          padding:20px 25px;
          text-align:center;
          font-size: 0.9rem;
        }

        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
          -webkit-appearance: none; 
          margin: 0; 
        }
      </style>
  </head>
  <body>
    
   <nav class="navbar navbar-light navbar-expand-lg fixed-top clean-navbar" style="background-color: #e3f2fd">
      <div class="container">
        <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="navbar-toggler-icon"></span></button>
        <a class="navbar-brand" href="index.php">Listigo</a>
        <div class="collapse navbar-collapse" id="navcol-1">
          <ul class="nav navbar-nav ml-auto">
            <li class="nav-item" role="presentation"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="events.php">Events</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="workshop.php">Workshop</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="volunteer.php">Volunteer</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link btn btn-outline-primary active" href="login.php" role="button">LOGIN</a></li>
          </ul>
        </div>
      </div>
    </nav>
      
    <div class="container titler">
      <h2>Hello, friend!</h2>
      <form class="needs-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" novalidate>
        <div class="form-group">
          <label for="idno">ID Number</label>
          <input name="idno" type="number" class="form-control" id="idno" placeholder="Registration no. / Employee code" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input name="password" type="password" class="form-control" id="password" placeholder="********" required>
          <small class="form-text"><a class="" href="#">Reset password</a></small>
        </div>
        <div class="form-group form-check">
            <input name="rem" type="checkbox" class="form-check-input" id="rem">
            <label class="form-check-label" for="rem">
              Remember me
            </label>
        </div>
        <button name="submit" type="submit" class="btn btn-primary">LOGIN</button>

        <div class="jumbotron new">
            <a href="signup.php">Create an account</a>
        </div>
      </form>
    </div>
    
    <?php require("res/footer.php"); ?>
  </body>
</html>