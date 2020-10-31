<?php

function curl($url) {
    $ch = curl_init($url);  //Inici sessió cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //Configura cURL per tornar el resultat com a cadena
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  //Corfigura cURL per a no verificar el peer del certificat del protocol HTTPS
    $info = curl_exec($ch);   //Estableix una sessió cURL i assigna la informació a la variable
    curl_close($ch);   //Tanca la sessió cURL
    return $info;   //Retorna la informació de la funció
}

/*/Testing
$html = curl('https://www.todofp.es/que-como-y-donde-estudiar/que-estudiar/ciclos/grado-medio.html');
//echo stristr(stristr(stristr($html, "Ciclos LOE"), "Ciclos LOE"), "Ciclos LOE");
echo $html;*/
?>
