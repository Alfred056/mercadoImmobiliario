<?php
namespace App\Router;

use App\Controller\ReporteController;

$app->group('/v1', function ($app) {
    $app->get('/pdf',ReporteController::class . ':report');
});