<?php

if (! function_exists('redirectWithMessage')) {
  function redirectWithMessage($url, $message, $type) {
      $_SESSION['alert'] = [
        'message' => $message,
        'type' => $type 
    ];
    header("Location: $url");
    exit;
  }
}
