<?php

require   '../server/routes/routes.php';
require_once './http/cors.php';

$app = new App();
$app->run();
