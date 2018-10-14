<!-- include.php -->
<?php include 'inc/include.php'; ?>
<!-- End Of include.php -->

<!-- Check Login -->
<?php Session::checkLogin(); ?>
<!-- End Of Check Login -->

<!-- Passed Form Input To User Class -->
  <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
       $userRegister = $user->userRegister($_POST , $_FILES);
   }
   ?>
<!-- End of Passing input -->











<!DOCTYPE html>
<html lang="en">
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<!-- Website CSS style -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link rel="stylesheet" href="style.css">
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

		<title>Sign UP</title>
	</head>
	<body style="background: gray;">
		<div class="container">
			<div class="row main">
				<div class="main-login main-center col-md-8 col-md-offset-2">
				<h3 class="text-center text-dark">Please Signup To Start Chat With Friends.....</h3>

				 <?php if(isset($userRegister) && is_string($userRegister)): ?>
				     <div class="alert-danger alert">
                     <?php echo $userRegister; ?>
                     </div>
                 <?php endif; ?>

					<form class="" method="POST" action="" enctype="multipart/form-data">

						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Your Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="full_name" id="name"  placeholder="Enter your Name"/>
								</div>

								<div class="alert-danger">
										<?php if(isset($userRegister['name_error'])): ?>
						                     <?php echo $userRegister['name_error']; ?>
						                <?php endif; ?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
								</div>
								<div class="alert-danger">
										<?php if(isset($userRegister['email_error'])): ?>
						                     <?php echo $userRegister['email_error']; ?>
						                <?php endif; ?>
								</div>
							</div>
						</div>


						<div class="form-group">
							<label for="file" class="cols-sm-2 control-label">Photo</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="file"  name="img" id="file" />
									<div class="alert-danger">
										<?php if(isset($userRegister['image_error'])): ?>
						                     <?php echo $userRegister['image_error']; ?>
						                <?php endif; ?>
									</div>
								</div>
							</div>
						</div>



						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
								</div>

								<div class="alert-danger">
										<?php if(isset($userRegister['password_error'])): ?>
						                     <?php echo $userRegister['password_error']; ?>
						                <?php endif; ?>
								</div>
							</div>
						</div>




						<div class="form-group ">
							<input type="submit" name="submit" class="btn btn-primary btn-lg btn-block login-button" value="Sign UP">

						</div>

					</form>
				</div>
			</div>
		</div>

		 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	</body>
</html>
