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

    if (param('action') == 'logout' && $kirby->user()) {
        $kirby->user()->logout();
        go(url('/no-permission', ['params' => ['prevloc' => param('prevloc')]]));
    }

    $loginstatus = [
        'user' => $kirby->user(),
        'logouturl' =>  url('/no-permission', ['params' => ['prevloc' => param('prevloc'), 'action' => 'logout']])
    ];

    if ($kirby->request()->is('POST')) {
        $form->withoutGuards()->loginAction();

        if ($form->success()) {
            go(get('prevloc'));
        }
    }

    return compact('form', 'loginstatus');
};
