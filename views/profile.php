<?php

require_once \App\Config::VIEW_PATH . '/header.php' ?>

<main>
    <div class="container-fluid">
        <div class="row min-vh-100">
            <div class="col-6">
                <h1 class="my-3"><?= htmlspecialchars($user->name) ?>: Profile</h1>
                <div class="my-3">
                    <img src="<?= $user->image ?? '/images/user-placeholder.png' ?>" alt="" width="200" height="200">
                </div>
                <h3 class="my-2 border-bottom border-secondary border-2 col-7">About:</h3>
                <div class="row">
                    <div class="col-3">
                        <div class="my-4 fs-5">
                            UserId
                        </div>
                        <div class="my-4 fs-5">
                            Name
                        </div>
                        <div class="my-4 fs-5">
                            E-mail
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="my-4 fs-5">
                            <?= $user->id ?>
                        </div>
                        <div class="my-4 fs-5">
                            <?= htmlspecialchars($user->name) ?>
                        </div>
                        <div class="my-4 fs-5">
                            <?= htmlspecialchars($user->email) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (isset($_SESSION['loggedIn']) && $user->id === $_SESSION['userId']) : ?>
            <div class="col-3">
                <form action="/users/<?= $user->id ?>/update" method="post" enctype="multipart/form-data">
                    <h2 class="text-center mt-4">Edit User Data</h2>
                    <?php if (isset($_SESSION['flash'])) : ?>
                        <div class="alert alert-info">
                            <?= $_SESSION['flash'] ?>
                        </div>
                    <?php endif ?>
                    <div class="my-4">
                        <label for="file" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="file" value="
                        <?= htmlspecialchars($user->image) ?>">
                    </div>
                    <div class="my-4">
                        <input name="name" type="text" class="form-control
                        <?php if (isset($_SESSION['errors']['name'])) : ?>
                        is-invalid"
                        <?php endif ?>
                               placeholder="Your new name" value="<?= htmlspecialchars($user->name) ?>">
                        <?php if (isset($_SESSION['errors']['name'])) : ?>
                            <div class="invalid-feedback">
                                <?= $_SESSION['errors']['name'] ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="my-4">
                        <input name="email" type="email" class="form-control
                        <?php if (isset($_SESSION['errors']['email'])) : ?>
                        is-invalid"
                        <?php endif ?>
                                placeholder="Your new e-mail"  value="<?= htmlspecialchars($user->email) ?>">
                        <?php if (isset($_SESSION['errors']['email'])) : ?>
                            <div class="invalid-feedback">
                                <?= $_SESSION['errors']['email'] ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="my-4">
                        <input name="pwd" placeholder="Enter your password" type="password" class="form-control
                        <?php if (isset($_SESSION['errors']['pwd'])) : ?>
                        is-invalid
                        <?php endif ?>
                        ">
                        <?php if (isset($_SESSION['errors']['pwd'])) : ?>
                        <div class="invalid-feedback">
                            <?= $_SESSION['errors']['pwd'] ?>
                        </div>
                        <?php endif ?>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-outline-secondary w-100" type="submit">Change</button>
                    </div>
                </form>
            </div>
            <?php endif ?>
        </div>
    </div>
</main>
<?php unset($_SESSION['errors'], $_SESSION['flash']) ?>
<?php require_once \App\Config::VIEW_PATH . '/footer.php' ?>