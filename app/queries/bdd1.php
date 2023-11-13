<?php

require("../config/conexion.php");
include('../templates/header.html');

// Fetch streaming providers
$streamingQuery = "SELECT * FROM streaming_providers";
$streamingResult = $db->query($streamingQuery);
$streamingProviders = $streamingResult->fetchAll(PDO::FETCH_ASSOC);

?>

<body>
    <div class='main'>
        <h1 class='title'>Proveedores de Streaming</h1>

        <?php foreach ($streamingProviders as $provider): ?>
            <div class='provider-container'>
                <h2><?php echo $provider['provider_name']; ?></h2>

                <!-- Primero hacemos una tabla para indexar los datos mas facil -->
                <?php
                $subscriptionInfoQuery = "SELECT * from algo";
                $subscriptionInfoResult = $db->query($subscriptionInfoQuery);
                $subscriptionInfo = $subscriptionInfoResult->fetch(PDO::FETCH_ASSOC);
                ?>
                <p>Valor de la suscripción: <?php echo $subscriptionInfo['subscription_value?']; ?></p>
                <p>Cantidad de películas: <?php echo $subscriptionInfo['movie_count?']; ?></p>
                <p>Cantidad de series: <?php echo $subscriptionInfo['series_count?']; ?></p>

                <!-- Boton para mostrar los 3 mejores -->
                <button class='show-content-btn' onclick="showContent('<?php echo $provider['provider_name']; ?>')">Mostrar Contenido</button>

                <!-- Search form -->
                <form action='./queries/search.php' method='GET'>
                    <input type='hidden' name='provider' value='<?php echo $provider['provider_name']; ?>'>
                    <label for='search'>Buscar:</label>
                    <input type='text' name='name' required>
                    <input type='submit' value='Buscar'>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        function showContent(providerName) {
            // Implementar lógica para ver 3 mejores
        }
    </script>
</body>
</html>
