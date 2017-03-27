<?php
// example of how to modify HTML contents
include('../simple_html_dom.php');

// get DOM from URL or file
$html = file_get_html('http://www.petharbor.com/detail.asp?ID=A484780&LOCATION=LSVG&searchtype=ADOPT&start=4&stylesheet=include/default.css&frontdoor=1&grid=1&friends=1&samaritans=1&nosuccess=0&rows=24&imght=120&imgres=thumb&tWidth=200&view=sysadm.v_animal&nomax=1&fontface=arial&fontsize=10&miles=20&lat=36.194168&lon=-115.22206&shelterlist=%27LSVG%27&atype=dog&where=type_DOG');

// Find all animals, ie all divs with a class name of .gridResults

$ret = $html->find('.DetailTable');
$main = $ret[0];
// foreach($html->find('.DetailTable') as $animal) {

// 	// $content = $animal->find('div.gridText');
$e = $main->find('.DetailDesc');
$title = $e[0]->find('.Title');
$fdesc = preg_split('/<br[^>]*>/i', $e[0]);

$item['name'] = $title[0]->plaintext;
$item['genbreed'] = $fdesc[2];
$item['age'] = $fdesc[4];
$item['doa'] = $fdesc[6];

//For every animal find its associated image, then add to items array
foreach($main->find('img') as $e){
	$item['image'] = 'http://www.petharbor.com/' . $e->src;
}

$animal[] = $item;

echo json_encode($animal);

?>