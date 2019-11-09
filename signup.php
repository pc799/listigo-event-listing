<?php
  require("res/config.php");

  if(isset($_POST['submit'])) {
    $name = htmlentities($_POST['name']);
    $idno = htmlentities($_POST['idno']);
    $password = htmlentities($_POST['password']);
    $email = htmlentities($_POST['email']);
    $mobile = htmlentities($_POST['mobile']);

    $query = "INSERT INTO `user` VALUES ('$name', '$idno', '$password', '$email', '$mobile', 0)";

    if(mysqli_query($conn, $query))
      header("location: login.php");
    else {
      echo '<script type="text/javascript">';
      echo ' alert("Signup Failed. Try again!")';
      echo '</script>';
    }
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
          max-width: 500px;
          margin: auto;
          padding: 40px;
          box-shadow: 0 2px 10px rgba(0,0,0,.075);
          
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
      <h2>Oh, Hey!</h2>
      <form class="needs-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" novalidate>
        <div class="form-group">
          <label for="name">Name</label>
          <input name="name" type="text" class="form-control" id="name" placeholder="Enter name" required>
        </div>
        <div class="form-group">
          <label for="idno">ID Number</label>
          <input name="idno" type="number" class="form-control" id="idno" placeholder="Registration no. / employee code" required>
          <small class="form-text text-muted">This ID will be used for login.</small>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input name="password" type="password" class="form-control" id="password" placeholder="********" required>
        </div>           
        <div class="form-group">
          <label for="email">Email address</label>
          <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com" required>
        </div>
        <div class="form-group">
          <label for="mobile">Mobile number</label>
          <input name="mobile" type="number" class="form-control" id="Mobile" placeholder="99XXXXXXXX" required>
        </div>
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="terms" required>
          <label class="form-check-label" for="terms">
            Accept the <a href="#">Terms</a>
          </label>
          <div class="invalid-feedback">
            You must accept before submitting.
          </div>
        </div>
        <button name="submit" type="submit" class="btn btn-primary">JOIN</button>
      </form>
    </div>
    
    <script src="script/form.js"></script>    
    <?php require("res/footer.php"); ?>
  </body>
</html>