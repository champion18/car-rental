<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['agencylogin']) == 0) {
	header('location:index.php');
} else { ?>

	<?php
	$agencyemail = $_SESSION['agencylogin'];
	$sql = "SELECT * from agencies where Email=:agencyemail";
	$query = $dbh->prepare($sql);
	$query->bindParam(':agencyemail', $agencyemail, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetch(PDO::FETCH_OBJ);
	$agencyId = $results->id;
	if ($query->rowCount() > 0) {
		echo "<script>alert($agencyId);</script>";
	} ?>

	<!doctype html>
	<html lang="en" class="no-js">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">

		<title>Car Rental Portal |Admin Manage Vehicles </title>

		<!-- Font awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Sandstone Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">
		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #dd3d36;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #5cb85c;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>

	</head>

	<body>
		<?php include('includes/header.php'); ?>

		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title">Manage Bookings</h2>
							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								<div class="panel-heading">Vehicle Details</div>
								<div class="panel-body">
						
									<table id="zctb" class="display table table-striped table-bordered table-hover"
										cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Vehicle Title</th>
												<th>Customer Name</th>
												<th>Customer Email</th>
												<th>Customer Mob. No.</th>
												<th>Booking Start Date</th>
												<th>Days Rented</th>
												<th>Booking Date</th>
												<th>Amount</th>
											</tr>
										</thead>
										<tbody>

											<?php $sql = "SELECT b.id, v.VehicleTitle, u.FullName, u.Email, u.ContactNo, b.Amount, b.DaysRented, b.StartDate, b.BookingDate
															FROM bookings b
															JOIN users u ON b.UserEmail = u.Email
															JOIN vehicles v ON b.VehicleId = v.id
															WHERE b.AgencyId = $agencyId";


											$query = $dbh->prepare($sql);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) { ?>
													<tr>
														<td>
															<?php echo htmlentities($cnt); ?>
														</td>
														<td>
															<?php echo htmlentities($result->VehicleTitle); ?>
														</td>
														<td>
															<?php echo htmlentities($result->FullName); ?>
														</td>
														<td>
															<?php echo htmlentities($result->Email); ?>
														</td>
														<td>
															<?php echo htmlentities($result->ContactNo); ?>
														</td>
														<td>
															<?php echo htmlentities($result->StartDate); ?>
														</td>
														<td>
															<?php echo htmlentities($result->DaysRented); ?>
														</td>
														<td>
															<?php echo htmlentities($result->BookingDate); ?>
														</td>
														<td>
															<?php echo htmlentities($result->Amount); ?>
														</td>

													</tr>
													<?php $cnt = $cnt + 1;
												}
											} ?>

										</tbody>
									</table>



								</div>
							</div>



						</div>
					</div>

				</div>
			</div>
		</div>

		<!-- Loading Scripts -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="js/Chart.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/chartData.js"></script>
		<script src="js/main.js"></script>
	</body>

	</html>
<?php } ?>