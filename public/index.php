<?php

if (getenv('JAWSDB_URL') !== false) {
  $hostname = $dbparts['host'];
  $username = $dbparts['user'];
  $password = $dbparts['pass'];
  $database = ltrim($dbparts['path'], '/');
} else {
  $hostname = 'root';
  $username = 'Ff9120851!!';
  $password = 'test';
  $database = 'localhost';
}

use App\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';

return function (array $context) {
  return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
