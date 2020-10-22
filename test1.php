<html>
<head><h1>Test 1</h1></head>

<body>

<?php

$html = file_get_contents('https://www.todofp.es/que-como-y-donde-estudiar/que-estudiar/ciclos/grado-medio.html');
//echo $html;

$dom = new DOMDocument;
@$dom->loadHTML($html);
$dom->preserveWhiteSpace=true; //A la web era false, CAL DESCOBRIR QUÈ FA!

                          
$tables = $dom->getElementsByTagName('table'); //Tenim una DOMNodeList amb les taules
$LOEtable = $tables->item(0); //Extraiem la taula LOE, instància de DOMElement



$rows = $LOEtable->getElementsByTagName('tr');

$graus_mitjans =array();

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
?>

</body>

