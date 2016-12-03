<?php
   include_once('database.php');
   
   ini_set('max_execution_time', 300);
   
   function adjustBrightness($hex, $steps) {
       // Steps should be between -255 and 255. Negative = darker, positive = lighter
       $steps = max(-255, min(255, $steps));
   
       // Normalize into a six character long hex string
       $hex = str_replace('#', '', $hex);
       if (strlen($hex) == 3) {
           $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
       }
   
       // Split into three parts: R, G and B
       $color_parts = str_split($hex, 2);
       $return = '#';
   
       foreach ($color_parts as $color) {
           $color   = hexdec($color); // Convert to decimal
           $color   = max(0,min(255,$color + $steps)); // Adjust color
           $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
       }
   
       return $return;
   }
   
   function getRandomColor(){
   	$return = array();
   	$randomString = md5("color".rand(0,99999)); //like "d73a6ef90dc6a ..."
   	$r = substr($randomString,0,2); //1. and 2.
   	$g = substr($randomString,2,2); //3. and 4.
   	$b = substr($randomString,4,2); //5. and 6.	
   	$return['r'] = $r;
   	$return['g'] = $g;
   	$return['b'] = $b;
   	return adjustBrightness(rgb2hex($return), 75);
   }
   
   function rgb2hex($rgb) {
   	return '#' . sprintf('%02x', $rgb['r']) . sprintf('%02x', $rgb['g']) . sprintf('%02x', $rgb['b']);
   }
   
   $sqlResults = array();
   $countResults = array();
   
   $servers = array(
   	"7dtd" => '7 Days to Die', //7 days to die
   	"arkse" => 'ARK: Survival Evolved',
   	"arm2" => 'Arma 2',
   	"dayze" => 'Arma 2 - DayZ EPOCH',
   	"arma3" => 'Arma 3',
   	"bf2" => 'Battlefield 2',
   	"bf2r" => 'Battlefield 2 RANKED',
   	"2142" => 'Battlefield 2142',
   	"bf3" => 'Battlefield 3',
   	"bc2" => 'Battlefield Bad Company 2 RANKED',
   	"bungeecord" => 'Bungeecord',
   	"cod" => 'Call of Duty',
   	"cod2" => 'Call of Duty 2',
   	"cod4" => 'Call of Duty 4: Modern Warfare',
   	"cod5" => 'Call of Duty 5: World at War',
   	"codu" => 'Call of Duty: United Offensive',
   	"cs16" => 'Counter-Strike 1.6',
   	"cs2d" => 'Counter-Strike 2D',//counter strike 2D
   	"cscz" => 'Counter-Strike: Condition Zero',//counter strike 2D
   	"csgo" => 'Counter-Strike: Global Offensive',
   	"css" => 'Counter-Strike: Source',
   	"csp" => 'CSPromod',
   	"dod" => 'Day of Defeat',
   	"dods" => 'Day of Defeat: Sourc',
   	"dmc" => 'Deathmatch Classic',
   	"dstrv" => 'Dont Starve Together',
   	"doom" => 'Doom II',
   	"fear" => 'F.E.A.R',
   	"gmod" => 'Garrys Mod', //garry's mod
   	"samp" => 'GTA San Andreas MP',
   	"hl2c" => 'Half-Life 2',
   	"hl2" => 'Half-Life 2: Deathmatch',
   	"hl" => 'Half-Life Multiplayer',
   	"insgc" => 'Insurgency',
   	"kf" => 'Killing Floor',
   	"kf2" => 'Killing Floor 2',
   	"l4d" => 'Left 4 dead',
   	"l4d2" => 'Left 4 dead 2',
   	"lif" => 'Life is Feudal',
   	"lhmp" => 'LostHeaven: MultiPlayer',
   	"maf2" => 'Mafia 2 Multiplayer',
   	"mohw2" => 'Medal of Honor Warfighter',
   	"minecraft" => 'Minecraft',
   	"extreme" => 'Minecraft Extreme',
   	"minecraft-free" => 'Minecraft Free',
   	"mcpe" => 'Minecraft Pocket Edition',
   	"mta" => 'Multi Theft Auto', //Multi Theft Auto
   	"q3a" => 'Quake 3 Arena', //Multi Theft Auto
   	"qlive" => 'Quake Live', //Multi Theft Auto
   	"ro2" => 'Red Orchestra 2: Heroes of Stalingrad', //Multi Theft Auto
   	"ror" => 'Red Orchestra: Ostrfront 41-45', //Multi Theft Auto
   	"rust" => 'Rust',
   	"sm" => 'Shoot Mania',
   	"sold" => 'Soldat',
   	"spen" => 'Space Engineers', //Space Engineers
   	"ja" => 'Star Wars Jedi Knight: Jedi Academy', //Space Engineers
   	"jakf" => 'Star Wars: Jedi Academy - Knights of the Force', //Space Engineers
   	"tf2" => 'Team Fortress 2',
   	"tekkit" => 'Tekkit',
   	"terraria" => 'Terraria',
   	"tm2" => 'TrackMania 2: Canyon',
   	"tm2s" => 'TrackMania 2: Stadium',
   	"tmn" => 'TrackMania Nations ESWC',
   	"tmf" => 'TrackMania Nations Forever',
   	"ut04" => 'Unreal Tournament 2004',
   	"ut3" => 'Unreal Tournament 3',
   	"unturned" => 'Unturned',
   	"et" => 'Wolfenstein: Enemy Territory',
   	"mumble" => 'Mumble', //mumble,	
   	"ts3" => 'Team Speak 3'	
   );
   
   $serversColor = array();
   
   foreach ($servers as $key => $value) {
   	$serverColor[$key] = getRandomColor();
   }
   
   $time = "1 DAY";
   
   $sqlCatDate = "SELECT * FROM `fakaheda`.`graph_fhcount` WHERE `type` = 'minecraft' AND `date` >= now() - INTERVAL ".$time." ORDER BY  `graph_fhcount`.`id` ASC;";
   $sqlCatDateResult = $conn->query($sqlCatDate);
   $categoryjson = "";
   
   					$toecho = "";
   
   					while ($row = $sqlCatDateResult->fetch_object()) {
   						$toecho = $toecho."'".date("Y-m-d v H:i:s", strtotime($row->date))."', ";
   					}
   				 $categoryjson = $toecho;
   				
   
   $legend = array();
   				
   $lastsqlData = "SELECT * FROM `fakaheda`.`graph_fhcount` WHERE `date` = (SELECT MAX(`date`) from `fakaheda`.`graph_fhcount`) ORDER BY  `graph_fhcount`.`count` DESC;";
   $lastresult = $conn->query($lastsqlData);
   
   					$datelast;
   					$toecho = "";
   
   
   					while ($row = $lastresult->fetch_assoc()) {
   						$legend[$row['type']] = $row['type'];
   						$datelast = date("Y-m-d v H:i:s", strtotime($row['date']));
   						$toecho = $toecho."{color: '".$serverColor[$row['type']]."', name: '" . $servers[$row['type']] . "', y: ".$row['count'].
   					"}, ";
   					}
   					$toecho = substr($toecho, 0, -1);
   				
   
   				
   		
   $lastsqlData = "SELECT * FROM `fakaheda`.`graph_fhcount` WHERE `date` = (SELECT MAX(`date`) from `fakaheda`.`graph_fhcount`) ORDER BY  `graph_fhcount`.`count` DESC;";
   $lastresult = $conn->query($lastsqlData);
   
   					$toecho = "";
   
   
   					while ($row = $lastresult->fetch_assoc()) {
   						$legend[$row['type']] = $row['type'];
   						$datelast = date("Y-m-d v H:i:s", strtotime($row['date']));
   						$toecho = $toecho."{color: '".$serverColor[$row['type']]."', name: '" . $servers[$row['type']] . "', y: ".$row['count'].
   					"}, ";
   					}
   					$toecho = substr($toecho, 0, -1);
   				
   
   				
   foreach ($legend as $key => $value) {
   	$sqlDate = "SELECT * FROM `fakaheda`.`graph_fhcount` WHERE `type` = '{$key}' AND `date` >= now() - INTERVAL ".$time." ORDER BY  `graph_fhcount`.`id` ASC;";
   	$result = $conn->query($sqlDate);
   	$sqlResults[$key] = $result;
   }
   
   foreach ($legend as $key => $value) {
   	$sqlresult = $sqlResults[$key];
   	$toresults = "";
   
   
   
   					while ($row = $sqlresult->fetch_assoc()) {
   						$toresults = $toresults.$row['count'].", ";
   					}
   					$toresults = substr($toresults, 0, -1);
   				
   	
   	$countResults[$key] = $toresults;
   }
   
   $sqlTotal = "SELECT * FROM `fakaheda`.`graph_fhcount` WHERE `date` = (SELECT MAX(`date`) from `fakaheda`.`graph_fhcount`);";
   $sqlTotalResult = $conn->query($sqlTotal);
   
   $online = 0;
   $slots = 0;
   $memory = 0;
   $serversCount = 0;
   $serversDontUse = 0;
   $gameCount = 0;
   
   					while ($row = $sqlTotalResult->fetch_assoc()) {
   						$gameCount = $gameCount + 1;
   						if($row['slots'] != 0){
   								$online = $online + $row['online'];
   								$slots = $slots + $row['slots'];
   								$memory = $memory + $row['memory'];
   								$serversCount = $serversCount + $row['count'];
   						} else {
   							$serversDontUse = $serversDontUse + 1;
   						}
   						
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
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/simple-sidebar.css" rel="stylesheet">
      <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
      <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
      <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
      <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
      <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
      <link rel="manifest" href="/manifest.json">
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
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
         <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
         <!-- Page Content -->
         <div id="page-content-wrapper">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12">
                     <h1>Základní graf všech online serverů na fakahedě</h1>
                     <h3 style="text-center">Počet online hračů: <?php echo($online."/".$slots.", na ".$serversCount . " serverech. Průměr počtu hráču na server: ".$online/$serversCount);?></h3>
                     <h3>Počet her, které fakaheda nabízí: <?php echo($gameCount);?>, z těch se nepoužívá: <?php echo($serversDontUse);?></h3>
                     <div id="container" style="height: 600px;"></div>
                     <div id="piechart" style="height: 600px;"></div>
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
					type: 'area',
					zoomType: 'xy'
				},
				title: {
					text: 'Počet běžících serveru na Fakahedě<br/><b>za posledních 24 hodin</b>',
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
				legend: {
					itemWidth: 250
				},
				yAxis: {
					title: {
						text: 'Počet'
					},
					plotLines: [{
						value: 0,
						width: 1,
						color: '#111'
					}]
				},tooltip: {
					formatter: function (tooltip) {
						var items = this.points || splat(this),
							series = items[0].series,
							s;

						// sort the values
						items.sort(function(a, b){
							return ((a.y < b.y) ? -1 : ((a.y > b.y) ? 1 : 0));
						});
						items.reverse();

						return tooltip.defaultFormatter.call(this, tooltip);
					},
					shared: true
				},
				credits: {
					enabled: false
				},
				series: [<?php
							
						foreach ($countResults as $key => $value) {
									echo("{
										name: '".$servers[$key]."',
										color: '".$serverColor[$key]."',
										data: [ ".
												$value
										."
										]
									},");
						}
						
						?>]
			});
			
			$(function () {
				$('#piechart').highcharts({
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false,
						type: 'pie',
					},
					legend: {
						itemWidth: 250
					},
					title: {
						text: 'Procentuální zastoupení v typu serveru<br/><b>z poslední kontroly: <?php echo($datelast)?></b>'
					},
					tooltip: {
						pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
					},
					credits: {
						enabled: false
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							size: 400,
							dataLabels: {
								enabled: false
							},
							showInLegend: true
						}
					},
					series: [{
						name: 'Servery',
						colorByPoint: true,
						data: [<?php echo($toecho)?>]
					}]
				});
			});
		</script>
	</body>
</html>