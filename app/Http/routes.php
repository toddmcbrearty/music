<?php

error_reporting(0);

//genius. just genius
$routeFiles = Illuminate\Support\Facades\Storage::disk('routes')->allFiles();

//pull out all the local-only routes
$localRoutes = preg_grep('/^[0-9]{3,}_local_.*\.php$/', $routeFiles);

//pulls all non-local routes
$productionRoutes = preg_grep('/^[0-9]{3,}_local_.*\.php$/', $routeFiles, PREG_GREP_INVERT);

//if we are in the local env load any local routes first
if (isenv('local')) {
    $routes = array_merge($localRoutes, $productionRoutes);
} else {
    $routes = $productionRoutes;
}

//this puts the into the correct loading order if we did the merge.
sort($routes);

//load all routes
foreach ($routes as $route) {
    $path = app_path('routes') . '/' . $route;
    if (fgets(fopen($path, 'r')) === "#ignore\n") continue;

    include $path;
}

