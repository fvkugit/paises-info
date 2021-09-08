<?php
$pais = $_GET['pais'];
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://restcountries.eu/rest/v2/name/{$pais}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 120,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
    ),
));
$respuesta = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$respuesta = json_decode($respuesta, true);
$respuesta = $respuesta[0];
$info = new stdClass(); 
$info->nombre = ("Pais: {$respuesta['name']}");
$info->img = ("<img height=250px src={$respuesta['flag']} />");
$info->capital = ("Capital: {$respuesta['capital']}");
$info->gent = ("Gentilicio: {$respuesta['demonym']}");
$info->moneda = ("Moneda: {$respuesta['currencies'][0]['code']}");
$info->reg = ("Region: {$respuesta['region']}");
$info->subreg = ("Sub-region: {$respuesta['subregion']}");
$info->pob = ("Población: {$respuesta['population']}");
$info->area = ("Area: {$respuesta['area']}");
print_r($info)
?>
