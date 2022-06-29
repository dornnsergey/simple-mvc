<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
<section>
    <div class="container">
        <div class="row min-vh-100">
            <div class="col-12 col-sm-8 col-md-4 m-auto">
                <?php if (isset($_SESSION['flash'])) : ?>
                    <div class="alert alert-danger text-center">
                        <?= $_SESSION['flash'] ?>
                    </div>
                <?php endif ?>
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="125" height="125" fill="currentColor"
                                     class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd"
                                          d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control my-4 py-2
                            <?php
                            if (isset($_SESSION['errors']['email'])) : ?>
                            is-invalid
                            <?php endif ?>
                            " placeholder="E-mail">
                                <?php if (isset($_SESSION['errors']['email'])) : ?>
                                    <small class="invalid-feedback">
                                        <?= $_SESSION['errors']['email'] ?>
                                    </small>
                                <?php endif ?>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="pwd" class="form-control my-4 py-2
                            <?php if (isset($_SESSION['errors']['pwd'])) : ?>
                            is-invalid
                            <?php endif ?>
                            " placeholder="Password">
                                <?php if (isset($_SESSION['errors']['pwd'])) : ?>
                                    <small class="invalid-feedback">
                                        <?= $_SESSION['errors']['pwd'] ?>
                                    </small>
                                <?php endif ?>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary my-2" type="submit">Login</button>
                                <div class="d-flex justify-content-center small">
                                    Not registered yet?
                                    <a class="nav-link link-primary mx-1" href="/register">Sign Up</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
<?php
unset($_SESSION['errors'], $_SESSION['flash']) ?>