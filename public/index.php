<?php
    require '../helpers.php';
	require basePath('Router.php');
	require basePath('Database.php'); 

	// Instantiating Router
	$router = new Router();

	// Getting Routes
	$routes = require basePath('routes.php');

	// Getting current URI and HTTP method
	$uri = $_SERVER['REQUEST_URI'];
	$method = $_SERVER['REQUEST_METHOD'];

	// Routing request
	$router->route($uri, $method);
