<?php
error_reporting(0);
// example of how to modify HTML contents
include('../simple_html_dom.php');

function getHTML($url,$timeout)
{
       $ch = curl_init($url); // initialize curl with given url
       curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]); // set  useragent
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // write the response to a variable
       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // follow redirects if any
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); // max. seconds to execute
       curl_setopt($ch, CURLOPT_FAILONERROR, 1); // stop when it encounters an error
       return @curl_exec($ch);
}

//Check Query String
if($_GET["l"]) {
    //List Parse
    listQ($_GET["l"]);
} else if ($_GET["o"]){
    //LOST Parse
    listO($_GET["o"]);
} else if ($_GET["d"]){
    //Detail Parse
    listD($_GET["d"]);
} else{
	//Default List view
	listQ();
};


function listQ($qUrl="http://www.petharbor.com/results.asp?searchtype=ADOPT&start=4&nopod=1&friends=1&samaritans=1&nosuccess=0&rows=8&imght=80&imgres=detail&tWidth=200&view=sysadm.v_lsvg_new&nomax=1&fontface=arial&fontsize=10&miles=20&shelterlist=%27LAWR%27&atype=&where=type_Dog,gender_0,size_0,age_0,color_0&PAGE=1") {

	$htmlLoad = getHTML($qUrl,10);

	$html = new simple_html_dom();
	$html->load($htmlLoad);
	$first = true;
	$tPages = $html->find("center",-2);
	$tApages = $tPages->find('a');
	$cPages = $html->find("center",-3)->plaintext;
	$totalPages = count($tApages);
	$current = (int)$cPages[5].$cPages[6];
	//echo $tApages[0];

	for($i = 0; $i < $totalPages; ++$i) {

		if($i==0 && $current==1){
			$itemP['title'] = $current;
			$itemP['current'] = true;
			$itemP['type'] = '#';
			$pages[] = $itemP;
			$itemP['title'] = $tApages[$i]->plaintext;
	    	$itemP['current'] = false;
	    	$query = parse_url($tApages[$i]->href, PHP_URL_QUERY);
			parse_str($query, $params);
			$itemP['type'] = explode(',', $params['where']);
			$itemP['num'] = $params['PAGE'];
			$pages[] = $itemP;
			continue;
		};

    	$itemP['title'] = $tApages[$i]->plaintext;
    	$itemP['current'] = false;
		$query = parse_url($tApages[$i]->href, PHP_URL_QUERY);
			parse_str($query, $params);
			$itemP['type'] = explode(',', $params['where']);
			$itemP['num'] = $params['PAGE'];
		$pages[] = $itemP;

		if($i == $current-1){
			$itemP['title'] = $current;
			$itemP['current'] = true;
			$itemP['type'] = '#';
			$itemP['num'] = $params['PAGE'];
			$pages[] = $itemP;
		};
	};


	// Find all animals, ie all divs with a class name of .gridResults
	foreach($html->find('tr[align="CENTER"]') as $animal) {

		if($first) {
	        $first = false;
	        continue;
	    }

		$content = $animal->find('td');
		$videoContainer = $content[2];
		$video = $videoContainer->find('a',0);

		$pattern = '!(?<=\()[A-Za-z ,\d]*[\d]{4}(?=\))!';
		$res = preg_match_all($pattern,$content[1]->plaintext,$myId);
		$item['id'] = $content[1]->plaintext;

		$item['name'] = $content[2]->plaintext;
		$item['kennel'] = $content[3]->plaintext;
		$item['gender'] = $content[5]->plaintext;
		$item['color'] = $content[6]->plaintext;
		$item['breed'] = $content[7]->plaintext;
		$item['age'] = $content[8]->plaintext;
		$item['shelter'] = $content[9]->plaintext;

		//For every animal find its associated image, then add to items array
		foreach($animal->find('img') as $e){
	    	$item['image'] = 'http://www.petharbor.com/' . $e->src;
		}
		
	    	if(isset($video)){
	    		$item['video'] = true;
	    	}else{ $item['video'] = false;}

	    $animals[] = $item;
	};

	echo json_encode(array($pages,$animals));
};

