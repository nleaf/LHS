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

$qUrl="http://www.petharbor.com/results.asp?searchtype=ADOPT&start=4&nopod=1&friends=1&samaritans=1&nosuccess=0&rows=8&imght=80&imgres=detail&tWidth=200&view=sysadm.v_lsvg_new&nomax=1&fontface=arial&fontsize=10&miles=20&shelterlist=%27LSVG%27&atype=&where=type_Dog,gender_0,size_0,age_0,color_0&PAGE=1";

$htmlLoad = getHTML($qUrl,10);

$html = new simple_html_dom();
$html->load($htmlLoad);

# Iterate over all the <a> tags
foreach($html->find('img') as $element) {
	echo $element->src . '<br>';
}
?>
