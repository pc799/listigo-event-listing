<?php
  require("res/config.php");
  session_start();

  if(isset($_SESSION['idno']) and isset($_SESSION['lid'])) {
    $btn = "PROFILE";
    $loc = "profile.php";
    $lid = $_SESSION['lid'];
    $query = "SELECT * FROM `listing` WHERE LID = '$lid'";
    $result = mysqli_query($conn, $query);
    $post = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
  }
  else {
    if(!isset($_SESSION['lid'])) {
      header("location: index.php");
    }
    else if(!isset($_SESSION['idno'])) {
      header("location: login.php");
    }
    $btn = "LOGIN";
    $loc = "login.php";
  }

  if(isset($_POST['register'])) {
    $id = $_SESSION['idno'];
    $name = "/opt/lampp/htdocs/listigo/res/sheet/" . $_SESSION['lid'] . ".csv";
    $file = fopen($name, 'a');
    chmod($name, 0777);
    $sql = "SELECT `Name`,`Email`,`Mobile` FROM `user` WHERE ID = '$id'";
    
    if ($rows = mysqli_query($conn, $sql)) {
      while ($row = mysqli_fetch_assoc($rows)) {
        fputcsv($file, $row);
      }
      mysqli_free_result($rows);
    } 

    echo '<script type="text/javascript">';
    echo ' alert("Registration Successful!")';
    echo '</script>';
    header("refresh: 0");
  }

  function getName($uid) {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Connection to database failed!");
    $query = "SELECT `Name`, `Email`, `Mobile` FROM `user` WHERE ID = '$uid'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user['Name'];
  }

  mysqli_close($conn);
  
?>

<!doctype html>
<html lang="en">
  <head>
      <?php require("res/header.php"); ?>
      <title>Listigo - Register</title>
      <style>
         .titler {
          background-color: #fff;
          max-width: 1100px;
          margin: auto;
          padding: 40px;
          box-shadow: 0 2px 10px rgba(0,0,0,.075);
          margin-top: 70px;
          margin-bottom: 50px;
        }
      </style>
      <script src="https://kit.fontawesome.com/d37ada6351.js" crossorigin="anonymous"></script>
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
      <h2><?php echo $post['Title']; ?></h2>
      <div class="jumbotron">
        <p><i class="fas fa-clock"></i> <?php echo $post['Date']; ?></p>
        <p><i class="fas fa-map-marker-alt"></i> <?php echo $post['Location']; ?></p>
        <p><i class="fas fa-id-badge"></i><a href="#"> <?php echo getName($post['UID']); ?></a></p>
      </div>
      <figure class="figure">
        <!--img class="rounded img-fluid figure-img"-->
        <?php echo '<img src="data:' . $post["MIME"] . ';base64,' . base64_encode($post["Banner"]) . '" class="rounded img-fluid figure-img" >'; ?>;
      </figure>
      <h4>Description</h4>
      <div><?php echo $post['Description']; ?></div>
      <br>
      <form class="text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="hidden" name="lid" value="<?php echo $post['LID']; ?>">
        <button name="register" class="btn btn-primary btn-success" type="submit">REGISTER</button>
      </form>
    </div>
      
    <?php require("res/footer.php"); ?>
  </body>
</html>