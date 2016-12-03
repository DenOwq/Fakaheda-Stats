<?php
include_once('../database.php');

unlink("stdout.txt");

ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include_once('TesseractOCR.php');
	


		$username = 'Mruc%20Minecraft';
        $password = 'MatejDelfin12';
        $loginUrl = 'http://www.fakaheda.eu/prihlasit/';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $loginUrl);
        curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "login=".$username."&password=".$password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie-name');  //could be empty, but cause problems on some hosts
        curl_setopt($ch, CURLOPT_COOKIEFILE, '../tmp');  //could be empty, but cause problems on some hosts
        $answer = curl_exec($ch);
        if (curl_error($ch)) {
            echo curl_error($ch);
        }

		curl_setopt($ch, CURLOPT_URL, 'http://www.fakaheda.eu/herni-servery/minecraft-free-server-zdarma');
        curl_setopt($ch, CURLOPT_POST, false);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, "");
        $string = curl_exec($ch);
        if (curl_error($ch)) {
            echo curl_error($ch);
        }

		//echo $string;
		
		if (preg_match('/src=\"(data:[^"]*)\"/', $string, $matches) > 0) {
			unlink("image.png");
			file_put_contents('image.png', base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $matches[1])));
			//echo("<img src='image.png'>");
			$MCsql = "INSERT INTO `fakaheda`.`graph_freemc` (`id`, `count`, `date`) VALUES (NULL, '". substr(((new TesseractOCR('image.png'))->run()), -1)."', CURRENT_TIMESTAMP);";
			echo($MCsql);
					
			$MCresult = $conn->query($MCsql);


			$conn->close();
		}
	

echo("<img src='./image.png'>" . "<br><br>");
?>