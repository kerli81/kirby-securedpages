<?php

namespace Plugin\SecuredPage;

@include_once __DIR__ . '/vendor/autoload.php';

use Kirby;
use Kirby\Cms\Page;

load([
    'Plugin\SecuredPage\RouterAfterHook' => 'src/RouterAfterHook.php'
], __DIR__);


Kirby::plugin('kerli81/securedpages', [
    'options' => [
        'logintype' => 'loginform', // [loginform, custom]
        'custom.page' => '',
        'loginform.username.name' => 'Username',
        'loginform.username.error' => 'Please enter your username',
        'loginform.password.name' => 'Password',
        'loginform.password.error' => 'Please enter your password',
    ],
    'hooks' => [
        'route:after' => function ($route, $path, $method, $result) {
            if ($route->env() == 'site') {

                $hook = new RouterAfterHook();
                $result = $hook->process($result, $this->user());

                if (!$result) {
                    if (option('kerli81.securedpages.logintype') == 'custom') {
                        $url = option('kerli81.securedpages.custom.page');
                    } else {
                        $url = url('/no-permission', ['params' => ['prevloc' => $path]]);
                    }
                    go($url);
                }
            }
        }
    ],
    'routes' => [
        [
            'pattern' => 'no-permission',
            'action' => function () {
                if (option('kerli81.securedpages.logintype') == 'loginform') {
                    return new Page([
                        'slug' => 'no-permission',
                        'template' => 'loginform'
                    ]);
                }
            },
            'method' => 'GET|POST'
        ]
    ],
    'blueprints' => [
        'fields/kerli81.securedpages.pageconfiguration' => __DIR__ . '/blueprints/fields/pagesecurity.yml'
    ],
    'controllers' => [
        'loginform' => require __DIR__ . '/src/loginform/LoginFormCtrl.php'
    ],
    'templates' => [
        'loginform' => __DIR__ . '/src/loginform/LoginFormTmpl.php'
    ]
]);
