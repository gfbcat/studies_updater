<html>
<head>
<title>Test 1</title>
<h1>Test 1</h1>
</head>

<body>

<?php
include "web_scraping.php";


$graus_mitjans =array();

$main_url = "https://www.todofp.es";

//WEB SCRAPING
$dom = web_scrap($main_url."/que-como-y-donde-estudiar/que-estudiar/ciclos/grado-medio.html");


//DATA EXTRACTION
$tables = $dom->getElementsByTagName('table'); //Tenim una DOMNodeList amb les taules
$LOEtable = $tables->item(0); //Extraiem la taula LOE, instància de DOMElement


//Get the columns titles
$titlesRow = $LOEtable->getElementsByTagName('thead')->item(0); //Sabem que només hi ha un element
$titles = $titlesRow->getElementsByTagName('th');               //Extraiem la llista de files

$titlesID = array(); //Where the titles are!
foreach ($titles as $title) {
    array_push($titlesID,$title->textContent);
}

//Get all the rows
$rows = $LOEtable->getElementsByTagName('tbody')->item(0)->getElementsByTagName('tr'); //Sabem que només hi ha un element i ja extraiem la llista de files

foreach ($rows as $row) {

    //Familia
    $familia;
    $f = $row->getElementsByTagName('th');
    if ($f->length != 0) {
        $familia = $f->item(0)->getElementsByTagName('img')->item(0)->getAttribute('alt');
    }


    //A aquesta part treiem totes les altres columnes. El col_counter ha de servir per a poder discriminar com tractar o sí tractar cada columna
    $cols = $row->getElementsByTagName('td');
    $col_counter = 0;
    foreach ($cols as $col) {
        if ($col_counter == 0) {      // Titulació
            $titulacio = trim($col->textContent);  
        }
        elseif ($col_counter == 3) {  // URL curriculums CCAA
            $c = $col->getElementsByTagName('a')->item(0);
            if ($c != NULL) {
                $url_cv_ccaa = $main_url.$c->getAttribute('href');
            } else { $url_cv_ccaa = NULL; }
        }
        elseif ($col_counter == 5) {  // URL on estudiar
            $c = $col->getElementsByTagName('a')->item(0);
            if ($c != NULL) {
                $url_where = $c->getAttribute('href');
            } else { $url_where = NULL; }
        }
        $col_counter++;
    }

    echo $titlesID[1].": ".$titulacio." ; ".$titlesID[4].": ".$url_cv_ccaa." ; ".$titlesID[6].": ".$url_where;
    echo "<br><br>";
}


?>
</body>
