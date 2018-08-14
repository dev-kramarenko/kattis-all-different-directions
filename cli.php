<?php
/**
 * Created by PhpStorm.
 * User: Aleksandr Kramarenko
 * Date: 14-Aug-18
 * Time: 09:42
 */

require_once __DIR__ . '/vendor/autoload.php';

$attempts = readline("Please enter number of directions: ");
if ($attempts < 1) {
    exit;
}

$directions = new App\Directions;

for ($i = 1; $i <= $attempts; $i++) {
    $directions->add(readline("Input {$i}: "));
}

echo $directions->calc() . PHP_EOL;