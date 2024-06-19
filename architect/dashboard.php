<?php 
session_start();
require_once('../db_connect.php');

if(!isset($_SESSION['logged']) && !$_SESSION['logged']){
  header("Location: login.php");
}

$id_user = $_SESSION['id_user'];

$new = $conn->query("SELECT COUNT(id) as total FROM appointments WHERE id_arsitek = $id_user AND status = 'new'");
$approved = $conn->query("SELECT COUNT(id) as total FROM appointments WHERE id_arsitek = $id_user AND status = 'approved'");
$cancelled = $conn->query("SELECT COUNT(id) as total FROM appointments WHERE id_arsitek = $id_user AND status = 'cancelled'");
$all = $conn->query("SELECT COUNT(id) as total FROM appointments WHERE id_arsitek = $id_user");

$new = mysqli_fetch_assoc($new);
$approved = mysqli_fetch_assoc($approved);
$cancelled = mysqli_fetch_assoc($cancelled);
$all = mysqli_fetch_assoc($all);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Architect - Dashboard</title>
    
    <link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
    <!-- build:css assets/css/app.min.css -->
    <link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="libs/bower/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/core.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <!-- endbuild -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
    <script src="libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
</head>
    
<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->
<?php include_once('includes/header.php');?>

<?php include_once('includes/sidebar.php');?>
<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">
            <div class="row">
                
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="widget stats-widget">
                            <div class="widget-body clearfix">
                                <div class="pull-left">
                                    <h3 class="widget-title text-warning"><span class="counter" data-plugin="counterUp"><?= $new['total'] ?></span></h3>
                                    <small class="text-color">New Appointment</small>
                                </div>
                                <span class="pull-right big-icon watermark"><i class="fa fa-paperclip"></i></span>
                            </div>
                        </div><!-- .widget -->
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <div class="widget stats-widget">
                            <div class="widget-body clearfix">
                                <div class="pull-left">
                                    <h3 class="widget-title text-success"><span class="counter" data-plugin="counterUp"><?= $approved['total'] ?></span></h3>
                                    <small class="text-color">Approved Appointment</small>
                                </div>
                                <span class="pull-right big-icon watermark"><i class="fa fa-ban"></i></span>
                            </div>
                        </div><!-- .widget -->
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <div class="widget stats-widget">
                            <div class="widget-body clearfix">
                                <div class="pull-left">
                                    <h3 class="widget-title text-danger"><span class="counter" data-plugin="counterUp"><?= $cancelled['total'] ?></span></h3>
                                    <small class="text-color">Cancelled Appointment</small>
                                </div>
                                <span class="pull-right big-icon watermark"><i class="fa fa-unlock-alt"></i></span>
                            </div>
                        </div><!-- .widget -->
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <div class="widget stats-widget">
                            <div class="widget-body clearfix">
                                <div class="pull-left">
                                    <h3 class="widget-title text-primary"><span class="counter" data-plugin="counterUp"><?= $all['total'] ?></span></h3>
                                    <small class="text-color">Total Appointment</small>
                                </div>
                                <span class="pull-right big-icon watermark"><i class="fa fa-file-text-o"></i></span>
                            </div>
                        </div><!-- .widget -->
                    </div>
                </div><!-- .row -->

            <div class="row">
            
        </section><!-- #dash-content -->
    </div><!-- .wrap -->
    <!-- APP FOOTER -->
    <?php include_once('includes/footer.php');?>
    <!-- /#app-footer -->
</main>
<!--========== END app main -->


<!-- build:js assets/js/core.min.js -->
<script src="libs/bower/jquery/dist/jquery.js"></script>
<script src="libs/bower/jquery-ui/jquery-ui.min.js"></script>
<script src="libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
<script src="libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
<script src="libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="libs/bower/PACE/pace.min.js"></script>
<!-- endbuild -->

<!-- build:js assets/js/app.min.js -->
<script src="assets/js/library.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/app.js"></script>
<!-- endbuild -->
<script src="libs/bower/moment/moment.js"></script>
<script src="libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="assets/js/fullcalendar.js"></script>
</body>
</html>
