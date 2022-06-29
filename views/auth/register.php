<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>
<section>
    <div class="container">
        <div class="row min-vh-100">
            <div class="col-12 col-sm-8 col-md-4 m-auto">
                <div class="card">
                    <div class="card-body">
                        <form action="/register" method="post">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="125" height="125" fill="currentColor"
                                     class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    <path fill-rule="evenodd"
                                          d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                            </div>
                            <div class="mb-3">
                            <input placeholder="Username" type="text" name="name" class="has-validation form-control
                            py-2
                            <?php if (isset($_SESSION['errors']['name'])) : ?>
                            is-invalid
                            <?php endif ?>
                            ">
                            <?php if (isset($_SESSION['errors']['name'])) : ?>
                                <small class="invalid-feedback">
                                    <?= $_SESSION['errors']['name'] ?>
                                </small>
                            <?php endif ?>
                            </div>
                            <div class="mb-3">
                            <input placeholder="E-mail" type="email" name="email" class="form-control py-2
                            <?php if (isset($_SESSION['errors']['email'])) : ?>
                            is-invalid
                            <?php endif ?>
                            ">
                            <?php if (isset($_SESSION['errors']['email'])) : ?>
                                <small class="invalid-feedback">
                                    <?= $_SESSION['errors']['email'] ?>
                                </small>
                            <?php endif ?>
                            </div>
                            <div class="mb-3">
                            <input placeholder="Password" type="password" name="pwd" class="form-control py-2
                            <?php if (isset($_SESSION['errors']['pwd'])) : ?>
                            is-invalid
                            <?php endif ?>
                            ">
                            <?php if (isset($_SESSION['errors']['pwd'])) : ?>
                                <small class="invalid-feedback">
                                    <?= $_SESSION['errors']['pwd'] ?>
                                </small>
                            <?php endif ?>
                            </div>
                            <input type="password" name="pwdConfirm" class="form-control py-2"
                                   placeholder="Confirm Password">
                            <div class="text-center">
                                <button class="btn btn-primary my-2" type="submit">Register</button>
                                <div class="d-flex justify-content-center small">
                                    Already have an account?
                                    <a class="nav-link link-primary mx-1" href="/login">Sign In</a>
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
<?php unset($_SESSION['errors']) ?>