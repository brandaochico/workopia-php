<?php
    require '../helpers.php';

	// Require file in Framework folder every time class is instantiated
	spl_autoload_register(function ($class) {
		$path = basePath('Framework/' . $class . '.php');
		if(file_exists($path)) {
			require $path;
		}
	});

	// Instantiating Router
	$router = new Router();

	// Getting Routes
	$routes = require basePath('routes.php');

	// Getting current URI and HTTP method
	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$method = $_SERVER['REQUEST_METHOD'];

	// Routing request
	$router->route($uri, $method);
