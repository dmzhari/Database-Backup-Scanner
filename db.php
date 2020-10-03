<?php
error_reporting(0);
define("found","\e[32m");
define("notfound","\e[31m");
define("site","\e[34m");
define("note","\e[36m");
define("author","\e[92m");
define("chose","\e[94m");
define("chose2","\e[33m");
	class Scann_DB{
		public function Save($save,$name){
			$result = fopen($name, "w");
			fwrite($result, "$save\n");
			fclose($result);
		}
		public function Scan($site){
			$ok = "http://".$site;
			$db =  file_get_contents("https://raw.githubusercontent.com/dmzhari/bruteforce-lists/master/sql.txt");
			$expl = explode("\n", $db);
			echo site."\n[!] Site : ".$site."\n\n";
			foreach ($expl as $key) {
				for($i = 0; $i < $key;$i++);
				$scan = $ok.$key;
				file_get_contents($scan);
				if(preg_match('/200/i',$http_respone_header[0])){
					echo found."Found => ".$scan."\n";
					$re = "$scan\n";
					$this->Save($re,"result.txt");
				}
				else {
					echo notfound."Not Found => ".$scan."\n";
				}
			}
		}
		public function Mass_Scan($list){
			if(!file_exists($list)) die("File List ".$list." Not Found");
			$domain =  explode("\n", file_get_contents($list));
			foreach ($domain as $web) {
				$this->Scan($web);
			}
		}
		public function Chose(){
			echo author."\n[#] Author ./EcchiExploit [#]\n";
			echo note."Note : Don't Change http:// Or https:// !!!\n\n";
			echo chose2."\t\t1. Mass Scan DB\n";
			echo chose2."\t\t2. Not Mass Scan DB\n";
			echo chose."\nYour Chose => ";
			$pilih = trim(fgets(STDIN));
			switch ($pilih) {
				case '1':
					echo "\tYour List site => ";
					$our = trim(fgets(STDIN));
					$this->Mass_Scan($our);
					break;
				case '2':
					echo "\tYour Site => ";
					$url = trim(fgets(STDIN));
					$this->Scan($url);
					break;
				default:
					echo "Fuck You!!\n";
					break;
			}
		}
	}
	$mass = new Scann_DB();
	$mass->Chose();
?>