<?php

declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\UserController;
use App\Router;

$router = new Router();

$router->get('/', [HomeController::class, 'index'])
        ->get('/register', [AuthController::class, 'showRegisterForm'])
        ->post('/register', [AuthController::class, 'register'])
        ->get('/login', [AuthController::class, 'showLoginForm'])
        ->post('/login', [AuthController::class, 'login'])
        ->post('/logout', [AuthController::class, 'logout'])
        ->get('/users/{id}', [UserController::class, 'show'])
        ->post('/users/{id}/update', [UserController::class, 'update'])
        ->get('/posts', [PostController::class, 'index']);
