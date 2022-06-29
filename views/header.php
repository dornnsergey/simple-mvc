<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Profile</title>
</head>
<body>
<div class="container-fluid min-vh-100">
    <div class="row">
        <aside class="col-2 min-vh-100 bg-secondary">
            <div class="p-3 text-uppercase border-bottom border-1">
                <a class="navbar-brand text-light" href="/">
                    <img class="mx-1 rounded-circle" src="https://via.placeholder.com/50x50" alt="">
                    brand
                </a>
            </div>
        </aside>
        <section class="col-10">
            <header class="p-4 border-bottom border-1">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="/" class="nav-link text-primary">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/posts" class="nav-link text-primary">
                            Posts
                        </a>
                    </li>
                    <?php if (! isset($_SESSION['loggedIn'])) : ?>
                    <li class="nav-item ms-auto">
                        <a href="/login" class="btn btn-outline-secondary">
                            Login
                        </a>
                    </li>
                    <?php else : ?>
                        <div class="dropdown ms-auto my-2">
                            <a class="dropdown-toggle text-decoration-none text-secondary opacity-75" href="#"
                               role="button"
                               id="dropdownMenuLink"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $_SESSION['userName'] ?>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item opacity-75" href="/users/<?= $_SESSION['userId'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                        </svg>
                                        profile
                                    </a></li>
                                <li><a class="dropdown-item opacity-75" href="" onclick="event.preventDefault();
                                             document.getElementById('logout').submit();">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                                            <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                                            <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z"/>
                                        </svg>
                                        logout
                                    </a>
                                    <form class="d-none" id="logout" action="/logout" method="post"></form>
                                </li>
                            </ul>
                        </div>
                    <?php endif ?>
                </ul>
            </header>
