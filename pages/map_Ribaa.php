<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Prototype - Habous - Map</title>

	<!-- Bootstrap Core CSS -->
	<link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

	<!-- Timeline CSS -->
	<link href="../dist/css/timeline.css" rel="stylesheet">

	<!-- DataTables CSS -->
	<link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">

	<!-- Morris Charts CSS -->
	<link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- OL3 CSS -->
	<link href="../dist/css/ol.css" rel="stylesheet" type="text/css">
	<link href="../Maps/ol3-popup.css" rel="stylesheet" type="text/css">
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
						<?php 
							$conn=pg_connect("host=localhost port=5432 dbname=MHAI_DH user=postgres password=P0stgres");
							if (!$conn){
								die('Error: Could not connect: ' . pg_last_error());
							}
							$result = pg_query($conn, "SELECT table_op, description, to_char(time, 'HH12:MI AM') as time_log from operation");
							if (!$result) {
								die("An error occurred." . pg_last_error());
							}
							$i = 0;
							while ($row = pg_fetch_row($result)){
								$description=pg_fetch_result($result,$i,'description');
								$time=pg_fetch_result($result,$i,'time_log');
								$table_op=pg_fetch_result($result,$i,'table_op');
								$i = $i + 1;
								if($table_op=="expropriation"){
									echo '<li>'
										.'<a href="#">'
											.'<div>'
												.'<i class="fa fa-folder-open fa-fw"></i> '.$description
												.'<span class="pull-right text-muted small">'.$time.'</em>'
												.'</span>'
											.'</div>'
										.'</a>'
										.'</li>'
									.'<li class="divider"></li>';
								}
								if($table_op=="terrain"){
									echo '<li>'
										.'<a href="#">'
											.'<div>'
												.'<i class="fa fa-map-marker fa-fw"></i> '.$description
												.'<span class="pull-right text-muted small">'.$time.'</em>'
												.'</span>'
											.'</div>'
										.'</a>'
										.'</li>'
									.'<li class="divider"></li>';
								}
								if($table_op=="ribaa"){
									echo '<li>'
										.'<a href="#">'
											.'<div>'
												.'<i class="fa fa-key fa-fw"></i> '.$description
												.'<span class="pull-right text-muted small">'.$time.'</em>'
												.'</span>'
											.'</div>'
										.'</a>'
										.'</li>'
									.'<li class="divider"></li>';
								}
								if($table_op=="exploitation_terrain" || $table_op=="exploitation_ribaa"){
									echo '<li>'
										.'<a href="#">'
											.'<div>'
												.'<i class="fa fa-file-text fa-fw"></i> '.$description
												.'<span class="pull-right text-muted small">'.$time.'</em>'
												.'</span>'
											.'</div>'
										.'</a>'
										.'</li>'
									.'<li class="divider"></li>';
								}
							}
							pg_close($conn);
							?>
						<li>
							<a class="text-center" href="#" data-toggle="modal" data-target="#Log_Modal">
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
						<li><a href="#"><i class="fa fa-gear fa-fw"></i> <?php echo $_SESSION['userFunction']; ?></a>
						</li>
						<li class="divider"></li>
						<li><a id="logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
									<a href="map_Terrain.php"><i class="fa fa-map-marker fa-fw"></i> Terrains</a>
								</li>
								<li>
									<a href="map_Ribaa.php"><i class="fa fa-key fa-fw"></i> Ribaa</a>
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
					<h1 class="page-header">Carte intéractive</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-location-arrow fa-fw"></i> géolocalisation des biens
							<div class="pull-right">
								<div class="btn-group">
									<a href="map_Ribaa-full-screen.html" type="button" class="btn btn-default btn-xs">
										mode plein écran
									</a>
								</div>
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
										Ajouter
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu pull-right" role="menu">
										<li><a id="Draw" href="#">sur carte</a>
										</li>
										<li><a href="#" data-toggle="modal" data-target="#Add_Modal">sur formulaire</a>
										</li>
									</ul>
								</div>
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
										Modifier
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu pull-right" role="menu">
										<li><a id="Modify_map" href="#">sur carte</a>
										</li>
										<li><a id="Modify_Attr" href="#" data-toggle="modal" data-target="#Edit_Modal">sur Formulaire</a>
										</li>
									</ul>
								</div>
								<div class="btn-group">
									<button id="Delete" type="button" class="btn btn-default btn-xs">
										Supprimer
									</button>
								</div>
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#Search_Modal">
										Rechercher
									</button>
								</div>
							</div>
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<div id="map" class="map"></div>
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->	
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->
		<!-- Edit modal-->
		<div class="modal fade" id="Edit_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="editModalLabel">Modifier un ribaa</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-6">
								<form role="form">
									<div class="form-group">
										<label>Identifiant de l'expropriation</label>
										<input class="form-control" id="ID_Exprop_Edit" type="text">
									</div>
									<div class="form-group">
										<label>Type</label>
										<input class="form-control" id="Type_Edit" type="text">
									</div>
									<div class="form-group">
										<label>Province</label>
										<input class="form-control" id="Province_Edit" type="text">
									</div>
									<div class="form-group">
										<label>Superficie</label>
										<input class="form-control" id="Superficie_Edit" type="text">
									</div>
									<div class="form-group">
										<label>Description</label>
										<textarea class="form-control" rows="2" id="Description_Edit"></textarea>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Numéro Foncier</label>
										<input class="form-control" id="Num_Foncier_Edit" type="text">
									</div>
									<div class="form-group">
										<label>Commune</label>
										<input class="form-control" id="Commune_Edit" type="text">
									</div>
									<div class="form-group">
										<label>Région</label>
										<input class="form-control" id="Region_Edit" type="text">
									</div>
									<div class="form-group">
										<label>Coordonnées</label>
										<textarea class="form-control" rows="4" id="Coords_Edit"></textarea>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
						<button id="Save" type="submit" class="btn btn-primary">Enregistrer</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
		<!-- /.modal-dialog -->
		</div>
		<div class="modal fade" id="Add_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="editModalLabel">Ajouter un ribaa</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-6">
								<form role="form">
									<div class="form-group">
										<label>Identifiant de l'expropriation</label>
										<input class="form-control" id="ID_Exprop_Add" type="text">
									</div>
									<div class="form-group">
										<label>Type</label>
										<input class="form-control" id="Type_Add" type="text">
									</div>
									<div class="form-group">
										<label>Province</label>
										<input class="form-control" id="Province_Add" type="text">
									</div>
									<div class="form-group">
										<label>Superficie</label>
										<input class="form-control" id="Superficie_Add" type="text">
									</div>
									<div class="form-group">
										<label>Description</label>
										<textarea class="form-control" rows="2" id="Description_Add"></textarea>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Numéro Foncier</label>
										<input class="form-control" id="Num_Foncier_Add" type="text">
									</div>
									<div class="form-group">
										<label>Commune</label>
										<input class="form-control" id="Commune_Add" type="text">
									</div>
									<div class="form-group">
										<label>Région</label>
										<input class="form-control" id="Region_Add" type="text">
									</div>
									<div class="form-group">
										<label>Coordonnées</label>
										<textarea class="form-control" rows="4" id="Coords_Add"></textarea>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
						<button id="Insert" type="submit" class="btn btn-primary">Ajouter</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
		<!-- /.modal-dialog -->
		</div>
		<!-- Search modal-->
		<div class="modal fade" id="Search_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Rechercher un ribaa</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-6">
								<form role="form">
									<div class="form-group">
										<label>Identifiant de la ribaa</label>
										<input class="form-control" id="ID_Search" type="text">
									</div>
									<div class="form-group">
										<label>Type</label>
										<input class="form-control" id="Type_Search" type="text">
									</div>
									<div class="form-group">
										<label>Superficie</label>
										<input class="form-control" id="Superficie_Search" type="text">
									</div>
									<div class="form-group">
										<label>Province</label>
										<input class="form-control" id="Province_Search" type="text">
									</div>
								</form>
							</div>
							<div class="col-lg-6">
								<form role="form">
									<div class="form-group">
										<label>Identifiant de l'expropriation</label>
										<input class="form-control" id="ID_Exprop_Search" type="text">
									</div>
									<div class="form-group">
										<label>Numéro Foncier</label>
										<input class="form-control" id="Num_Foncier_Search" type="text">
									</div>
									<div class="form-group">
										<label>Commune</label>
										<input class="form-control" id="Commune_Search" type="text">
									</div>
									<div class="form-group">
										<label>Région</label>
										<input class="form-control" id="Region_Search" type="text">
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
						<button id="Search" type="button" class="btn btn-primary">Rechercher</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
		<!-- /.modal-dialog -->
		</div>
		<div class="modal fade" id="Log_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Opérations récentes</h4>
					</div>
					<div class="modal-body">
						<div class="dataTable_wrapper">
							<?php 
								$conn=pg_connect("host=localhost port=5432 dbname=MHAI_DH user=postgres password=P0stgres");
								if (!$conn){
									die('Error: Could not connect: ' . pg_last_error());
								}
								$result = pg_query($conn, "SELECT a.id, a.description, to_char(time, 'YYYY-MM-DD HH12:MM AM') as time_log, a.entite_id, b.nom, b.prenom from operation as a, utilisateur as b where a.utilisateur_id=b.id");
								if (!$result) {
									die("An error occurred." . pg_last_error());
								}
								$i = 0;
							?>
							<table class="table table-striped table-bordered table-hover" style="width:100%;" id="dataTable_logs">
								<thead>
									<tr>
										<th>Identifiant</th>
										<th>Description</th>
										<th>Temps</th>
										<th>Entité</th>
										<th>Nom</th>
										<th>Prénom</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$i = 0;
										while ($row = pg_fetch_row($result)){
											echo '<tr class="gradeA">';
											$count = count($row);
											$y = 0;
											while ($y < $count){
												$c_row = current($row);
												echo '<td>' . $c_row . '</td>';
												next($row);
												$y = $y + 1;
											}
											echo '</tr>';
											$i = $i + 1;
										}
										pg_free_result($result);
										pg_close($conn);
									?>
								</tbody>
							</table>
						</div>
						<!-- /.table-responsive -->
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
	<!-- /#wrapper -->



	<!-- jQuery -->
	<script src="../bower_components/jquery/dist/jquery.min.js"></script>

	<!-- DataTables JavaScript -->
	<script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
	
	<script>

		$('#dataTable_logs').DataTable({
			responsive: true,
			"columnDefs": [
				{
					"targets": [ 0 ],
					"visible": false
				}
			]
		});

		$('#logout').click(function(){
			$.ajax({
				url: 'php_scripts/Logout.php',
				type: 'POST',
				success:function(response){
					window.location="login.html";
				}
			});
		});
	
	</script>
	<script src="../js/ol.js"></script>
	<script src="../Maps/ol3-popup.js"></script>
	<script src="../js/Map_Ribaa.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>