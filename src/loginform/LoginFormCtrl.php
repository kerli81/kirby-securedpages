<?php

use Uniform\Form;

return function ($kirby) {
    $form = new Form([
        'username' => [
            'rules' => ['required'],
            'message' => option('kerli81.securedpages.loginform.username.error'),
        ],
        'password' => [
            'rules' => ['required', 'min' => 8],
            'message' => option('kerli81.securedpages.loginform.password.error'),
        ],
    ]);

    if ($kirby->request()->is('POST')) {
        $form->withoutGuards()->loginAction();

        if ($form->success()) {
            go(get('prevloc'));
        }
    }

    return compact('form');
};
