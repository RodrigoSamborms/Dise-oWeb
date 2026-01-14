<?php
$urls = array(
    "http://localhost/proyecto_lamp_desacoplado/src/faseA/api/personas.php",
    "http://[::1]/proyecto_lamp_desacoplado/src/faseA/api/personas.php",
    "http://127.0.0.1/proyecto_lamp_desacoplado/src/faseA/api/personas.php"
);

echo "<h1>Test de cURL desde PHP</h1>";
echo "<hr>";

foreach ($urls as $url) {
    echo "<h3>URL: " . htmlspecialchars($url) . "</h3>";
    echo "<pre>";
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $respuesta = curl_exec($ch);
    $info = curl_getinfo($ch);
    
    echo "HTTP Code: " . $info["http_code"] . "\n";
    echo "IP: " . $info["primary_ip"] . "\n";
    echo "Error: " . (curl_error($ch) ?: "Ninguno") . "\n";
    echo "Respuesta (100 chars): " . substr($respuesta, 0, 100) . "\n";
    
    curl_close($ch);
    echo "</pre>";
    echo "<hr>";
}
?>
