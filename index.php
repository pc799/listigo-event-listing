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

  $query = "SELECT * FROM `listing`";
  $result = mysqli_query($conn, $query);
  $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
  //print_r($posts);
  mysqli_free_result($result);

?>
<!doctype html>
<html lang="en">
  <head>
      <?php require("res/header.php"); ?>
      <title>Listigo - Home</title>
      <style>
        .header {
          text-align: center;
          background-color: rgba(9, 162, 255, 0.85);
          padding: 10%;
          color: white;
        }

        .titler nav a {
          margin: 5px;
        }

        .navigation {
          margin: 50px;
        }    
  
        .navigation h4 {
          font-size: 2rem;
          padding-top: 40%;
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
            <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php">Home</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="events.php">Events</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="workshop.php">Workshop</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="volunteer.php">Volunteer</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link btn btn-outline-primary" href="<?php echo $loc; ?>" role="button"><?php echo $btn; ?></a></li>
          </ul>
        </div>
      </div>
    </nav>
  
    
    <div class="header">
      <h1>Gather your tribe</h1>
      <p>
        From Departmental fests and dinners to technical workshops, find all the happenings in and around the college.
      </p><br> 
      <a class="btn btn-light btn-lg" href="post.php" role="button">POST EVENT</a>
    </div>
    
    <div class="jumbotron titler">
      <h2>Discover Experience</h2>
      <hr class="rgba-white-light" style="margin: 0 15%;"><br>
      <nav class="nav flex-column">
        <a class="btn btn-outline-primary nav-link" href="events.php">Events</a>
        <a class="btn btn-outline-primary nav-link" href="workshop.php">Workshop</a>
        <a class="btn btn-outline-primary nav-link" href="volunteer.php">Volunteer</a>
      </nav>
    </div>
      
    <div class="container-fluid titler">
      <h2>Featured Listing</h2>
      <div class="">
        <div id="carousel-Controls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="image/Banner/0.png" class="d-block w-100">
              </div>
              <?php foreach($posts as $post): ?>
              <div class="carousel-item">
                <?php echo '<img src="data:' . $post["MIME"] . ';base64,' . base64_encode($post["Banner"]) . '" class="d-block w-100" >'; ?>
              </div>
              <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#carousel-Controls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#carousel-Controls" role="button" data-slide="next">
              <span class="carousel-control-next-icon"></span>
            </a>
        </div>
      </div>
    </div>
    
    <br><hr class="rgba-white-light" style="margin: 0 15%;">
    
    <?php require("res/footer.php"); ?>  
  </body>
</html>