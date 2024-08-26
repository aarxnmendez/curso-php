<?php 

const API_URL = "https://whenisthenextmcufilm.com/api";           // Inicializar una nueva sesion de cURL; ch = cURL handle
$ch = curl_init(API_URL);                                      

                                                                  // Indicar que queremos recibir el resultado de la peticion y no mostrarla en la pantalla
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                   // Establece una opción para una transferencia cURL


$result = curl_exec($ch);                                         // Si la opción CURLOPT_RETURNTRANSFER está activada, devolverá el resultado en caso de éxito, false en caso contrario

$data = json_decode($result, true);                               // Transforma el resultado en un array asociativo

// Una alternativa seria usar file_get_contents
// $result = file_get_contents(API_URL) --> si solo quieres hacer un GET de una API
   
curl_close($ch);                                                  //Cerrar la sesion de cURL

?>

<head>
    <meta charset="UTF-8" />
    <title>La proxima pelicula de Marvel</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
    />
</head>

<main>
    <h1>Proximos lanzamientos de Marvel Studios</h1>
    <section>
        <img src="<?= $data["poster_url"]; ?>" width="500" alt="Poster de <?= $data["title"]; ?>" style="border-radius: 16px;"/>
    </section>

    <hgroup>
        <h3><?= $data["title"]; ?> se estrena en <?= $data["days_until"]; ?> días</h2>
        <p>Fecha de estreno: <?= $data["release_date"]; ?></p>
        <p>Resumen: <?= $data["overview"]; ?></p>
        <p>La siguiente es: <?= $data["following_production"]["title"]; ?>(<?= $data["following_production"]["days_until"]; ?>días)</p>
    </hgroup>
</main>

<style>
    :root {
        color-scheme: light dark;
    }

    body{
        display: grid;
        place-content: center;
    }
    section{
        display: flex;
        justify-content: center;
        text-align: center;
    }
    hgroup{
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }
</style>

