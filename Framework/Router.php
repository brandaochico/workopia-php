<?php 

    namespace Framework;

	use App\controllers\ErrorController;

	class Router {
		protected $routes = [];

		/**
		 * Add a new route
		 * 
		 * @param string $method
		 * @param string $uri
		 * @param string $action
		 * @return void
		 */
		private function registerRoute($method, $uri, $action) {
			list($controller, $controllerMethod) = explode('@', $action);

			$this->routes[] = [
				'method' => $method, 
				'uri' => $uri,
				'controller' => $controller,
				'controllerMethod' => $controllerMethod
			];	
		}

		/**
		 * Add a GET route
		 * 
		 * @param string $uri
		 * @param string $controller
		 * @return void
		 */
		public function get($uri, $controller) {
			$this->registerRoute('GET', $uri, $controller);
		}

		/**
		 * Add a POST route
		 * 
		 * @param string $uri
		 * @param string $controller
		 * @return void
		 */
		public function post($uri, $controller) {
			$this->registerRoute('POST', $uri, $controller);
		}

		/**
		 * Add a PUT route
		 * 
		 * @param string $uri
		 * @param string $controller
		 * @return void
		 */
		public function put($uri, $controller) {
			$this->registerRoute('PUT', $uri, $controller);
		}

		/**
		 * Route the request
		 * 
		 * @param string $uri
		 * @param string $method
		 * @return void
		 */
		public function route($uri, $method) {
			foreach($this->routes as $route) {
				if($route['uri'] === $uri && $route['method'] === $method) {
					$controller = 'App\\controllers\\' . $route['controller'];
					$controllerMethod = $route['controllerMethod'];

					$controllerInstance = new $controller();
					$controllerInstance->$controllerMethod();
					
					return;
				}
			}

			ErrorController::notFound();	
		}
	}