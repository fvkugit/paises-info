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
if (array_key_exists('status', $respuesta) && $respuesta['status'] == 404){header("Location: error.html");die();}
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
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title><?php echo($info->nombre)?></title>
</head>
<body>
    <table>
        <?php
        echo("<tr><th><h1>{$info->nombre}</h1></th></tr>");
        foreach($info as $clave => $valor) {if ($clave == 'nombre'){continue;};echo("<tr><td>{$valor}</td></tr>");}
        ?>
    </table>
    <form><input style="margin: auto; display: block; padding: 5px 30px;" type="button" value="Volver" onclick="history.back()"></form>
</body>
</html>