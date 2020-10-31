<?php
//include 'curl.php';

//WEB SCRAPING
//This module returns a DOMDocument object of a given URL

function web_scrap($url, $white_spaces=false) {
    $html = file_get_contents($url);

    //$html = curl($url);

    $dom = new DOMDocument;
    @$dom->loadHTML($html);
    $dom->preserveWhiteSpace=$white_spaces;

    return $dom;
}
?>
