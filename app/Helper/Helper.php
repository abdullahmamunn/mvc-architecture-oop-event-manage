<?php

if(! function_exists('redirectWithMessage')) {
  function redirectWithMessage($url, $message, $type) {
      $_SESSION['alert'] = [
        'message' => $message,
        'type' => $type 
    ];
    header("Location: $url");
    exit;
  }
}

if(! function_exists('formatDateTime')) {
  function formatDateTime($datetime) {

    $timestamp = strtotime($datetime);
    $formattedDate = date("j F, Y", $timestamp);
    $formattedTime = date("g:i a", $timestamp);

    return $formattedDate.' '.$formattedTime;

  }
}

if(! function_exists('formatDate')) {
  function formatDate($datetime) {

    $timestamp = strtotime($datetime);
    $formattedDate = date("j F, Y", $timestamp);
    return $formattedDate;

  }
}

if(! function_exists('formatTime')) {
  function formatTime($datetime) {

    $timestamp = strtotime($datetime);
    $formattedTime = date("g:i a", $timestamp);

    return $formattedTime;

  }
}

