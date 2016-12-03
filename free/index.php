<?php
   include_once('../database.php');
   				
   $sqlData = "SELECT * FROM `fakaheda`.`graph_freemc` WHERE `date` >= now() - INTERVAL 1 DAY ORDER BY  `graph_freemc`.`id` ASC;";
   $result = $conn->query($sqlData);
   $value = "";
   $categoryjson = "";
   			if ($result->num_rows > 0) {
   
   				$cat = "";
   				$toecho = "";
   				while ($row = $result->fetch_object()) {
   					if($row->count > 0 || substr($toecho, -3) != $row->count . ", "){
   						$cat = $cat."'".date("Y-m-d v H:i:s", strtotime($row->date))."', ";
   						$toecho = $toecho. rand(0, $row->count) .", ";
   					}
   						
   				}
   				
   										$categoryjson = $cat;
   
   						$toecho = substr($toecho, 0, -1);
   						$value = $toecho;
   			}
   			
   $sqlCommon = "SELECT HOUR(`date`), COUNT(HOUR(`date`)) AS `countDate` FROM `fakaheda`.`graph_freemc` WHERE `date` >= NOW() - INTERVAL 5 DAY AND `count` >= 1 GROUP BY HOUR(`date`) ORDER BY COUNT(HOUR(`date`)) DESC;";
   $resultCommon = $conn->query($sqlCommon);
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
                  <div class="col-md-6">
                     <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                     <h1>Graf volných serverů na fakahedě</h1>
                     <div id="container" style="height: 600px; width: 800px;"></div>
                  </div>
                  <div style="padding: 50px" class="col-md-6">
                     <p>Nejčastější čas výskytu volného free MC serveru na fakaheda hostingu.</p>
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Hodiny</th>
                              <th>Počet výskytu volného serveru za posledních 5 dní</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              if ($resultCommon->num_rows > 0) {
                              	while ($common = $resultCommon->fetch_assoc()) {
                              		echo('<tr>');
                              		if($common['countDate'] > 110) {
                              			echo('<td class="success">'. $common['HOUR(`date`)'] .' až ' . (((int)$common['HOUR(`date`)']) + 1) .' hodina</td>');
                              			echo('<td class="success">'. $common['countDate'] .'</td>');
                              		} else if ($common['countDate'] > 70) { 
                              			echo('<td class="warning">'. $common['HOUR(`date`)'] .' až ' . (((int)$common['HOUR(`date`)']) + 1) .' hodina</td>');
                              			echo('<td class="warning">'. $common['countDate'] .'</td>');
                              		} else {
                              			echo('<td class="danger">'. $common['HOUR(`date`)'] .' až ' . (((int)$common['HOUR(`date`)']) + 1) .' hodina</td>');
                              			echo('<td class="danger">'. $common['countDate'] .'</td>');
                              		}
                              		echo('</tr>');
                              	}
                              }
                              ?>
                        </tbody>
                     </table>
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
				text: 'Počet volných free serveru na Fakahedě<br/><b>za posledních 24 hodin</b>',
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
				labels: { enabled: false },
				min: -1, max: 5,
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
									name: 'Počet volných free serverů',
									color: '#2c3e50',
									data: [ ".
											$value
									."
									]
								},");
					
					?>]
		});
		

      </script>
	
	</body>

</html>