function listO($qUrl="http://www.petharbor.com/results.asp?searchtype=LOST&start=4&nopod=1&friends=1&samaritans=1&nosuccess=0&rows=8&imght=80&imgres=detail&tWidth=200&view=sysadm.v_lsvg_new&nomax=1&fontface=arial&fontsize=10&miles=20&shelterlist=%27LAWR%27&atype=&where=type_Cat,gender_0,size_0,age_0,color_0&NewOrderBy=Time%20At%20Shelter&PAGE=1") {

	$htmlLoad = getHTML($qUrl,10);

	$html = new simple_html_dom();
	$html->load($htmlLoad);
	$first = true;
	$tPages = $html->find("center",-3);
	$tApages = $tPages->find('a');
	$cPages = $html->find("center",-4)->plaintext;
	$totalPages = count($tApages);
	$current = (int)$cPages[5].$cPages[6];
	//echo $tApages[0];

	for($i = 0; $i < $totalPages; ++$i) {

		if($i==0 && $current==1){
			$itemP['title'] = $current;
			$itemP['current'] = true;
			$itemP['type'] = '#';
			$pages[] = $itemP;
			$itemP['title'] = $tApages[$i]->plaintext;
	    	$itemP['current'] = false;
	    	$query = parse_url($tApages[$i]->href, PHP_URL_QUERY);
			parse_str($query, $params);
			$itemP['type'] = explode(',', $params['where']);
			$itemP['num'] = $params['PAGE'];
			$pages[] = $itemP;
			continue;
		};

    	$itemP['title'] = $tApages[$i]->plaintext;
    	$itemP['current'] = false;
		$query = parse_url($tApages[$i]->href, PHP_URL_QUERY);
			parse_str($query, $params);
			$itemP['type'] = explode(',', $params['where']);
			$itemP['num'] = $params['PAGE'];
		$pages[] = $itemP;

		if($i == $current-1){
			$itemP['title'] = $current;
			$itemP['current'] = true;
			$itemP['type'] = '#';
			$itemP['num'] = $params['PAGE'];
			$pages[] = $itemP;
		};
	};


	// Find all animals, ie all divs with a class name of .gridResults
	foreach($html->find('tr[align="CENTER"]') as $animal) {

		if($first) {
	        $first = false;
	        continue;
	    }

		$content = $animal->find('td');
		$videoContainer = $content[1];
		$video = $videoContainer->find('a',0);

		$pattern = '!(?<=\()[A-Za-z ,\d]*[\d]{4}(?=\))!';
		$res = preg_match_all($pattern,$content[1]->plaintext,$myId);
		$item['id'] = $content[1]->plaintext;

		$item['name'] = $content[2]->plaintext;
		$item['kennel'] = $content[3]->plaintext;
		$item['gender'] = $content[5]->plaintext;
		$item['color'] = $content[6]->plaintext;
		$item['breed'] = $content[7]->plaintext;
		$item['age'] = $content[8]->plaintext;
		$item['shelter'] = $content[9]->plaintext;
		
		if($item['gender'] == '&nbsp'){
			$item['gender'] = "Unknown";
		};
		//For every animal find its associated image, then add to items array
		foreach($animal->find('img') as $e){
	    	$item['image'] = 'http://www.petharbor.com/' . $e->src;
		}
		
	    	if(isset($video)){
	    		$item['video'] = true;
	    	}else{ $item['video'] = false;}

	    $animals[] = $item;
	};

	echo json_encode(array($pages,$animals));
};


function listD($qUrl="") {
	$htmlLoad = getHTML($qUrl,10);

	$html = new simple_html_dom();
	$html->load($htmlLoad);
	$ret = $html->find('.DetailTable');
	$main = $ret[0];
	$secondary = $ret[1];
	// foreach($html->find('.DetailTable') as $animal) {

	// 	// $content = $animal->find('div.gridText');
	$e = $main->find('.DetailDesc');
	$title = $e[0]->find('.Title');
	$fdesc = preg_split('/<br[^>]*>/i', $e[0]);

	$str = substr($title[0]->plaintext, 0, strrpos($title[0]->plaintext, '-'));

	$item['name'] = preg_replace("/&#?[a-z0-9]{2,8};/i","",$str);
	$res = preg_match("/#(\w+)/", $title[0]->plaintext, $matches);
	$item['id'] = $matches[1];
	
	$preContent = $e[0]->outertext;
	$aContent = preg_replace('#<br>(\s*<br>)+#', '<br>', $preContent);
	$kTest = preg_split('/<br[^>]*>/i', $aContent);
	
	$searchword = 'I am in Kennel';
	$matches = array();
	$kmatch = null;
	foreach($kTest as $k=>$v) {
		if(preg_match("/\b$searchword\b/i", $v)) {
			$matches[$k] = $v;
			$kmatch = preg_replace('/\s+/', '', $v);
		}
	}
	$kNumber = preg_replace("/(.*?):(.*)/", "$2", $kmatch);
	
	//Check for nameless animals
    $aName = $item['name'];
    if($aName == "This DOG"){
		$item['kennel'] = $kNumber;
		$item['kennelId'] = $kNumber[0];
		$item['debug'] = $aContent;
    }else if($aName == "This CAT"){
		$item['kennel'] = $kNumber;
		$item['kennelId'] = $kNumber[0];
		$item['debug'] = $aContent;
    }else{
		$item['kennel'] = $kNumber;
		$item['kennelId'] = $kNumber[0];
		$item['debug'] = $aContent;
    };
	
	//For every animal find its associated image, then add to items array
	foreach($main->find('img') as $e){
		$item['image'] = 'http://www.petharbor.com/' . $e->src;
	}

	//Check for Video
	foreach($secondary->find('iframe') as $v){
		$item['video'] = $v->src;
	}

	//Check for additonal Shelter Details
	foreach($secondary->find('div[align="center"]') as $addInfo) {
		$item['scomments'] = $addInfo->plaintext;
	}

	if($item['scomments'] == 'Back'){
		$item['scomments'] = false;
	}

	$animal[] = $item;

	//print_r($fdesc);
	echo json_encode($animal);
};

?>
