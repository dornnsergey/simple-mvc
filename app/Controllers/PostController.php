<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Post;
use App\View;

class PostController
{
    public function index()
    {
        $posts = Post::all();

        return View::make('posts', compact('posts'));
    }
}