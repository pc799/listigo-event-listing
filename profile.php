<?php
  require("res/config.php");
  session_start();

  if(isset($_SESSION['idno'])) {
    $idno = $_SESSION['idno'];
    $query = "SELECT `Name`, `ID`, `Password`, `Email`, `Mobile` FROM `user` WHERE ID = '$idno'";
    $result1 = mysqli_query($conn, $query);
    $post = mysqli_fetch_assoc($result1);
    mysqli_free_result($result1);

    $query = "SELECT `Title`,`LID` FROM `listing` WHERE UID = '$idno'";
    $result2 = mysqli_query($conn, $query);
    $banner = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    mysqli_free_result($result2);
  }
  else {
    header("location: index.php");
  }

  if(isset($_POST['submit'])) {
    $name = htmlentities($_POST['name']);
    $password = htmlentities($_POST['password']);
    $email = htmlentities($_POST['email']);
    $mobile = htmlentities($_POST['mobile']);

    $query = "UPDATE `user` SET `Name`='$name',`Password`='$password',`Email`='$email',`Mobile`='$mobile' WHERE ID = '$idno'";
    if(mysqli_query($conn, $query))
      header("refresh: 0");
    else {
      echo '<script type="text/javascript">';
      echo ' alert("Update Failed. Try again!")';
      echo '</script>';
    }
  }

  if(isset($_POST['delete'])) {
    $title = htmlentities($_POST['title']);

    $query = "DELETE FROM `listing` WHERE Title LIKE '$title'";
    if(mysqli_query($conn, $query))
      header("refresh: 0");
    else {
      echo '<script type="text/javascript">';
      echo ' alert("Delete Failed. Try again!")';
      echo '</script>';
    }
  }

  if(isset($_GET['logout'])) {
    session_destroy();
    header("location: index.php");
  }

  mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
  <head>
      <?php require("res/header.php"); ?>
      <title>Listigo - Profile</title>
      <style>
        .titler {
          border-top: 2px solid #5ea4f3;
          background-color: #fff;
          max-width: 500px;
          margin: auto;
          padding: 40px;
          box-shadow: 0 2px 10px rgba(0,0,0,.075);
          margin-top: 70px;
          margin-bottom: 50px;
        }

				input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
          -webkit-appearance: none; 
          margin: 0; 
        }

        .logout {
          margin-top: 40px;
          margin-left: 12.5vmax;
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
            <li class="nav-item" role="presentation"><a class="nav-link btn btn-outline-primary active" href="profile.php" role="button">PROFILE</a></li>
          </ul>
        </div>
      </div>
    </nav>
        
    <div class="container titler">
    <div class="list-group">
        <li class="list-group-item list-group-item-action active">Profile</li>
        <li class="list-group-item list-group-item-action">
          <small>ID Number</small>
          <div id="idno"><?php echo $post["ID"]; ?></div>
        </li>
        <li class="list-group-item list-group-item-action"> 
					<small>Name</small>
					<div id="name"><?php echo $post["Name"]; ?></div>
				</li>
				<li class="list-group-item list-group-item-action">
					<small>Email</small>
					<div id="email"><?php echo $post["Email"]; ?></div>
				</li>
				<li class="list-group-item list-group-item-action">
					<small>Mobile</small>
					<div id="mob"><?php echo $post["Mobile"]; ?></div>
				</li>
				<li class="list-group-item list-group-item-action">
					<small>Password</small>
					<div id="pass">********</div>
				</li>
        <button  class="btn btn-primary" data-toggle="modal" href="#editName">EDIT</button>
				<li class="list-group-item list-group-item-action"></li>
    </div>   

    <div class="list-group">
      <li class="list-group-item list-group-item-action active">Posts</li>
      <?php foreach($banner as $i => $title) : ?>
        <a data-toggle="modal" href="#viewPost" class="list-group-item list-group-item-action" data-index="<?php echo $title['Title']; ?>" data-lid="<?php echo $title['LID']; ?>"><?php echo $title['Title']; ?></a>
      <?php endforeach; ?>
    </div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <button name="logout" class="btn btn-primary btn-danger logout" >LOGOUT</button>
    </form>
    </div>
		
		<div class="modal fade" id="editName" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
   			<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="editNameLabel" style="color: rgba(9, 162, 255, 0.85);">Edit profile</h5>
        		<button type="button" class="close" data-dismiss="modal">
          		<span>&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
							<form class="needs-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" novalidate>
									<div class="form-group">
										<label for="name">Name</label>
										<input name="name" type="text" class="form-control" id="name" value="<?php echo $post['Name']; ?>">
									</div>           
									<div class="form-group">
										<label for="email">Email address</label>
										<input name="email" type="email" class="form-control" id="email" value="<?php echo $post['Email']; ?>">
									</div>
									<div class="form-group">
										<label for="mobile">Mobile number</label>
										<input name="mobile" type="number" class="form-control" id="mobile" value="<?php echo $post['Mobile']; ?>">
									</div>
									<div class="form-group">
										<label for="password">Password</label>
										<input name="password" type="password" class="form-control" id="password" value="<?php echo $post['Password']; ?>">
                  </div>
                  
					        <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						        <button name="submit" type="submit" class="btn btn-primary">Save changes</button>
					        </div>
							</form>
					</div>
				</div>
			</div>
    </div>
    
    <div class="modal" id="viewPost" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Click to view attendees:
            <a href="#" download>Responses.csv</a>
          </div>
          <div class="modal-footer">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="hidden" name="title" value="">
            <button name="delete" type="submit" class="btn btn-primary btn-danger">Delete Post</button>
            </form>
          </div>
        </div>
      </div>
    </div>


    <?php require("res/footer.php"); ?>
    <script>
      $('#viewPost').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var title = button.data('index')
        var lid = 'res/sheet/' + button.data('lid') + '.csv'
        console.log(lid)
        var modal = $(this)
        modal.find('.modal-title').text(title)
        modal.find('.modal-footer input').val(title)
        modal.find('.modal-body a').text(title)
        modal.find('.modal-body a').attr('href', lid)
      })
    </script>
  </body>
</html>