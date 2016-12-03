<?php

include_once('../database.php');

$servers = array(
	"7dtd" => 'http://query.fakaheda.eu/dtd7.feed', //7 days to die
	"arkse" => 'http://query.fakaheda.eu/arkse.feed',
	"arm2" => 'http://query.fakaheda.eu/arm2.feed',
	"dayze" => 'http://query.fakaheda.eu/dayze.feed',
	"arma3" => 'http://query.fakaheda.eu/arma3.feed',
	"bf2" => 'http://query.fakaheda.eu/bf2.feed',
	"bf2r" => 'http://query.fakaheda.eu/bf2r.feed',
	"2142" => 'http://query.fakaheda.eu/2142.feed',
	"bf3" => 'http://query.fakaheda.eu/bf3.feed',
	"bc2" => 'http://query.fakaheda.eu/bc2.feed',
	"bungeecord" => 'http://query.fakaheda.eu/bungee.feed',
	"cod" => 'http://query.fakaheda.eu/cod.feed',
	"cod2" => 'http://query.fakaheda.eu/cod2.feed',
	"cod4" => 'http://query.fakaheda.eu/cod4.feed',
	"cod5" => 'http://query.fakaheda.eu/cod5.feed',
	"codu" => 'http://query.fakaheda.eu/codu.feed',
	"cs16" => 'http://query.fakaheda.eu/cs16.feed',
	"cs2d" => 'http://query.fakaheda.eu/cs2d.feed',//counter strike 2D
	"cscz" => 'http://query.fakaheda.eu/cscz.feed',//counter strike 2D
	"csgo" => 'http://query.fakaheda.eu/csgo.feed',
	"css" => 'http://query.fakaheda.eu/css.feed',
	"csp" => 'http://query.fakaheda.eu/csp.feed',
	"dod" => 'http://query.fakaheda.eu/dod.feed',
	"dods" => 'http://query.fakaheda.eu/dods.feed',
	"dmc" => 'http://query.fakaheda.eu/dmc.feed',
	"dstrv" => 'http://query.fakaheda.eu/dstrv.feed',
	"doom" => 'http://query.fakaheda.eu/doom.feed',
	"fear" => 'http://query.fakaheda.eu/fear.feed',
	"gmod" => 'http://query.fakaheda.eu/gmod.feed', //garry's mod
	"samp" => 'http://query.fakaheda.eu/samp.feed',
	"hl2c" => 'http://query.fakaheda.eu/hl2c.feed',
	"hl2" => 'http://query.fakaheda.eu/hl2.feed',
	"hl" => 'http://query.fakaheda.eu/hl.feed',
	"insgc" => 'http://query.fakaheda.eu/insgc.feed',
	"kf" => 'http://query.fakaheda.eu/kf.feed',
	"kf2" => 'http://query.fakaheda.eu/kf2.feed',
	"l4d" => 'http://query.fakaheda.eu/l4d.feed',
	"l4d2" => 'http://query.fakaheda.eu/l4d2.feed',
	"lif" => 'http://query.fakaheda.eu/lif.feed',
	"lhmp" => 'http://query.fakaheda.eu/lhmp.feed',
	"maf2" => 'http://query.fakaheda.eu/maf2.feed',
	"mohw2" => 'http://query.fakaheda.eu/mohw2.feed',
	"minecraft" => 'http://query.fakaheda.eu/mncb.feed',
	"extreme" => 'http://query.fakaheda.eu/mnce.feed',
	"minecraft-free" => 'http://query.fakaheda.eu/mncf.feed',
	"mcpe" => 'http://query.fakaheda.eu/mcpe.feed',
	"mta" => 'http://query.fakaheda.eu/mta.feed', //Multi Theft Auto
	"q3a" => 'http://query.fakaheda.eu/q3a.feed', //Multi Theft Auto
	"qlive" => 'http://query.fakaheda.eu/qlive.feed', //Multi Theft Auto
	"ro2" => 'http://query.fakaheda.eu/ro2.feed', //Multi Theft Auto
	"ror" => 'http://query.fakaheda.eu/ror.feed', //Multi Theft Auto
	"rust" => 'http://query.fakaheda.eu/rust.feed',
	"sm" => 'http://query.fakaheda.eu/sm.feed',
	"sold" => 'http://query.fakaheda.eu/sold.feed',
	"spen" => 'http://query.fakaheda.eu/spen.feed', //Space Engineers
	"ja" => 'http://query.fakaheda.eu/ja.feed', //Space Engineers
	"jakf" => 'http://query.fakaheda.eu/jakf.feed', //Space Engineers
	"tf2" => 'http://query.fakaheda.eu/tf2.feed',
	"tekkit" => 'http://query.fakaheda.eu/tekk.feed',
	"terraria" => 'http://query.fakaheda.eu/terr.feed',
	"tm2" => 'http://query.fakaheda.eu/tm2.feed',
	"tm2s" => 'http://query.fakaheda.eu/tm2s.feed',
	"tmn" => 'http://query.fakaheda.eu/tmn.feed',
	"tmf" => 'http://query.fakaheda.eu/tmf.feed',
	"ut04" => 'http://query.fakaheda.eu/ut04.feed',
	"ut3" => 'http://query.fakaheda.eu/ur3.feed',
	"unturned" => 'http://query.fakaheda.eu/unturned.feed',
	"et" => 'http://query.fakaheda.eu/et.feed',
	"mumble" => 'http://query.fakaheda.eu/mumb.feed', //mumble,	
	"ts3" => 'http://query.fakaheda.eu/ts3.feed'
);

