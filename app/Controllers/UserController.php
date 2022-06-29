<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use App\View;

class UserController
{
    public function show($id): View
    {
        $user = User::findOrFail($id);

        return View::make('profile', compact('user'));
    }

    public function update($id): void
    {
        $user = User::findOrFail($id);

        $data = $this->validate($user);

        if ($user->update($data)) {
            $_SESSION['flash'] = 'User data has been changed successfully.';
        } else {
            $_SESSION['flash'] = 'Something went wrong.';
        }
        header('location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    public function validate(User $user): array
    {
        $name =  trim($_POST['name']);
        $email =  trim($_POST['email']);
        $password =  trim($_POST['pwd']);

        $data = ['name', 'email'];

        if (empty($name)) {
            $_SESSION['errors']['name'] = 'This field is required.';
        }
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']['email'] = 'Not a valid e-mail.';
        }
        if (empty($email)) {
            $_SESSION['errors']['email'] = 'This field is required.';
        }
        if (! password_verify($password, $user->password)) {
            $_SESSION['errors']['pwd'] = 'Password is incorrect';
        }

        if (! empty($_SESSION['errors'])) {
            header('location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        if (! empty($_FILES['image']['name']) && ! is_file($_FILES['image']['tmp_name'])) {
            $_SESSION['flash'] = 'Error. Not supported file.';
            header('location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        if (! empty($_FILES['image']['tmp_name'])) {
            $file = $_FILES['image']['tmp_name'];

            if (is_uploaded_file($file)) {
                $mime_type = mime_content_type($file);

                $allowed_file_types = ['image/png', 'image/jpeg'];

                if (! in_array($mime_type, $allowed_file_types)) {
                    $_SESSION['flash'] = 'File type is not allowed.';
                    header('location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                }

                $image = '/images/' . time() . '_' . $_FILES['image']['name'];
                if (! move_uploaded_file($file, $_SERVER['DOCUMENT_ROOT'] . $image)) {
                    $_SESSION['flash'] = 'File has not been downloaded.';
                    header('location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                }
                $data[] = 'image';
            }
        }

        return compact($data);
    }
}
