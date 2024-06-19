<?php 
session_start();
require_once('../db_connect.php');

if(!isset($_SESSION['logged']) && !$_SESSION['logged']){
  header("Location: login.php");
}

$id_user = $_SESSION['id_user'];

$appointments = $conn->query("SELECT * FROM appointments LEFT JOIN user ON user.id_user = appointments.id_user WHERE id_arsitek = $id_user");
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>Your Architect | Appointment</title>

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
	<script>
		Breakpoints();
	</script>
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
					<!-- DOM dataTable -->
					<div class="col-md-12">
						<div class="widget">
							<header class="widget-header">
								<h4 class="widget-title">All Appointment</h4>
							</header><!-- .widget-header -->
							<hr class="widget-separator">
							<div class="widget-body">
								<div class="table-responsive">
									<table
										class="table table-bordered table-hover js-basic-example dataTable table-custom">
										<thead>
											<tr>
												<th>ID</th>
												<th>Name</th>
												<th>Mobile Number</th>
												<th>Email</th>
												<th>Date of appointment</th>
												<th>Message</th>
												<th>Zoom</th>
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												while($row = mysqli_fetch_assoc($appointments)) :
												
												$link = !empty($row['link']) ? '<a href="' . $row['link'] . '" target="_blank">Gabung</a>' : '-';
											?>
											<tr>
												<th><?= $row['id'] ?></th>
												<th><?= $row['nama'] ?></th>
												<th><?= $row['no_hp'] ?></th>
												<th><?= $row['email'] ?></th>
												<th><?= $row['date'] ?></th>
												<th><?= $row['message'] ?></th>
												<td>
													<?= $link ?>
												</td>
												<th>
													<?php
														if ($row['status'] == 'approved') {
															echo '<span class="badge badge-success">Approved</span>';
														} elseif ($row['status'] == 'cancelled') {
															echo '<span class="badge badge-danger">Cancelled</span>';
														} else {
															echo '<span class="badge badge-secondary">' . ucfirst($row['status']) . '</span>';
														}
													?>
												</th>
												<th>
													<?php if($row['status'] == 'new' || $row['status'] == 'cancelled') : ?>
													<button class="btn btn-success btn-approve"
														data-id="<?= $row['id'] ?>">Approve</button>
													<?php endif; ?>
													<?php if($row['status'] == 'new' || $row['status'] == 'approved') : ?>
													<button class="btn btn-danger btn-cancel"
														data-id="<?= $row['id'] ?>">Cancel</button>
													<?php endif; ?>
													<?php if($row['status'] == 'approved') : ?>
													<button class="btn btn-primary btn-report"
														data-id="<?= $row['id'] ?>">Report</button>
													<?php endif; ?>
												</th>
											</tr>
											<?php endwhile;?>
										</tbody>
									</table>
								</div>
							</div><!-- .widget-body -->
						</div><!-- .widget -->
					</div><!-- END column -->


				</div><!-- .row -->
			</section><!-- .app-content -->
		</div><!-- .wrap -->
		<!-- APP FOOTER -->
		<?php include_once('includes/footer.php');?>
		<!-- /#app-footer -->
	</main>
	<!--========== END app main -->

	<!-- Modal Report -->
	<div id="reportModal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Report Appointment</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="reportForm" enctype="multipart/form-data">
						<input type="hidden" name="appointment_id" id="appointment_id">
						<div class="form-group">
							<label for="note">Catatan</label>
							<textarea class="form-control" id="note" name="note" rows="3" required></textarea>
						</div>
						<div class="form-group">
							<label for="attachment">Lampiran</label>
							<input type="file" class="form-control-file" id="attachment" name="attachment">
						</div>
						<button type="submit" class="btn btn-primary">Buat Report</button>
					</form>
				</div>
			</div>
		</div>
	</div>


	<!-- APP CUSTOMIZER -->
	<?php include_once('includes/customizer.php');?>


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
	<script>
		$(document).ready(function () {
			$('.btn-approve').click(function () {
				var id = $(this).data('id');
				updateStatus(id, 'approved');
			});

			$('.btn-cancel').click(function () {
				var id = $(this).data('id');
				updateStatus(id, 'cancelled');
			});

			function updateStatus(id, status) {
				$.ajax({
					url: 'update_status.php',
					type: 'POST',
					data: {
						id: id,
						status: status
					},
					success: function (response) {
						var res = JSON.parse(response);
						if (res.success) {
							location.reload();
						} else {
							alert('Error: ' + res.error);
						}
					},
					error: function () {
						alert('An error occurred. Please try again.');
					}
				});
			}

			$('.btn-report').click(function () {
				var id = $(this).data('id');
				$('#appointment_id').val(id);
				$('#reportModal').modal('show');
			});

			$('#reportForm').submit(function (event) {
				event.preventDefault();
				var formData = new FormData(this);

				$.ajax({
					url: 'submit_report.php',
					type: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					success: function (response) {
						var res = JSON.parse(response);
						if (res.success) {
							$('#reportModal').modal('hide');
							location.reload();
						} else {
							alert('Error: ' + res.error);
						}
					},
					error: function () {
						alert('An error occurred. Please try again.');
					}
				});
			});
		});
	</script>
</body>

</html>