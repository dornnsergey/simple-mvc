<?php

declare(strict_types=1);

namespace App\Models;

use App\App;
use App\Model;

class User extends Model
{
    protected static string $tableName = 'users';

    public static function loginAttempt(string $email, string $password): bool
    {
        $sql = 'select * from users where email = ?';

        $stmt = App::db()->prepare($sql);

        $stmt->execute([$email]);

        $user = $stmt->fetchObject(User::class);

        if (! $user) {
            $_SESSION['flash'] = 'User Not Found.';
            header('location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        if (password_verify($password, $user->password)) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['userName'] = $user->name;
            $_SESSION['userId'] = $user->id;
            return true;
        } else {
            $_SESSION['flash'] = 'Password is incorrect.';
            return false;
        }
    }
}
