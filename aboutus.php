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
			<title>Listigo - About Us</title> 
			<style>
				.titler h2 {
          margin-top: 80px;
				}
				
				.icons a{
					margin: 5px;
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
				<h2>This Is Us</h2>
				<hr class="rgba-white-light" style="margin: 0 15%;"><br>
          <div class="row justify-content-center">
              <div class="col-sm-6 col-lg-3">
                  <div class="card clean-card text-center"><img class="card-img-top w-100 d-block" src="image/Avatar/Pranshu.jpeg">
                      <div class="card-body info">
                          <h4 class="card-title">Pranshu Datta</h4>
                          <p class="card-text">Database Manager</p>
                          <div class="icons">
														<a href="https://www.facebook.com/pranshudatta25" target="_blank"><i class="fab fa-facebook-f"></i></a>
														<a href="https://instagram.com/_pranshudatta" target="_blank"><i class="fab fa-instagram"></i></a>
														<a href="https://github.com/pranshudatta25" target="_blank"><i class="fab fa-github"></i></a>
													</div>
                      </div>
                  </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                  <div class="card clean-card text-center"><img class="card-img-top w-100 d-block" src="image/Avatar/Praveen.jpg">
                      <div class="card-body info">
                          <h4 class="card-title">Praveen Raj</h4>
                          <p class="card-text">Full Stack Developer</p>
                          <div class="icons">
														<a href="https://www.facebook.com/praveenclaws7" target="_blank"><i class="fab fa-facebook-f"></i></a>
														<a href="https://www.instagram.com/pc799" target="_blank"><i class="fab fa-instagram"></i></a>
														<a href="https://github.com/pc799" target="_blank"><i class="fab fa-github"></i></a>
													</div>
                      </div>
                  </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                  <div class="card clean-card text-center"><img class="card-img-top w-100 d-block" src="image/Avatar/Srikanth.jpg">
                      <div class="card-body info">
                          <h4 class="card-title">Srikanth Sarma</h4>
                          <p class="card-text">Visual Designer</p>
                          <div class="icons">
														<a href="https://www.facebook.com/srikanthsarma145" target="_blank"><i class="fab fa-facebook-f"></i></a>
														<a href="https://instagram.com/srikanthsarma145" target="_blank"><i class="fab fa-instagram"></i></a>
														<a href="https://github.com/srikanthsarma145" target="_blank"><i class="fab fa-github"></i></a>
													</div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
	<br><hr class="rgba-white-light" style="margin: 0 15%;"><br><br>
    
	<?php require("res/footer.php"); ?>  
	</body>
</html>