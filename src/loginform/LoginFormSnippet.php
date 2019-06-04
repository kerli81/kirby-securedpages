<div id="kerli81-securedpages-loginform">
    <div class="login-page">
        <div class="form">
            <?php if ($form->error()) : ?>
                <p class="error-text"><?php echo implode('<br>', $form->error()) ?></p>
            <?php endif; ?>

            <form class="login-form" method="POST">
                <input name="username" type="text" placeholder="<?= option('kerli81.securedpages.loginform.username.name') ?>" value="<?php echo $form->old('username') ?>">
                <input name="password" type="password" placeholder="<?= option('kerli81.securedpages.loginform.password.name') ?>" />
                <?php echo csrf_field() ?>
                <button>login</button>
            </form>
        </div>
    </div>
</div>