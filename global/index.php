<?php
   include_once('../database.php');
   				
   $sqlData = "SELECT * FROM `fakaheda`.`graph_fhservercount` WHERE `date` >= now() - INTERVAL 1 DAY ORDER BY  `graph_fhservercount`.`id` ASC;";
   $result = $conn->query($sqlData);
   $value = "";
   $categoryjson = "";
   			if ($result->num_rows > 0) {
   
   				$cat = "";
   				$toecho = "";
   				while ($row = $result->fetch_object()) {
   						$cat = $cat."'".date("Y-m-d v H:i:s", strtotime($row->date))."', ";
   						$toecho = $toecho. $row->count .", ";
   						
   				}
   				
   										$categoryjson = $cat;
   
   						$toecho = substr($toecho, 0, -1);
   						$value = $toecho;
   			}
   			
   			
   $sqlDataMemory = "SELECT * FROM `fakaheda`.`graph_fhmemory` WHERE `date` >= now() - INTERVAL 1 DAY ORDER BY  `graph_fhmemory`.`id` ASC;";
   $resultMemory = $conn->query($sqlDataMemory);
   $valueMemory = "";
   $categoryjsonMemory = "";
   			if ($resultMemory->num_rows > 0) {
   
   				$catMemory = "";
   				$toechoMemory = "";
   				while ($rowMemory = $resultMemory->fetch_assoc()) {
   						$catMemory = $catMemory."'".date("Y-m-d v H:i:s", strtotime($rowMemory['date']))."', ";
   						$toechoMemory = $toechoMemory . $rowMemory['memory'] .", ";
   						
   				}
   				
   										$categoryjsonMemory = $cat;
   
   						$toechoMemory = substr($toechoMemory, 0, -1);
   						$valueMemory = $toechoMemory;
   			}
   			
   $sqlDataplayers = "SELECT * FROM `fakaheda`.`graph_fhplayercount` WHERE `date` >= now() - INTERVAL 1 DAY ORDER BY  `graph_fhplayercount`.`id` ASC;";
   $resultplayers = $conn->query($sqlDataplayers);
   $valueplayers = "";
   $categoryjsonplayers = "";
   			if ($resultplayers->num_rows > 0) {
   
   				$catplayers = "";
   				$toechoplayers = "";
   				while ($rowplayers = $resultplayers->fetch_assoc()) {
   						$catplayers = $catplayers."'".date("Y-m-d v H:i:s", strtotime($rowplayers['date']))."', ";
   						$toechoplayers = $toechoplayers . $rowplayers['count'] .", ";
   						
   				}
   				
   										$categoryjsonplayers = $cat;
   
   						$toechoplayers = substr($toechoplayers, 0, -1);
   						$valueplayers = $toechoplayers;
   				//echo($toecho);
   			}
   $sqlDataslot = "SELECT * FROM `fakaheda`.`graph_fhslotcount` WHERE `date` >= now() - INTERVAL 1 DAY ORDER BY  `graph_fhslotcount`.`id` ASC;";
   $resultslot = $conn->query($sqlDataslot);
   $valueslot = "";
   $categoryjsonslot = "";
   			if ($resultslot->num_rows > 0) {
   
   				$catslot = "";
   				$toechoslot = "";
   				while ($rowslot = $resultslot->fetch_assoc()) {
   						$catslot = $catslot."'".date("Y-m-d v H:i:s", strtotime($rowslot['date']))."', ";
   						$toechoslot = $toechoslot . $rowslot['count'] .", ";
   						
   				}
   				
   										$categoryjsonslot = $cat;
   
   						$toechoslot = substr($toechoslot, 0, -1);
   						$valueslot = $toechoslot;
   			}
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <style>
         body{background-color: rgba(0, 0, 0, 0.85);}
      </style>
      <title>Fakaheda serverové grafy</title>
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/simple-sidebar.css" rel="stylesheet">
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/simple-sidebar.css" rel="stylesheet">
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/simple-sidebar.css" rel="stylesheet">
      <link rel="apple-touch-icon" sizes="57x57" href="../apple-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="60x60" href="../apple-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="72x72" href="../apple-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="76x76" href="../apple-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="114x114" href="../apple-icon-114x114.png">
      <link rel="apple-touch-icon" sizes="120x120" href="../apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="../apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="../apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="../apple-icon-180x180.png">
      <link rel="icon" type="image/png" sizes="192x192"  href="../android-icon-192x192.png">
      <link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="../favicon-96x96.png">
      <link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
      <link rel="manifest" href="../manifest.json">
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="../ms-icon-144x144.png">
      <meta name="theme-color" content="#ffffff">
   </head>
   <body>
      <div id="wrapper">
         <!-- Sidebar -->
         <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
               <li class="sidebar-brand">
                  <a href="#">
                  Fakaheda Graph Tool
                  </a>
               </li>
               <li>
                  <a href="http://fakaheda.denowq.cloud/">Online servers</a>
                  <a href="http://fakaheda.denowq.cloud/free">Free servers</a>
                  <a href="http://fakaheda.denowq.cloud/global">Global servers</a>
                  <hr>
                  <a href="http://fakaheda.denowq.cloud/money">Fakaheda money</a>
               </li>
            </ul>
         </div>
         <!-- /#sidebar-wrapper -->
         <!-- Page Content -->
         <div id="page-content-wrapper">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-6">
                     <h1 class="text-center">Graf všech serverů na fakahedě</h1>
                     <div id="container" style="height: 500px;"></div>
                  </div>
                  <div class="col-lg-6">
                     <h1 class="text-center">Graf paměťi RAM všech serverů na fakahedě</h1>
                     <div id="containerMemory" style="height: 500px;"></div>
                  </div>
                  <div class="col-lg-6">
                     <h1 class="text-center">Graf online hráču na všech serverech fakahedy</h1>
                     <div id="containerPlayers" style="height: 500px;"></div>
                  </div>
                  <div class="col-lg-6">
                     <h1 class="text-center">Graf slotů na všech serverech fakahedy</h1>
                     <div id="containerSlot" style="height: 500px;"></div>
                  </div>
               </div>
            </div>
         </div>
         <!-- /#page-content-wrapper -->
      </div>
      <!-- /#wrapper -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://code.highcharts.com/highcharts.js"></script>
      <!-- Menu Toggle Script -->
      <script>
		  $("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
		$('#container').highcharts({
			chart: {
				type: 'line',
				zoomType: 'xy'
			},
			title: {
				text: 'Počet celkových serveru na Fakahedě<br/><b>za posledních 24 hodin</b>',
				x: -20 //center
			},
			subtitle: {
				text: 'Zdroj: <a href="http://fakaheda.eu/">fakaheda.eu</a>',
				x: -20
			},
			xAxis: {
						title: { text: null },
						labels: { enabled: false },
				categories: [ <?php
						echo ($categoryjson);
					?>
				]
			},
			yAxis: {
				labels: { enabled: true },
				title: {
					text: 'Počet'
				},
				plotLines: [{
					value: 0,
					width: 0,
					color: '#808080'
				}]
			},
			credits: {
				enabled: false
			},
			series: [<?php
							echo("{
									name: 'Počet všech serverů',
									color: '#2c3e50',
									data: [ ".
											$value
									."
									]
								},");
					
					?>]
		});
		
		$('#containerMemory').highcharts({
			chart: {
				type: 'line',
				zoomType: 'xy'
			},
			title: {
				text: 'Paměť RAM všech serveru na Fakahedě<br/><b>za posledních 24 hodin</b>',
				x: -20 //center
			},
			subtitle: {
				text: 'Zdroj: <a href="http://fakaheda.eu/">fakaheda.eu</a>',
				x: -20
			},
			xAxis: {
						title: { text: null },
						labels: { enabled: false },
				categories: [ <?php
						echo ($categoryjsonMemory);
					?>
				]
			},
			yAxis: {
				labels: { enabled: true },
				title: {
					text: 'Počet'
				},
				plotLines: [{
					value: 0,
					width: 0,
					color: '#808080'
				}]
			},
			credits: {
				enabled: false
			},
			series: [<?php
							echo("{
									name: 'Paměť RAM',
									color: '#2c3e50',
									data: [ ".
											$valueMemory
									."
									]
								},");
					
					?>]
		});
		$('#containerPlayers').highcharts({
			chart: {
				type: 'line',
				zoomType: 'xy'
			},
			title: {
				text: 'Online hráči na všech serverech Fakahedy<br/><b>za posledních 24 hodin</b>',
				x: -20 //center
			},
			subtitle: {
				text: 'Zdroj: <a href="http://fakaheda.eu/">fakaheda.eu</a>',
				x: -20
			},
			xAxis: {
						title: { text: null },
						labels: { enabled: false },
				categories: [ <?php
						echo ($categoryjsonplayers);
					?>
				]
			},
			yAxis: {
				labels: { enabled: true },
				title: {
					text: 'Počet'
				},
				plotLines: [{
					value: 0,
					width: 0,
					color: '#808080'
				}]
			},
			credits: {
				enabled: false
			},
			series: [<?php
							echo("{
									name: 'Online hráčů',
									color: '#2c3e50',
									data: [ ".
											$valueplayers
									."
									]
								},");
					
					?>]
		});
			$('#containerSlot').highcharts({
			chart: {
				type: 'line',
				zoomType: 'xy'
			},
			title: {
				text: 'Počet slotů na všech serverech Fakahedy<br/><b>za posledních 24 hodin</b>',
				x: -20 //center
			},
			subtitle: {
				text: 'Zdroj: <a href="http://fakaheda.eu/">fakaheda.eu</a>',
				x: -20
			},
			xAxis: {
						title: { text: null },
						labels: { enabled: false },
				categories: [ <?php
						echo ($categoryjsonslot);
					?>
				]
			},
			yAxis: {
				labels: { enabled: true },
				title: {
					text: 'Počet'
				},
				plotLines: [{
					value: 0,
					width: 0,
					color: '#808080'
				}]
			},
			credits: {
				enabled: false
			},
			series: [<?php
							echo("{
									name: 'Slotů',
									color: '#2c3e50',
									data: [ ".
											$valueslot
									."
									]
								},");
					
					?>]
		});
      </script>
	
	</body>

</html>