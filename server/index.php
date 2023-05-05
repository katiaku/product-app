<?php

require   '../server/routes/routes.php';
require_once './http/cors.php';
require_once './app.php';
require_once './database/database.php';

$app = new App();
$app->run();
