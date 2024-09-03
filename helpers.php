<?php

/**
 * Get the base path
 * 
 * @param string $path
 * @return string
 */
function basePath($path = '')
{
  return __DIR__ . '/' . $path;
}

/**
 * Error handler
 * @param int $code
 * @return void
 */
function errorHandler($code)
{
  http_response_code($code);
  $db = new Framework\Database();
  loadView("error", ['database' => $db, 'errCode' => $code]);
  return;
  exit();
}

/**
 * Destroy other session
 * @param string $userId
 * @return void
 */
function destroyOtherSessions($userId)
{
  //Save the current session to a variable
  //Get session id from userId 
  $db = new Framework\Database();
  $sql = "SELECT session FROM `users` WHERE id = :id";
  $result = $db->query($sql, ['id' => $userId])->fetch();
  $targetSessionId = $result->session;

  // Step 2: Store current session ID and close it
  $currentSessionId = session_id();
  session_write_close(); 
  
  // Step 3: Switch to the target session and destroy it
  session_id($targetSessionId);
  session_start();
  session_unset();
  session_destroy();
  session_write_close(); 

  
  // Step 4: Restore the original session
  session_id($currentSessionId);
  session_start();
}
/**
 * Redirect to another page
 * @param string $path
 * @param int $httpCode
 * @return void
 */
function  redirect($path, $httpCode = 301)
{
  header("Location: {$path}", $httpCode);
  exit;
}

/**
 * Load a view
 * 
 * @param string $name
 * @return void
 * 
 */
function loadView($name, $data = [])
{
  $viewPath = basePath("App/views/{$name}.view.php");

  if (file_exists($viewPath)) {
    extract($data);
    require $viewPath;
  } else {
    echo "View '{$name} not found!'";
  }
}

/**
 * Load a API element
 * @deprecated This function is deprecated and will be removed.
 * 
 * @param string $name
 * @return void
 */
function loadAPI($name)
{
  $apiPath = basePath("App/controllers/API/{$name}.php");
  if (file_exists($apiPath)) {
    require $apiPath;
  } else {
    echo "API '{$name} not found!'";
  }
}

/**
 * Load a partial
 * 
 * @param string $name
 * @return void
 * 
 */
function loadPartial($name, $data = [])
{
    $partialPath = basePath("App/views/partials/{$name}.view.php");

    if (file_exists($partialPath)) {
        // Extract data array to make its elements available as variables in the included partial
        extract($data);
        require $partialPath;
    } else {
        echo "Partial '{$name}' not found!";
    }
}