<?php
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


listQ();

function listQ($qUrl="http://petharbor.com/results.asp?searchtype=ADOPT&start=4&nopod=1&friends=1&samaritans=1&nosuccess=0&rows=6&imght=80&imgres=detail&tWidth=200&view=sysadm.v_lsvg_new&nomax=1&fontface=arial&fontsize=10&miles=4&shelterlist=%27LAWR%27&atype=&where=gender_0,size_0,age_0,color_0") {

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

	echo json_encode(array($animals));
};

?>
