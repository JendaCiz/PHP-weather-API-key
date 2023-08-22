<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Počasí</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class='container mt-5'>
    <form action='' method='post'>
        Zadejte název města: <input type='text' name='city' required>
        <input type='submit' value='Získat počasí'>
    </form>
</div>

<?php
if (isset($_POST['city'])) {
    $city = $_POST['city'];

    $apiKey = "9bc0d16cef24e426079145e0d5ddc341";
    $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

    $response = file_get_contents($apiUrl);
    $weatherData = json_decode($response, true);

    if ($weatherData['cod'] == 200) {
        $temperature = $weatherData['main']['temp'];
        $humidity = $weatherData['main']['humidity'];

        echo "
        <div class='container mt-5'>
            <div class='alert alert-success'>
                Teplota v {$city} je {$temperature}°C s vlhkostí {$humidity}%.
            </div>
            
            <div class='card'>
                <div class='card-header text-center'>
                    Počasí v $city
                </div>
                <div class='card-body'>   
                    <p class='card-text text-center'>Teplota: {$temperature}°C</p>
                    <p class='card-text text-center'>Vlhkost: {$humidity}%</p> 
                </div>
            </div>
        </div>";
    } else {
        echo "<div class='container mt-5'>
                <div class='alert alert-danger'>
                    Nelze získat informace o počasí pro {$city}.
                </div>
              </div>";
    }
}
?>
</body>
</html>
