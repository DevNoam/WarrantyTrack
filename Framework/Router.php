<?php
namespace Framework;
use Framework\Middleware\Authorize;


class Router
{

  protected $routes = [];
  private $forwardRoutes = [];

  /**
   * Add a new route
   *
   * @param string $method
   * @param string $uri
   * @param string $action
   * @param array $middleware
   * 
   * @return void
   */
  public function registerRoute($method, $uri, $action, $middleware = [])
  {
    list($controller, $controllerMethod) = explode('@', $action);

    $this->routes[] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller,
      'controllerMethod' => $controllerMethod,
      'middleware' => $middleware
    ];
  }

  /**
   * Add a GET route
   * 
   * @param string $uri
   * @param string $controller
   * @param array $middleware
   * @return void
   */
  public function get($uri, $controller, $middleware = [])
  {
    $this->registerRoute('GET', $uri, $controller, $middleware);
  }

  /**
   * Add a POST route
   * 
   * @param string $uri
   * @param string $controller
   * @param array $middleware

   * @return void
   */
  public function post($uri, $controller, $middleware = [])
  {
    $this->registerRoute('POST', $uri, $controller, $middleware);
  }

  /**
   * Add a PUT route
   * 
   * @param string $uri
   * @param string $controller
   * @param array $middleware
   * @return void
   */
  public function put($uri, $controller, $middleware = [])
  {
    $this->registerRoute('PUT', $uri, $controller, $middleware);
  }

  /**
   * Add a DELETE route
   * 
   * @param string $uri
   * @param string $controller
   * @param array $middleware
   * @return void
   */
  public function delete($uri, $controller, $middleware = [])
  {
    $this->registerRoute('DELETE', $uri, $controller, $middleware);
  }

  /**
   * Load error page
   * @param int $httpCode
   *  
   * @return void
   */
  public function error($httpCode = 404)
  {
    if(session::has("id") == false)
    {
        redirect("/authenticate");
    }
    errorHandler($httpCode);
    return;
    exit;
}
/*
* Add a forward route
   * 
   * @param string $fromUri
   * @param string $toUri
   * @return void
   */
  public function forward($fromUri, $toUri)
  {
      $this->forwardRoutes[$fromUri] = $toUri;
    }

    /**
     * Route the request
     * 
     * @param string $uri
     * @param string $method
     * @return void
     */ 
    public function route($uri)
    {
      $requestMethod = $_SERVER['REQUEST_METHOD'];
      if ($requestMethod === 'POST' && isset($_POST['_method'])) {
        // Override the request method with the value of _method
        $requestMethod = strtoupper($_POST['_method']);
      }

      // Remove double slashes if any
      $uri = preg_replace('#/+#','/', $uri);
      // Check if the URI matches a forward route
      if (isset($this->forwardRoutes[$uri])) {
          $uri = $this->forwardRoutes[$uri];
          header('Location: ' . rtrim($uri, '/'), true, 301);
          exit();
      }
      
      // Remove trailing slash if it's not the root URI
      if ($uri !== '/' && substr($uri, -1) === '/') {
          header('Location: ' . rtrim($uri, '/'), true, 301);
          exit();
      }
        
        
        // Iterate through defined routes
        foreach ($this->routes as $route) {
          $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $route['uri']);
          $pattern = "#^{$pattern}$#";
          
          // Check if the current URI matches a defined route
          if (preg_match($pattern, $uri, $matches) && $route['method'] === $requestMethod) {
              array_shift($matches); // Remove the full match
              $params = $matches;

              // Check for authorization.
              foreach ($route['middleware'] as $middleware) {
                (new Authorize())->handle($middleware);
              }

              // require basePath($route['controller']);
              $controller = 'App\\controllers\\' . $route['controller'];
              $controllerMethod = $route['controllerMethod'];
    
              // Instatiate the controller and call the method
              $controllerInstance = new $controller();
              $controllerInstance->$controllerMethod($params);
              return;
          }
      }
        
        // Handle 404 error if no route matches
        $this->error(404);
    }
    
}