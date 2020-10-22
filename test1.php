<html>
<head><h1>Test 1</h1></head>

<body>

<?php

$graus_mitjans =array();


//WEB SCRAPING
$html = file_get_contents("https://www.todofp.es/que-como-y-donde-estudiar/que-estudiar/ciclos/grado-medio.html");

$dom = new DOMDocument;
@$dom->loadHTML($html);
$dom->preserveWhiteSpace=true; //A la web era false, CAL DESCOBRIR QUÈ FA!


//DATA EXTRACTION
$tables = $dom->getElementsByTagName('table'); //Tenim una DOMNodeList amb les taules
$LOEtable = $tables->item(0); //Extraiem la taula LOE, instància de DOMElement


//Get the columns titles
$titlesRow = $LOEtable->getElementsByTagName('thead')->item(0);
$titles = $titlesRow->getElementsByTagName('th');

$titlesID = array(); //Where the titles are!
foreach ($titles as $title) {
    array_push($titlesID,$title->textContent);
}


//$rows = $LOEtable->getElementsByTagName('tbody'); //tr funciona

                          /*
foreach ($rows as $row) {
    $i=0;
    $families = $row->getElementsByTagName('th');
    foreach ($families as $f1) {
        if (is_object($f1)) {
            echo $f1->nodeValue;
        } elseif (strlen($f1)==0) {
            //echo $f1->getArttibute('alt');
            echo 'here we are';
        }
    }
    
    $cols = $row->getElementsByTagName('td');
    $col1 =  $cols->item(1);
    if (is_object($col1)) {
        //echo var_dump($col1->nodeValue).'</br>';
    }
    $i++;
}
                          */
?>

</body>

