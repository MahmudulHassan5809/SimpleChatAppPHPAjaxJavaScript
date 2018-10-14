<!-- Include header.php -->
<?php include 'inc/header.php'; ?>
<!-- end of header.php  -->

<!-- Passed Form Input To User Class -->
  <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $changePass = $user->changePass($_POST);
   }

   ?>
<!-- End of Passing input -->

<div class="container">



    <div class="row">

       <?php include 'inc/sidebar.php'; ?>


        <div class="col-md-8">

            <?php if(isset($changePass) && is_string($changePass)): ?>
                     <div class="alert-danger alert">
                     <?php echo $changePass; ?>
                     </div>
            <?php endif; ?>

                                <form action="" method="POST">
                                    <div class="form-group">
                                        <input class="form-control" name="password" type="password" placeholder="Current Password">
                                        <div class="alert-danger">
                                            <?php if(isset($changePass['password_error'])): ?>
                                                 <?php echo $changePass['password_error']; ?>
                                            <?php endif; ?>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <input class="form-control" name="new_password" type="password" placeholder="New Password">
                                        <div class="alert-danger">
                                        <?php if(isset($changePass['new_password_error'])): ?>
                                             <?php echo $changePass['new_password_error']; ?>
                                        <?php endif; ?>
                                        </div>
                                    </div>

                                <input type="submit" value="Change Password" class="btn btn-lg icon-btn-save btn-success" name="submit">


                          </form>
                        </div>
                    </div>
                </div>








<!-- footer.php -->
<?php include 'inc/footer.php'; ?>
<!-- End Of footer.php -->
