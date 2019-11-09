<?php
  require("res/config.php");
  session_start();

  if(isset($_SESSION['idno'])) {
    $idno = $_SESSION['idno'];

    if(isset($_POST['submit'])) {
      $title = htmlentities($_POST['title']);
      $loc = htmlentities($_POST['loc']);
      $date = htmlentities($_POST['date']);
      $desc = htmlentities($_POST['desc']);
      $type = htmlentities($_POST['type']);
      $mime = $_FILES['banner']['type'];
      $banner = addslashes(file_get_contents($_FILES['banner']['tmp_name']));
      if($date < date("Y-m-d")) {
        echo '<script type="text/javascript">';
        echo ' alert("Please provide a valid date!")';
        echo '</script>';
        header("refresh: 0");
      }

      $query = "INSERT INTO `listing` (`Title`, `Location`, `Date`, `Description`, `Banner`, `MIME`, `Type`, `UID`) VALUES ('$title', '$loc', '$date', '$desc', '$banner', '$mime', '$type', '$idno')";
  
      if(mysqli_query($conn, $query))
        header("location: profile.php");
      else {
        //echo mysqli_error($conn);
        echo '<script type="text/javascript">';
        echo ' alert("Listing Failed. Try again!")';
        echo '</script>';
        header("refresh: 0");
      }
    }
  }
  else {
    header("location: login.php");
  }

  mysqli_close($conn);

?>

<!doctype html>
<html lang="en">
  <head>
      <?php require("res/header.php"); ?>

      <title>Listigo - Post</title>
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

				input[type=date]::-webkit-inner-spin-button {
    			-webkit-appearance: none;
    			display: none;
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
            <li class="nav-item" role="presentation"><a class="nav-link btn btn-outline-primary" href="profile.php" role="button">PROFILE</a></li>
          </ul>
        </div>
      </div>
    </nav>
  
      
    <div class="container titler">
      <h2>What's Happening?</h2>
      <form class="needs-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" novalidate>
        <div class="form-group">
          <label for="title">Title</label>
          <input name="title" type="text" class="form-control" id="title" placeholder="Enter title" required>
        </div>
        <div class="form-group">
          <label for="loc">Location</label>
          <input name="loc" type="text" class="form-control" id="loc" placeholder="Enter venue" required>
        </div>
        <div class="form-group">
          <label for="date">Date</label>
          <input name="date" type="date" class="form-control" id="date" required>
        </div>           
        <div class="form-group">
          <label for="desc">Description</label>
          <textarea name="desc" class="form-control" id="desc" rows="6"></textarea>
        </div>
        <div class="form-group">
          <label for="banner">Banner</label>
					<input name="banner" type="file" class="form-control-file" id="banner" accept="image/*">
					<small class="form-text text-muted">We recommend using a 820x312px image that's no larger than 10MB.</small>
				</div>
				<div class="form-group">
      		<label for="type">Type</label>
      		<select name="type" id="type" class="form-control">
        		<option selected>Event</option>
						<option>Workshop</option>
						<option>Volunteer</option>
      		</select>
    		</div>
			
        <button name="submit" type="submit" class="btn btn-primary">POST</button>
      </form>
    </div>

    
    <?php require("res/footer.php"); ?>
    <script>
			var file = document.getElementById('banner');

			file.onchange = function(e) {
 			var ext = this.value.match(/\.([^\.]+)$/)[1];
  		switch (ext) {
    		case 'jpg':
    		case 'bmp':
    		case 'png':
      		break;
    		default:
      		alert('Invalid image format. Please upload a jpeg, png, or bmp.');
      	this.value = '';
  		}
			};
		</script>
  </body>
</html>