<?php


if (! function_exists('gharmai')) {
  function gharmai($value) {
    echo "<pre>";
    print_r(json_decode($value));
    echo "</pre>";
    die();
  }
}