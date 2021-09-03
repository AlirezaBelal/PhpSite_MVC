<?php

namespace App\core\router;

use App\core\Application;

use App\controller\UserController;
use App\controller\AdminController;
use App\controller\HomeController;

class Routes
{
    //Define web pages and requests
    public static function getRoutes()
    {
        $app = Application::get_instance();

        $app->router->get('/', [HomeController::class, 'index'])->namePath("home");
        $app->router->get('/register', 'register')->namePath("register");
        $app->router->get('/login', 'login')->namePath("login");

        $app->router->post('/login', [UserController::class, 'login']);
        $app->router->post('/register', [UserController::class, 'register']);
        $app->router->post('/', [UserController::class, 'logout']);
        $app->router->get('/dashboard', [UserController::class, 'index'])->namePath("dashboard");
        $app->router->get('/upload', [UserController::class, 'upload'])->namePath("upload");

        $app->router->post('/upload', [UserController::class, 'uploadFile']);
        $app->router->post('/download', [UserController::class, 'download']);

        $app->router->get('/requests', [AdminController::class, 'requests'])->namePath("requests");
        $app->router->get('/users', [AdminController::class, 'users'])->namePath("users");
        $app->router->post('/accept', [AdminController::class, 'doAcceptFile']);
        $app->router->post('/delete', [AdminController::class, 'doDelete']);
        $app->router->post('/block', [AdminController::class, 'block']);
        $app->router->post('/unblock', [AdminController::class, 'unblock']);
        $app->router->post('/updateUser', [AdminController::class, 'updateUser']);
        $app->router->post('/downUser', [AdminController::class, 'downUser']);
    }
}