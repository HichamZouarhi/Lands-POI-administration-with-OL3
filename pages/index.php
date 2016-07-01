<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Prototype - Habous - Dashboard</title>

	<!-- Bootstrap Core CSS -->
	<link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

	<!-- Timeline CSS -->
	<link href="../dist/css/timeline.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">

	<!-- Morris Charts CSS -->
	<link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>

	<div id="wrapper">
		<?php session_start();?>
		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">MHAI-DH</a>
			</div>
			<!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-alerts">
						<li>
							<a href="#">
								<div>
									<i class="fa fa-comment fa-fw"></i> New Comment
									<span class="pull-right text-muted small">4 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#">
								<div>
									<i class="fa fa-twitter fa-fw"></i> 3 New Followers
									<span class="pull-right text-muted small">12 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#">
								<div>
									<i class="fa fa-envelope fa-fw"></i> Message Sent
									<span class="pull-right text-muted small">4 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#">
								<div>
									<i class="fa fa-tasks fa-fw"></i> New Task
									<span class="pull-right text-muted small">4 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#">
								<div>
									<i class="fa fa-upload fa-fw"></i> Server Rebooted
									<span class="pull-right text-muted small">4 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a class="text-center" href="#">
								<strong>See All Alerts</strong>
								<i class="fa fa-angle-right"></i>
							</a>
						</li>
					</ul>
					<!-- /.dropdown-alerts -->
				</li>
				<!-- /.dropdown -->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['userName']; ?></a>
						</li>
						<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
						</li>
						<li class="divider"></li>
						<li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
						</li>
					</ul>
					<!-- /.dropdown-user -->
				</li>
				<!-- /.dropdown -->
			</ul>
			<!-- /.navbar-top-links -->

			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
						<li>
							<a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-folder-open fa-fw"></i> Expropriations<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="tables_Expropriation.php"><i class="fa fa-table fa-fw"></i> Données éxistantes</a>
								</li>
								<li>
									<a href="forms_Expropriation.php"><i class="fa fa-edit fa-fw"></i> Ajouter expropriation</a>
								</li>
							</ul>
							<!-- /.nav-second-level -->
						</li>
						<li>
							<a href="#"><i class="fa fa-file-text fa-fw"></i> Exploitations<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="#"><i class="fa fa-map-marker fa-fw"></i> Terrains <span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
										<li>
											<a href="tables_Exploitation_Terrain.php"><i class="fa fa-table fa-fw"></i> Données éxistantes</a>
										</li>
										<li>
											<a href="forms_Exploitation_Terrain.php"><i class="fa fa-edit fa-fw"></i> Ajouter éxploitation</a>
										</li>
									</ul>
									<!-- /.nav-third-level -->
								</li>
								<li>
									<a href="#"><i class="fa fa-key fa-fw"></i> Ribaa <span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
										<li>
											<a href="tables_Exploitation_Ribaa.php"><i class="fa fa-table fa-fw"></i> Données éxistantes</a>
										</li>
										<li>
											<a href="forms_Exploitation_Ribaa.php"><i class="fa fa-edit fa-fw"></i> Ajouter éxploitation</a>
										</li>
									</ul>
									<!-- /.nav-third-level -->
								</li>
							</ul>
							<!-- /.nav-second-level -->
						</li>
						<li>
							<a href="#"><i class="fa fa-location-arrow fa-fw"></i> La carte<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="map_Terrain.html"><i class="fa fa-map-marker fa-fw"></i> Terrains</a>
								</li>
								<li>
									<a href="map_Ribaa.html"><i class="fa fa-key fa-fw"></i> Ribaa</a>
								</li>
							</ul>
							<!-- /.nav-second-level -->
						</li>
					</ul>
				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</nav>

		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Tableau de bord</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-folder-open fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge">2</div>
									<div>Expropriations ajoutées</div>
								</div>
							</div>
						</div>
						<a href="#" data-toggle="modal" data-target="#Expro_Modal">
							<div class="panel-footer">
								<span class="pull-left">voir détails</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-green">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-file-text-o fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge">5</div>
									<div>Nouvelles exploitations</div>
								</div>
							</div>
						</div>
						<a href="#" data-toggle="modal" data-target="#Exploit_Modal">
							<div class="panel-footer">
								<span class="pull-left">voir détails</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-yellow">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-map-marker fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge">10</div>
									<div>Terrains ajoutés</div>
								</div>
							</div>
						</div>
						<a href="#" data-toggle="modal" data-target="#Terrain_Modal">
							<div class="panel-footer">
								<span class="pull-left">voir détails</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-red">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-key fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge">9</div>
									<div>Ribaa ajoutées</div>
								</div>
							</div>
						</div>
						<a href="#" data-toggle="modal" data-target="#Ribaa_Modal">
							<div class="panel-footer">
								<span class="pull-left">voir détails</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-8">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-bar-chart-o fa-fw"></i> Biens réquisitionnés
							<div class="pull-right">
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
										Actions
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu pull-right" role="menu">
										<li><a href="#">Action</a>
										</li>
										<li><a href="#">Another action</a>
										</li>
										<li><a href="#">Something else here</a>
										</li>
										<li class="divider"></li>
										<li><a href="#">Separated link</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<div id="morris-area-chart"></div>
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->	
				</div>
				<!-- /.col-lg-8 -->
				<div class="col-lg-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-bell fa-fw"></i> Opérations récentes
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<div class="list-group">
								<a href="#" class="list-group-item">
									<i class="fa fa-folder-open fa-fw"></i> Nouvelle expropriation
									<span class="pull-right text-muted small"><em>00:24 PM</em>
									</span>
								</a>
								<a href="#" class="list-group-item">
									<i class="fa fa-key fa-fw"></i> Ribaa ajoutée
									<span class="pull-right text-muted small"><em>00:18 PM</em>
									</span>
								</a>
								<a href="#" class="list-group-item">
									<i class="fa fa-file-text fa-fw"></i> exploitation d'un terrain
									<span class="pull-right text-muted small"><em>00:12 PM</em>
									</span>
								</a>
								<a href="#" class="list-group-item">
									<i class="fa fa-map-marker fa-fw"></i> Terrain ajouté
									<span class="pull-right text-muted small"><em>00:00 PM</em>
									</span>
								</a>
								<a href="#" class="list-group-item">
									<i class="fa fa-map-marker fa-fw"></i> Terrain ajouté
									<span class="pull-right text-muted small"><em>11:32 AM</em>
									</span>
								</a>
								<a href="#" class="list-group-item">
									<i class="fa fa-folder-open fa-fw"></i> nouvelle expropriation
									<span class="pull-right text-muted small"><em>11:13 AM</em>
									</span>
								</a>
								<a href="#" class="list-group-item">
									<i class="fa fa-key fa-fw"></i> Ribaa ajoutée
									<span class="pull-right text-muted small"><em>10:57 AM</em>
									</span>
								</a>
							</div>
							<!-- /.list-group -->
							<a href="#" class="btn btn-default btn-block">Afficher les notifications</a>
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
					
				</div>
				<!-- /.col-lg-4 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->
		<!--Expropriation Log modal-->
		<div class="modal fade" id="Expro_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Expropriations ajoutées</h4>
					</div>
					<div class="modal-body">
						Log of the last operations done on expropriations / Exploitations /lands / estates
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
		<!-- /.modal-dialog -->
		</div>
		<!--Exploitation Log modal-->
		<div class="modal fade" id="Exploit_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Exploitations ajoutées</h4>
					</div>
					<div class="modal-body">
						Log of the last operations done on expropriations / Exploitations /lands / estates
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
		<!-- /.modal-dialog -->
		</div>
		
		<!--Land Log modal-->
		<div class="modal fade" id="Terrain_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Terrains ajoutées</h4>
					</div>
					<div class="modal-body">
						Log of the last operations done on expropriations / Exploitations /lands / estates
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
		<!-- /.modal-dialog -->
		</div>
		
		<!--Ribaa Log modal-->
		<div class="modal fade" id="Ribaa_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Ribaa ajoutées</h4>
					</div>
					<div class="modal-body">
						Log of the last operations done on expropriations / Exploitations /lands / estates
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
		<!-- /.modal-dialog -->
		</div>
		
		</div>

	</div>
	<!-- /#wrapper -->
	
	
	<!-- jQuery -->
	<script src="../bower_components/jquery/dist/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

	<!-- Morris Charts JavaScript -->
	<script src="../bower_components/raphael/raphael-min.js"></script>
	<script src="../bower_components/morrisjs/morris.min.js"></script>
	<script src="../js/morris-data.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
