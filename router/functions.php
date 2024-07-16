<?php

function run(string $url, array $routes)
{
    $uri = parse_url($url);
    $path = $uri['path'];
    if (!array_key_exists($path, $routes)) {
        echo 'page not found';
    } else {
        $callback = $routes[$path];
        $callback();
    }
}
