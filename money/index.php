<?php


include_once('../database.php');


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
    "cs2d" => 'Counter-Strike 2D', //counter strike 2D
    "cscz" => 'Counter-Strike: Condition Zero', //counter strike 2D
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

$perSlot = array(
    "7dtd" => 26.25, //7 days to die
    "arkse" => 24,
    "arm2" => 16.5,
    "dayze" => 16.5,
    "arma3" => 17,
    "bf2" => 16.5,
    "bf2r" => 24.3,
    "2142" => 16.5,
    "bf3" => 24.3,
    "bc2" => 24.1,
    "bungeecord" => 17.5,
    "cod" => 16.5,
    "cod2" => 16.5,
    "cod4" => 16.5,
    "cod5" => 16.5,
    "codu" => 16.5,
    "cs16" => 16.5,
    "cs2d" => 4.1,
    "cscz" => 16.5,
    "csgo" => 9.9,
    "css" => 16.5,
    "csp" => 16.5,
    "dod" => 16.5,
    "dods" => 16.5,
    "dmc" => 16.5,
    "dstrv" => 20.8,
    "doom" => 5,
    "fear" => 16.5,
    "gmod" => 16.5,
    "samp" => 2,
    "hl2c" => 16.5,
    "hl2" => 16.5,
    "hl" => 16.5,
    "insgc" => 9.9,
    "kf" => 33.3,
    "kf2" => 40,
    "l4d" => 31.25,
    "l4d2" => 31.25,
    "lif" => 25.25,
    "lhmp" => 1.3,
    "maf2" => 2,
    "mohw2" => 24.9,
    "minecraft" => 25,
    "extreme" => 20,
    "minecraft-free" => 0,
    "mcpe" => 17,
    "mta" => 1, //Multi Theft Auto
    "q3a" => 16.5, //Multi Theft Auto
    "qlive" => 9.9, //Multi Theft Auto
    "ro2" => 16.5, //Multi Theft Auto
    "ror" => 16.5, //Multi Theft Auto
    "rust" => 12.5,
    "sm" => 16.5,
    "sold" => 18.75,
    "spen" => 26.25, //Space Engineers
    "ja" => 16.5, //Space Engineers
    "jakf" => 16.5, //Space Engineers
    "tf2" => 16.5,
    "tekkit" => 25,
    "terraria" => 25,
    "tm2" => 10,
    "tm2s" => 10,
    "tmn" => 10,
    "tmf" => 10,
    "ut04" => 16.5,
    "ut3" => 16.5,
    "unturned" => 25,
    "et" => 16.5,
    "mumble" => 2.5, //mumble,	
    "ts3" => 5
);

$slots = array();

$moneyGame = array();

$lastsqlData = "SELECT * FROM `fakaheda`.`graph_fhcount` WHERE `date` = (SELECT MAX(`date`) from `fakaheda`.`graph_fhcount`) ORDER BY  `graph_fhcount`.`count` DESC;";
$lastresult  = $conn->query($lastsqlData);
while ($row = $lastresult->fetch_assoc())
  {
    $moneyGame[$row['type']] = $row['slots'] * $perSlot[$row['type']];
    $slots[$row['type']]     = $row['slots'];
  }

$finalMoney = 0;

foreach ($moneyGame as $key => $value)
  {
    $finalMoney = $finalMoney + $value;
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
						<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Fakaheda aktualně vydělává ~<?php
echo ($finalMoney);
?> kreditů měsíčně</h1>
						<p>Tato částka samozřejmě nespočítává ostatní služby, které zase musí FH platit jinde.<br>Také nejsou započítávány license pro hry.</p>
						<p>Jedná se o KREDITY, musí být v úvahu počítano, že někteří si kredity kupují přes SMS, kde se jedná o min. 3/4 ceny.</p>
					</div>
					<div class="col-lg-12">
						  <table class="table">
							<thead>
							  <tr>
								<th>Hra</th>
								<th>Kreditů za 1 slot</th>
								<th>Počet slotů</th>
								<th>Celkem</th>
							  </tr>
							</thead>
							<tbody>
							<?php
foreach ($servers as $key => $value)
  {
    if ($slots[$key] == 0)
      {
        echo ('<tr class="danger">
									<td>' . $value . '</td>
									<td>' . $perSlot[$key] . '</td>
									<td>' . $slots[$key] . '</td>
									<td>' . $moneyGame[$key] . '</td>
								  </tr>');
      }
    else
      {
        echo ('<tr>
									<td>' . $value . '</td>
									<td>' . $perSlot[$key] . '</td>
									<td>' . $slots[$key] . '</td>
									<td>' . $moneyGame[$key] . '</td>
								  </tr>');
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
    </script>
	
</body>

</html>