<?php snippet('header') ?>

<div id="kerli81-securedpages-loginform">
    <style type="text/css" scoped>
        .login-page {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
        }

        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form button {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #989898;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
        }

        .form button:hover,
        .form button:active,
        .form button:focus {
            background: #777777;
        }

        .error-text {
            border: 1px solid;
            margin: 10px 0px;
            padding: 15px 10px 15px 10px;
            background-repeat: no-repeat;
            background-position: 10px center;

            color: #D8000C;
            background-color: #FFBABA;
        }
    </style>

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




<?php snippet('footer') ?>