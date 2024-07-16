<?php

include 'router/functions.php';

$routes = include 'router/routes.php';

run($_SERVER['REQUEST_URI'], $routes);