<?php
	session_start();
	include('../global/model.php');
	include('department.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="" />
		<meta name="author" content="" />
		<meta name="robots" content="" />

		<meta name="description" content="" />

		<meta property="og:title" content="" />
		<meta property="og:description" content="" />
		<meta property="og:image" content="" />
		<meta name="format-detection" content="telephone=no">

		<link rel="icon" href="../assets/images/icon.png" type="image/x-icon" />
		<link rel="shortcut icon" type="image/x-icon" href="../assets/images/icon.png" />

		<title>College of Information and Computing Sciences - Capstone Project Directory System for IT Department</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/assets.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/vendors/calendar/fullcalendar.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/typography.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/shortcodes/shortcodes.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dashboard.css">
		<link class="skin" rel="stylesheet" type="text/css" href="../dashboard/assets/css/color/color-1.css">
	</head>
	<style type="text/css">
		.btn.dropdown-toggle.btn-default:hover {
			color: #000!important;
		}

		.btn.dropdown-toggle.btn-default:focus {
			color: #000!important;
		}

		tbody tr:hover {
			background-color: #d4d4d4;
		}
		.widget-card .icon {
			position: absolute;
			top: auto;
			bottom: -20px;
			right: 5px;
			z-index: 0;
			font-size: 65px;
			color: rgba(0, 0, 0, 0.15);
		}
	</style>
	<body class="ttr-opened-sidebar ttr-pinned-sidebar">

		<?php include 'navbar.php'; ?>

		<div class="ttr-sidebar">
			<div class="ttr-sidebar-wrapper content-scroll">
				
				<?php include 'sidebar.php'; ?>

				<nav class="ttr-sidebar-navi">
					<ul>
						<li style="padding-left: 20px; padding-top: 5px; padding-bottom: 5px; background-color: #e0e0e0; margin-top: 0px; margin-bottom: 0px;">
							<span class="ttr-label" style="color: black; font-weight: 500;">Main Navigation</span>
						</li>
						<li class="show" style="margin-top: 0px;">
							<a href="index" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-home" style="color: #BE1630;"></i></span>
								<span class="ttr-label" style="color: #BE1630;">Home</span>
							</a>
						</li>
						<li>
							<a href="manage-faculty" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-agenda"></i></span>
								<span class="ttr-label">Manage Faculty</span>
							</a>
						</li>
						<li>
							<a href="manage-students" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-user"></i></span>
								<span class="ttr-label">Manage Students</span>
							</a>
						</li>
						<li>
							<a href="#" class="ttr-material-button">
								<span class="ttr-icon"><i class="ti-harddrives"></i></span>
								<span class="ttr-label">Capstone Projects</span>
								<span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
							</a>
							<ul>
								<li>
									<a href="registered-projects" class="ttr-material-button"><span class="ttr-label">IP Registered Capstone Projects</span></a>
								</li>
								<li>
									<a href="pending-projects" class="ttr-material-button"><span class="ttr-label">Pending Capstone Projects</span></a>
								</li>
								<li>
									<a href="best-projects" class="ttr-material-button"><span class="ttr-label">Best IT Capstone Projects</span></a>
								</li>
							</ul>
						</li>
						<li class="ttr-seperate"></li>
					</ul>
				</nav>
			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #F3F3F3;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Dashboard</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="fa fa-home"></i>Manage Specialization</li>
					</ul>
				</div> 
				
				<?php include 'widget.php'; ?>

				<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
				<style type="text/css">
				.chart {
					width: 100%; 
					min-height: 500px;
				}
				.rowy {
					margin:0 !important;
				}
				</style>
				<div class="row">
					<div class="col-lg-12 m-b30">
						<div class="widget-box">
							<div class="wc-title">
								<h4><img src="../assets/images/icon.png" style="width: 30px; height: 30px;">&nbsp;Manage Specialization</h4>
							</div>
							<div class="widget-inner">
								<div class="row">
									<div class="col-lg-6">
										<button type="button" class="btn green" data-toggle="modal" data-target="#add-category" style="float: right;"><i class="ti-plus"></i><span>&nbsp;ADD SPECIALIZATION</span></button>
										<br><br><br>
										<div class="table-responsive">
											<table id="table" class="table table-bordered hover" style="width:100%">
												<thead>
													<tr>
														<th width="50">Action</th>
														<th>Category</th>
														<th>Capstone Projects</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$rows = $model->displaySpecialization($department_id);
													if (!empty($rows)) {
														foreach ($rows as $row) {
															$category_id = $row['id'];
															$category = $row['category'];
															$date_added = date('M-d-Y g:i A', strtotime($row['date_added']));
															$countSpecializationProjects = $model->countSpecializationProjects($category_id);	
													?>
													<tr>
														<td>
															<button type="button" class="btn blue" style="width: 100px; height: 37px;background-color: #BE1630;" data-toggle="modal" data-target="#category-<?php echo $category_id; ?>"><i class="ti-marker-alt" style="font-size: 12px;"></i><span>&nbsp;Edit</span></button>
														</td>
														<td><?php echo $category; ?></td>
														<td><?php echo $countSpecializationProjects; ?></td>
													</tr>

													<div id="category-<?php echo $category_id; ?>" class="modal fade" role="dialog">
														<form class="edit-profile m-b30" method="POST">
															<div class="modal-dialog modal-lg">
																<div class="modal-content">
																	<div class="modal-header">
																		<h4 class="modal-title"><img src="../assets/images/icon.png" style="width: 30px; height: 30px;">&nbsp;Update Specialization</h4>
																				<button type="button" class="close" data-dismiss="modal">&times;</button>
																	</div>
																	<div class="modal-body">
																		<div class="row">
																			<div class="form-group col-12">
																				<label class="col-form-label">Specialization</label>
																				<div>
																					<input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
																					<input class="form-control" type="text" name="new_category" value="<?php echo $category; ?>" min="3" max="100" required >
																				</div>
																			</div>
																			<div class="form-group col-12">
																				<label class="col-form-label">Department</label>
																				<div>
																					<input class="form-control" type="text" value="<?php echo $dpt; ?>" disabled>
																				</div>
																			</div>
																			<div class="form-group col-12">
																				<label class="col-form-label">Date Added</label>
																				<div>
																					<input class="form-control" type="text" value="<?php echo $date_added; ?>" disabled>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="modal-footer">
																		<input type="submit" class="btn green radius-xl outline" name="update" value="Save Changes">
																		<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
																	</div>
																</div>
															</div>
														</form>
													</div>
													<?php

														}
													}
													if (isset($_POST['update'])) {
														$cat_id = $_POST['category_id'];
														$new_category = $_POST['new_category'];
														$model->updateSpecialization($cat_id, $new_category);
														echo "<script>window.open('manage-specialization.php','_self');</script>";
													}
													?>	
												</tbody>
											</table>
										</div>
									</div>
																				<div id="add-category" class="modal fade" role="dialog">
												<form class="edit-profile m-b30" method="POST">
												<div class="modal-dialog modal-lg">
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title"><img src="../assets/images/icon.png" style="width: 30px; height: 30px;">&nbsp;Add Specialization</h4>
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="form-group col-12">
																	<label class="col-form-label">Specialization</label>
																	<div>
																		<input class="form-control" type="text" name="add_category" min="3" max="100" required >
																	</div>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<input type="submit" class="btn green radius-xl outline" name="add_new" value="Submit">
															<button type="button" class="btn red outline radius-xl" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
												</form>
											</div>
										
										<?php
										if (isset($_POST['add_new'])) {
														$add_specialization = $_POST['add_category'];
														$date = date("Y-m-d H:i:s");
														$model = new Model();
														$model->addSpecialization($add_specialization, $department_id, $date);
														echo "<script>window.open('manage-specialization.php?id=".$add_specialization."','_self');</script>";
										}
										?>
									<div class="col-lg-6">
										<img src="../assets/images/about.jpg">
										<p style="text-align: justify;text-justify: inter-word;">Starting Academic Year 2018-2019 (August 2018), the Bachelor of Science in Information Technology program will offer three professional elective tracks for students:</p>
										<p style="text-align: justify;text-justify: inter-word;"><b>1. Network and Security</b>
										The Network and Security track provides a continuation of the CCNA modules delivered during the 2nd and 3rd years of BS IT students. They are expected to learn how to manage, build, and install a computer network???s security by understanding and implementing network security policies and procedures. 
										<br>
										<b>2. Web and Mobile App Development</b>
										The Web and Mobile App Development track is a supplement to the programming courses that the students are currently taking. Additional programming languages, frameworks, tools, and best practices in software development are to be introduced in this track. Aside from Java, students in this track are expected to learn PHP and .NET Framework. Also, aside from Android, students are expected to create mobile applications using either iOS and/or Windows platforms. 
										<br>
										<b>3. Robotics</b>
										The Robotics track identifies possible applications for the IT field. Focus is on hardware integration, implementation, and application rather than engineering???s hardware development and design. Introduction of existing technologies, such as the Boe-Bot series and Arduino, will be used to identify and create possible applications, focusing on real-life scenarios (i.e., Internet of Things).</p>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<div class="ttr-overlay"></div>

		<script src="../dashboard/assets/js/jquery.min.js"></script>
		<script src="../dashboard/assets/vendors/bootstrap/js/popper.min.js"></script>
		<script src="../dashboard/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
		<script src="../dashboard/assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="../dashboard/assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
		<script src="../dashboard/assets/vendors/magnific-popup/magnific-popup.js"></script>
		<script src="../dashboard/assets/vendors/counter/waypoints-min.js"></script>
		<script src="../dashboard/assets/vendors/counter/counterup.min.js"></script>
		<script src="../dashboard/assets/vendors/imagesloaded/imagesloaded.js"></script>
		<script src="../dashboard/assets/vendors/masonry/masonry.js"></script>
		<script src="../dashboard/assets/vendors/masonry/filter.js"></script>
		<script src="../dashboard/assets/vendors/owl-carousel/owl.carousel.js"></script>
		<script src='../dashboard/assets/vendors/scroll/scrollbar.min.js'></script>
		<script src="../dashboard/assets/js/functions.js"></script>
		<script src="../dashboard/assets/vendors/chart/chart.min.js"></script>
		<script src="../dashboard/assets/js/admin.js"></script>
		<script src='../dashboard/assets/vendors/calendar/moment.min.js'></script>   
		<script src="../dashboard/assets/js/jquery.dataTables.min.js"></script>
		<script src="../dashboard/assets/js/dataTables.bootstrap4.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#table').DataTable();
			});
		</script>
		<script type="text/javascript">
			function blockSpecialChar(evt) { 
				var charCode = (evt.which) ? evt.which : window.event.keyCode; 
				if (charCode <= 13) { 
					return true; 
				} 
				
				else { 
					var keyChar = String.fromCharCode(charCode); 
					var re = /^[A-Za-z. ]+$/ 
					return re.test(keyChar); 
				} 
			}
		</script>
	</body>

</html>