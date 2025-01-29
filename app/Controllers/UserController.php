<?php

namespace App\Controllers;

use App\Core\Validator;
use App\Models\User;


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

          $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];

      $rules = [
          'name' => ['required', ['max', 20]],
          'email' => ['required', 'email', ['unique', 'users.email']],
          'password' => ['required', 'password'],

      ];

      $validator = new Validator();

      if(!$validator->validate($data, $rules)) {
        
        $errors = $validator->getErrors();

        // var_dump($errors);
        // die();

        require_once __DIR__ . '/../Views/users/register.php';
        return;
      }
         
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $userModel = new User();

        // Save User
        $userModel->create([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
        ]);

        http_response_code(200);

        // var_dump($_SESSION['user']['name']);
        // die();
        
        $message = 'Congratulations Mr/Mrs. <strong>' . htmlspecialchars($name) . '</strong>, You have created an account successfully!';
        return redirectWithMessage('/dashboard', $message, 'success');
         
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
          $_SESSION['user'] = [
              'id' => $user['id'],
              'name' => $user['name'],
              'email' => $user['email'],
              'role' => $user['role'],
          ];
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
