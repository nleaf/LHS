<?php
// example of how to modify HTML contents
include('../simple_html_dom.php');

// get DOM from URL or file
$html = file_get_html('http://www.petharbor.com/results.asp?searchtype=ADOPT&stylesheet=include/default.css&frontdoor=1&grid=1&friends=1&samaritans=1&nosuccess=0&rows=24&imght=400&imgres=thumb&tWidth=400&view=sysadm.v_animal&fontface=arial&fontsize=10&miles=20&lat=36.194168&lon=-115.22206&shelterlist=%27DDFL1%27&atype=dog&ADDR=undefined&nav=1&start=4&nomax=1&page=1&where=type_DOG');

// remove all image
//foreach($html->find('img') as $e)
//    $e->outertext = '';

// replace all input
//foreach($html->find('input') as $e)
//    $e->outertext = '[INPUT]';

// dump contents
echo $html;
?>