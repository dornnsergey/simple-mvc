<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use App\View;

class AuthController
{
    public function showLoginForm(): View
    {
        return View::make('auth/login');
    }

    public function showRegisterForm(): View
    {
        return View::make('auth/register');
    }

    public function login(): void
    {
        if (empty($_POST['email'])) {
            $_SESSION['errors']['email'] = 'Please enter your e-mail';
        }
        if (empty($_POST['pwd'])) {
            $_SESSION['errors']['pwd'] = 'Please enter your password';
        }

        if (! empty($_SESSION['errors'])) {
            header('location: ' . $_SERVER['HTTP_REFERER']);
            return;
        }

        if (User::loginAttempt(trim($_POST['email']), trim($_POST['pwd']))) {
            header('location: /');
        } else {
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    public function logout()
    {
        unset($_SESSION['userName'], $_SESSION['userId'], $_SESSION['loggedIn']);
        header('location: /');
    }

    public function register(): void
    {
        $id = User::create($this->validate());

        $_SESSION['flash'] = 'Your account has been successfully created!';
        $_SESSION['loggedIn'] = true;
        $_SESSION['userId'] = $id;
        $_SESSION['userName'] = $_POST['name'];

        header('location: /');
    }

    private function validate(): array
    {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $pwd = trim($_POST['pwd']);
        $password = password_hash($_POST['pwdConfirm'], PASSWORD_BCRYPT);

        if (empty($name)) {
            $_SESSION['errors']['name'] = 'This field is required.';
        }
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']['email'] = 'Not a valid e-mail.';
        }
        if (empty($email)) {
            $_SESSION['errors']['email'] = 'This field is required.';
        }
        if (! password_verify($pwd, $password)) {
            $_SESSION['errors']['pwd'] = 'Passwords do not match.';
        }
        if (strlen($pwd) < 6) {
            $_SESSION['errors']['pwd'] = 'Password must be 6 or more characters.';
        }
        if (empty($pwd)) {
            $_SESSION['errors']['pwd'] = 'This field is required.';
        }

        if (! empty($_SESSION['errors'])) {
            header('location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        return compact('name', 'email', 'password');
    }
}
