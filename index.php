<?php

use App\Advice;
use GuzzleHttp\Exception\GuzzleException;

require_once "vendor/autoload.php";

$advice = new Advice();

try {
    echo $advice->getRandom()->translate();
} catch (ErrorException | GuzzleException | Exception $e) {
    echo "Error: " . $e->getMessage();
}