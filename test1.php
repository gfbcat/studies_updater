<html>
<head>
<title>Test 1</title>
<h1>Test 1</h1>
</head>

<body>

<?php

$graus_mitjans =array();


//WEB SCRAPING
$main_url = "https://www.todofp.es";
$html = file_get_contents($main_url."/que-como-y-donde-estudiar/que-estudiar/ciclos/grado-medio.html");

$dom = new DOMDocument;
@$dom->loadHTML($html);
$dom->preserveWhiteSpace=true; //A la web era false, CAL DESCOBRIR QUÈ FA!


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
    //echo var_dump($row).'<br><br>';
    $familia;
    $f = $row->getElementsByTagName('th');
    if ($f->length != 0) {
        $familia = $f->item(0)->getElementsByTagName('img')->item(0)->getAttribute('alt');
        //echo var_dump($familia).'<br><br>';
    } //else { echo "Same <br><br>"; }


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

        /*else { //if (strlen($column) == 0) {
            $c = $col->getElementsByTagName('img');
            if ($c->length == 1) {
                $column = $c->item(0)->getAttribute('alt');
            } 
            elseif ($c->length >1) {
                //foreach ($c as ) {

                //}
            }echo "1---";
            }*/
        $col_counter++;

        //echo $column."<br><br>";
    }

    echo $titulacio." ; ".$url_cv_ccaa." ; ".$url_where;
    echo "<br><br>";
    
    
    /*
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
    }*/
}

?>

</body>

