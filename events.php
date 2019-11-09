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

  $query = "SELECT * FROM `listing` WHERE Type LIKE 'Event' ORDER BY Date";
  $result = mysqli_query($conn, $query);
  $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_free_result($result);

  function getName($uid) {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Connection to database failed!");
    $query = "SELECT `Name`, `Email`, `Mobile` FROM `user` WHERE ID = '$uid'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user['Name'];
  }

  if(isset($_GET['lid'])) {
    $_SESSION['lid'] = $_GET['lid'];
    header("location: register.php");
  }
  
  mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
  <head>
      <?php require("res/header.php"); ?>
      <title>Listigo - Events</title>
      <style>
        .box {
          background-color: #fff;
          max-width: 1100px;
          margin: auto;
          padding: 0px;
          box-shadow: 0 2px 10px rgba(0,0,0,.075);
          margin-top: 10px;
          margin-bottom: 10px;
        }

        .titler {
          margin-top: 50px;
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
            <li class="nav-item" role="presentation"><a class="nav-link active" href="events.php">Events</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="workshop.php">Workshop</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="volunteer.php">Volunteer</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link btn btn-outline-primary" href="<?php echo $loc; ?>" role="button"><?php echo $btn; ?></a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="titler">
      <h2>Events Listing</h2>
    </div>

    <?php foreach($posts as $post): ?>
    <div class="container list-group box">
      <li class="list-group-item list-group-item-action">
        <div class="row">
          <div class="col-lg-5">
            <h1 class="text-left text-primary"><?php echo $post['Date'] ?></h1>
          </div>
          <div class="col-lg-7">
            <h3><?php echo $post['Title'] ?></h3>
            <small>by <?php echo getName($post['UID']); ?></small>
            <br><br>
            <p><?php echo $post['Description'] ?></p>
            <a class="btn btn-outline-primary btn-sm" role="button" href="events.php?lid=<?php echo $post['LID']; ?>">MORE INFO</a>
          </div>
        </div>
      </li>
     </div>
     <?php endforeach; ?>  
      
     <?php require("res/footer.php"); ?>
  </body>
</html>