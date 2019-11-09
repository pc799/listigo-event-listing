<?php
  require("res/config.php");
  session_start();

  if(isset($_SESSION['idno'])) {
    $btn = "PROFILE";
    $loc = "profile.php";
  }
  else {
    $btn = "LOGIN";
    $loc = "login.php";
  }

?>
<!doctype html>
<html lang="en">
  <head>
      <?php require("res/header.php"); ?>  
      <title>Listigo - Contact</title>
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
            <li class="nav-item" role="presentation"><a class="nav-link btn btn-outline-primary" href="<?php echo $loc; ?>" role="button"><?php echo $btn; ?></a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="container titler">
      <h2>How can we help?</h2>
      <form class="needs-validation" action="https://formspree.io/mrggeqkk" method="POST" novalidate>
        <div class="form-group">
          <label for="name">Name</label>
          <input name="name" type="text" class="form-control" id="name" placeholder="Enter name" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input name="_replyto" type="email" class="form-control" id="email" placeholder="name@example.com" required>
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea name="message" class="form-control" id="message" rows="3"></textarea>
        </div>
        <button name="submit" type="submit" class="btn btn-primary">SUBMIT</button>
      </form>
    </div>
    
    <?php require("res/footer.php"); ?>  
  </body>
</html>