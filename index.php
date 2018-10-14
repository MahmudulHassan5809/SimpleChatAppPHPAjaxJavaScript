

<!-- Include header.php -->
<?php include 'inc/header.php'; ?>
<!-- end of header.php  -->



<div class="container">



    <div class="row">

       <?php include 'inc/sidebar.php'; ?>


        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading" id="accordion">
                   <h3 class="text-primary mb-3">Chat With Your Friends...</h3>
                </div>
            </div>
            <div>
                <div class="panel-body">
                    <!-- Chat Area -->
                       <?php include 'inc/chat.php'; ?>
                    <!-- End Chat Area -->
                </div>
                <div class="panel-footer">
                    <!-- Chat Form -->
                      <?php include 'inc/chat_form.php'; ?>
                    <!-- End Chat Form -->
                </div>
            </div>
            </div>
        </div>
    </div>
</div>






<!-- footer.php -->
<?php include 'inc/footer.php'; ?>
<!-- End Of footer.php -->
