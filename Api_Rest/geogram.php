<?php
/**
 * Created by PhpStorm.
 * User: Jaime
 * Date: 06/06/2019
 * Time: 13:05
 * api: https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAMMln820FmMK9cCoRry8glJHJhykHtnQE&address=disneyland,ca
 */
/*client instagram*/
define("CLIENTID", 'd03b1b28b06b487ca1299fe137e40c31');

$lat = 33.8120962;
$lng = -117.9211629;

if (!empty($_GET)){
    $maps_url = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAMMln820FmMK9cCoRry8glJHJhykHtnQE&address='. urlencode($_GET[location]);
    $maps_json = file_get_contents($maps_url);
    /*echo $maps_json;*/
    $maps_array = json_decode($maps_json, true);
    if(!empty($maps_array['results']['geometry']['location']['lat']) and !empty($maps_array['results']['geometry']['location']['lng'])) {
        $lat = $maps_array['results']['geometry']['location']['lat'];
        $lng = $maps_array['results']['geometry']['location']['lng'];
    }
    /**
     * Time to make our Instagram api request. We'll build the url using the
     * coordinate values returned by the google maps api
     */
    $url = 'https://' .
        'api.instagram.com/v1/media/search' .
        '?lat=' . $lat .
        '&lng=' . $lng .
        '&client_id='. CLIENTID; //replace "CLIENT-ID"
    $json = file_get_contents($url);
    $array = json_decode($json, true);
}


?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: sans-serif;
            font-style: normal;
            font-size: 2em;
            text-align: center;
        }

        h1 {
            color: chocolate;
            font-size: 1em;
        }
        #central {
            text-align: center;
            margin: 15% auto;
            padding: 0 1em;
            width: 40%;
            /*height: 30vh;*/
        }

        .formulaire {
            margin: auto;
            padding: 5%;
            width: 80%;
            background-color: rgba(0, 100, 130, 0.2);

        }

        input {
            color:red;
            font-size: 0.7em;
            border-radius: 0.3em;
        }

        button {
            font-size: 0.8em;
            margin-bottom: 0.5em;
        }

    </style>
    <title>geogram</title>
</head>
<body>
    <div id="central">
        <div class="formulaire">
            <h1>formulaire de recherche :</h1>
            <form action="">
                <input type="text" name="location">
                <button type="submit">submit</button>
            </form>
        </div>
            <div id="results" data-url="<?php if (!empty($url)) echo $url ?>">
                <?php
                if (!empty($array)) {
                    foreach ($array['data'] as $key => $item) {
                        echo '<img id="' . $item['id'] . '" src="' . $item['images']['low_resolution']['url'] . '" alt=""/><br/>';
                    }
                } else{
                    echo "Empty request";
                }
                ?>
            </div>
    </div>
</body>
</html>
