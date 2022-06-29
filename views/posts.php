<?php

require_once \App\Config::VIEW_PATH . '/header.php' ?>

    <main>
        <div class="container-fluid">
            <div class="card my-2">
                <?php foreach ($posts as $post) : ?>
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3><?= htmlspecialchars($post->title) ?></h3>
                    <div><?= date('d-m-Y', strtotime($post->created_at)) ?></div>
                </div>
                <div class="card-body">
                    <?= htmlspecialchars($post->text) ?>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </main>
<?php unset($_SESSION['errors'], $_SESSION['flash']) ?>
<?php require_once \App\Config::VIEW_PATH . '/footer.php' ?>