$current_timestamp = "".date("Y-m-d H:i:s");

foreach ($servers as $key => $value) {
	$json_tasks = file_get_contents($value);
	$task_array = json_decode($json_tasks,true);

	$online = 0;
	$slots = 0;
	$memory = 0;

	foreach ($task_array as $serverData){
		$online = $online + $serverData['players'];
		$slots = $slots + $serverData['slots'];
		$memory = $memory + $serverData['memory'];
	}
	
	$avarege = $online/count($task_array);
	
	echo("[".$key."] Online: ".$online. "/".$slots. " na ".count($task_array)." serverů<br>");
	echo("[".$key."] Memory: ".$memory. "<br>");
	echo($avarege >= 1 ? "<p style='color: red;'>[".$key."] Průměr hráču na serveru: " . $avarege. " </p><br>" : "[".$key."] Průměr hráču na serveru: " . $avarege. " <br>");
	$sql = "INSERT INTO `fakaheda`.`graph_fhcount` (`id`, `count`, `date`, `type`, `online`, `slots`, `memory`) VALUES (NULL, '".count($task_array)."', '" . $current_timestamp . "', '{$key}', '".$online."', '".$slots."', '".$memory."');";
	echo($sql."<br/>");
	$result = $conn->query($sql);
}

$sqlTotal = "SELECT * FROM `fakaheda`.`graph_fhcount` WHERE `date` = (SELECT MAX(`date`) from `fakaheda`.`graph_fhcount`) ORDER BY  `graph_fhcount`.`count` DESC;";
$sqlTotalResult = $conn->query($sqlTotal);

$online = 0;
$slots = 0;
$memory = 0;
$serversCount = 0;
$gameCount = 0;


					while ($row = $sqlTotalResult->fetch_assoc()) {
						$serversCount = $serversCount + $row['count'];
						$online = $online + $row['online'];
						$slots = $slots + $row['slots'];
						$memory = $memory + $row['memory'];
					}

$sql = "INSERT INTO `fakaheda`.`graph_fhservercount` (`id`, `count`, `date`) VALUES (NULL, '".$serversCount."', '" . $current_timestamp . "');";
	echo($sql."<br/>");
$result = $conn->query($sql);

$sql = "INSERT INTO `fakaheda`.`graph_fhmemory` (`id`, `memory`, `date`) VALUES (NULL, '".$memory."', '" . $current_timestamp . "');";
	echo($sql."<br/>");

	
$result = $conn->query($sql);

$sql = "INSERT INTO `fakaheda`.`graph_fhplayercount` (`id`, `count`, `date`) VALUES (NULL, '".$online."', '" . $current_timestamp . "');";
	echo($sql."<br/>");

	
$result = $conn->query($sql);

$sql = "INSERT INTO `fakaheda`.`graph_fhslotcount` (`id`, `count`, `date`) VALUES (NULL, '".$slots."', '" . $current_timestamp . "');";
	echo($sql."<br/>");

	
$result = $conn->query($sql);

$conn->close();
?>
