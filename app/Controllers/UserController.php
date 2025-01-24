<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\Validator;
use App\Models\User;
use App\Core\Auth;
class UserController
{

  public function showLoginForm()
  {

      require_once __DIR__ . '/../Views/users/login.php';
  }

  public function showRegisterForm()
  {

      require_once __DIR__ . '/../Views/users/register.php';
  }


  public function register()
  {
    $errors = [];

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $name = $_POST['name'] ?? '';
          $email = $_POST['email'] ?? '';
          $password = $_POST['password'] ?? '';

          // var_dump($name, $email, $password);
          // exit();

          if (empty($name) || strlen($name) < 3) {
              $errors[] = "name must be at least 3 characters.";
          }
      
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $errors[] = "Invalid email address.";
          }
      
          if (empty($password) || strlen($password) < 6) {
              $errors[] = "Password must be at least 6 characters.";
          }

          // Basic Validation
          $validator = new Validator();
          if (!$validator->validateRequired([$name, $email, $password])) {
            $errors[] = "All fields are required!";
            
          }

          if (!$validator->validatePattern($name, '/^[a-zA-Z0-9_]{5,20}$/')) {
            $errors[] = "Invalid name format!";
 
          }

          if (!$validator->validateEmail($email)) {
            $errors[] = "Invalid email format!";
           
          }

          // Check if name or email already exists
          $userModel = new User();
          if ($userModel->exists('name', $name)) {
            $errors[] = "name already exists!";
            
          }

          if ($userModel->exists('email', $email)) {
            $errors[] = "Email already exists!";
           
          }

          // If errors exist, display them
          if (!empty($errors)) {
              require_once __DIR__ . '/../Views/users/register.php';
              return;
          }

          // Hash Password
          $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

          // Save User
          $userModel->create([
              'name' => $name,
              'email' => $email,
              'password' => $hashedPassword,
          ]);

              // Redirect to login page
          header('Location: /login');
          exit;
      }
  }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

          $errors = [];
          $email = $_POST['email'] ?? '';
          $password = $_POST['password'] ?? '';
      
          // Server-side validation
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $errors[] = "Invalid email address.";
          }
      
          if (empty($password) || strlen($password) < 6) {
              $errors[] = "Password must be at least 6 characters.";
          }
      
          if (!empty($errors)) {
              require_once __DIR__ . '/../Views/users/login.php';
              return;
          }
      
          // Check if the email exists in the database
          $userModel = new \App\Models\User();
          $user = $userModel->getUserByEmail($email);
      
          if (!$user || !password_verify($password, $user['password'])) {
              $errors[] = "Credentials doesn't match with our record.";
              require_once __DIR__ . '/../Views/users/login.php';
              return;
          }
      
          // If authentication succeeds, start session and redirect
          session_start();
          $_SESSION['user_id'] = $user['id'];
          header('Location: /dashboard');
          exit;

        }

        // Include login view
        include __DIR__ . '/../Views/users/login.php';
    }

    public function logout()
    {
      session_start();
      session_unset();
      session_destroy();
  
      header('Location: /login');
      exit;
    }


    
}
