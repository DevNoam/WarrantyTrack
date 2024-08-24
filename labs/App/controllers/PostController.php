<?php
namespace App\controllers;
use Framework\Database;
use Framework\Session;


/*
 * Post controller
 * Related to all posts 
*/
class PostController
{
  protected $db;
    
  public function __construct()
  {
      $this->db = Database::$db;
  }

  public function showManagement()
  {
    $query = "SELECT p.postName, p.publish_date, p.publish, p.sticky, p.SEOimage, p.title, p.author, u.DisplayName as authorDisplayName, p.category, p.description, p.tag, p.tagColor FROM posts p JOIN users u ON p.author = u.id ORDER BY p.sticky DESC, p.publish_date DESC";
    $stmt = $this->db->query($query);
    $posts = $stmt->fetchAll();

      loadView('management/management', ['posts' =>  $posts, 'database' => $this->db]);
  }

  public function GetPosts($limitFetch = 5)
  {
      $query = "SELECT `postName`, `publish_date`, `publish`, `sticky`, `SEOimage`, `title`, `description`, `tag`, `tagColor` FROM posts WHERE publish = 1 ORDER BY sticky DESC, publish_date DESC LIMIT $limitFetch;";
      
      $stmt = $this->db->query($query);
      $posts = $stmt->fetchAll();

      return $posts;
  }
  /**
   * Retrieve post for edit mode.
   * 
   * @param string $postId
   * 
   * @return void
   */
  public function loadPostEditor($postId = null)
  {
    $post = [];
    if ($postId != null) 
    {
        // Populate form fields if editing an existing post
        $query = "SELECT posts.*, users.DisplayName AS authorDisplayName FROM posts JOIN users ON posts.author = users.id WHERE posts.postName = :postId";        
        $stmt =  $this->db->query($query, ['postId' => $postId[0]]);
        $post = $stmt->fetch();
        //if $post is empty, the post doesn't exist
        if (empty($post))
        {
          redirect('/postWriter');
          return;
          exit;
        }
    }
    //load postWriter view, if there is no post with the given $postId, this will be used to create a new post.
    loadView('management/postWriter', ['post' => $post, 'postId' => $postId[0] ?? null, 'database' => $this->db]);
  }


  public function makePost()
  {
    $allowedFields = ['SEOimage', 'tag', 'tagColor'];
    $checkboxFields = ['indexing', 'publish', 'sticky'];
    $requiredFields = ['postName', 'title', 'description', 'SEOkeywords', 'SEOdescription', 'content', 'category'];
  
      // Initialize $newListingData as an object
      $newListingData = new \stdClass();
      $newListingData->author = Session::get('user')['id'] ?? null;
  
      // Extract allowed and required fields from the input
      foreach (array_merge($allowedFields, $requiredFields) as $field) {
          $newListingData->$field = isset($_POST[$field]) ? htmlspecialchars($_POST[$field]) : null;
      }
  
      // Handle checkboxes: set to 1 if checked (value = "on"), otherwise 0
      foreach ($checkboxFields as $field) {
          $newListingData->$field = (isset($_POST[$field]) && $_POST[$field] === 'on') ? 1 : 0;
      }
  
      $errors = [];
  
      // Validate required fields
      foreach ($requiredFields as $field) {
          if (empty($newListingData->$field)) {
              $errors[$field] = ucfirst($field) . ' is required';
          }
      }
  
      // Validate author
      if (empty($newListingData->author)) {
          $errors['author'] = 'User ID is required';
      }
  
      // Check for duplicate postName
      $existingPost = $this->db->query("SELECT postName FROM posts WHERE postName = :postName", ['postName' => $newListingData->postName])->fetch();
      if ($existingPost) {
          $errors['postName'] = 'Post with this url already exists. <a href="/postWriter/' . $newListingData->postName . '">Meant to edit?</a>';
      }
  
      if (!empty($errors)) {
          // Reload view with errors
          loadView('management/postWriter', [
              'errors' => $errors,
              'post' => $newListingData
          ]);
      } else {
          // Prepare fields and values for SQL query
          $fields = [];
          $values = [];
  
          foreach ($newListingData as $field => $value) {
              // Convert empty strings to null
              if ($value === '') {
                  $value = null;
              }
  
              $fields[] = $field;
              $values[] = ':' . $field;
  
              // Assign the modified value back to the object
              $newListingData->$field = $value;
          }
  
          $fieldsList = implode(', ', $fields);
          $valuesList = implode(', ', $values);
  
          $query = "INSERT INTO posts ({$fieldsList}) VALUES ({$valuesList})";
  
          // Convert object to array for query execution
          $newListingDataArray = (array) $newListingData;
  
          // Execute query with prepared statement
          $operation = $this->db->query($query, $newListingDataArray);
        
          $code = 0;
          if ($operation->rowCount() > 0) {
              $code = 200; //OK
          } else {
              // No rows were updated, post not found or no change in value
              $code = 500; //ERROR
              $errors['server'] = 'SERVER ERROR, try again.';
              loadView('management/postWriter', [
                'errors' => $errors,
                'post' => $newListingData
            ]);
              return;
          }
          redirect('/post/' . $newListingData->postName, $code);
      }
  }
  

  /**
   * Update post
   * @param string $postId
   * 
   * @return bool
   */
  public function updatePost($postId)
  {
      $allowedFields = ['SEOimage', 'tag', 'tagColor'];
      $checkboxFields = ['indexing', 'publish', 'sticky'];
      $requiredFields = ['postName', 'title', 'description', 'SEOkeywords', 'SEOdescription', 'content', 'category'];
  
      // Initialize $updatedData as an object
      $updatedData = new \stdClass();
      $updatedData->author = Session::get('user')['id'] ?? null;
  
      // Extract allowed and required fields from the input
      foreach (array_merge($allowedFields, $requiredFields) as $field) {
          $updatedData->$field = isset($_POST[$field]) ? htmlspecialchars($_POST[$field]) : null;
      }
  
      // Handle checkboxes: set to 1 if checked (value = "on"), otherwise 0
      foreach ($checkboxFields as $field) {
          $updatedData->$field = (isset($_POST[$field]) && $_POST[$field] === 'on') ? 1 : 0;
      }
  
      $errors = [];
  
      // Validate required fields
      foreach ($requiredFields as $field) {
          if (empty($updatedData->$field)) {
              $errors[$field] = ucfirst($field) . ' is required';
          }
      }
  
      // Validate author
      if (empty($updatedData->author)) {
          $errors['author'] = 'User ID is required';
      }
  
      if (!empty($errors)) {
          // Reload view with errors
          //SHOW MESSAGE

          loadView('management/postWriter', [
              'errors' => $errors,
              'post' => $updatedData,
              'postId' => $postId[0]
          ]);
      } else {
          // Prepare fields for SQL update query
          $fields = [];
          foreach ($updatedData as $field => $value) {
              // Convert empty strings to null
              if ($value === '') {
                  $value = null;
              }
              $fields[] = "$field = :$field";
          }
  
          $fieldsList = implode(', ', $fields);
  
          // Add postId to updatedData
          $updatedData->postId = $postId[0];
  
          // Update query
          $query = "UPDATE posts SET {$fieldsList} WHERE postName = :postId";
  
          // Convert object to array for query execution
          $updatedDataArray = (array) $updatedData;
  
          // Execute query with prepared statement
          $operation = $this->db->query($query, $updatedDataArray);
          

          $code = 0;
          if ($operation->rowCount() > 0) {
              $code = 200; //OK
          } else {
              // No rows were updated, post not found or no change in value
              $code = 500; //ERROR
          }

          if($code == 200)
            Session::setFlashMessage('success_message', "Post \"$postId[0]\" UPDATED");
          else
            Session::setFlashMessage('error_message', "FAIIL TO UPDATE \"$postId[0]\"");
          redirect('/management', $code);
      }
  }
  
  /**
   * Delete post
   * @param string $postId
   * 
   * @return void
   */
  public function purgePost($postId = null)
  {
    echo "purge post";
    //Delete post
    $query = "DELETE FROM posts WHERE postName = :postId";
    $operation = $this->db->query($query, ['postId' => $postId[0]]);
    
    $code = 0;
    if ($operation->rowCount() > 0) {
        $code = 200; //OK
    } else {
        // No rows were updated, post not found or no change in value
        $code = 500; //ERROR
    }
    //redirect to home
    if($code == 200)
        Session::setFlashMessage('error_message', "Post \"$postId[0]\" DELETED");
    else
        Session::setFlashMessage('error_message', "FAIIL TO DELETE \"$postId[0]\"");
    redirect('/management', $code);
  }

  /**
   * Change post visibility
   * @param string $postId
   * 
   * @return bool
   */
  public function changeVisibility()
  {
    //UPDATE VISIBILITY
    $postId = $_POST['postId'];
    $operation = $_POST['operation'];
    $query = "UPDATE posts SET publish = :visibility WHERE postName = :postId";
    $operation = $this->db->query($query, ['visibility' => $operation, 'postId' =>$postId]);
    
    $code = 0;
    if ($operation->rowCount() > 0) {
        $code = 200; //OK
    } else {
        // No rows were updated, post not found or no change in value
        $code = 500; //ERROR
    }
    http_response_code($code);
    echo "http:" . $code;
  }

  /**
   * Make this post sticky
   * @param string $postId
   * 
   * @return bool
   */
  public function makeSticky()
  {
    $postId = $_POST['postId'];
    $operation = $_POST['operation'];
    //get the $_post value of postId
    $query = "UPDATE posts SET sticky = :sticky WHERE postName = :postId";
    $operation = $this->db->query($query, ['sticky' => $operation, 'postId' => $postId]);


    $code = 0;
    if ($operation->rowCount() > 0) {
        $code = 200; //OK
    } else {
        // No rows were updated, post not found or no change in value
        $code = 500; //ERROR
    }
    http_response_code($code);
    echo "http:" . $code;
  }
}