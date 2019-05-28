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
        'logintype' => 'panel', // [loginform, panel]
        'panel.title' => 'No Permission',
        'panel.text' => 'Page is protected. Please (link:panel text:Login)',
        'panel.template' => 'error',
        'loginform.username.name' => 'User-name',
        'loginform.username.error' => 'Please enter your username',
        'loginform.password.name' => 'Psss-word',
        'loginform.password.error' => 'Please enter your password',
    ],
    'hooks' => [
        'route:after' => function ($route, $path, $method, $result) {
            if ($route->env() == 'site') {

                $hook = new RouterAfterHook();
                $result = $hook->process($result, $this->user());

                if (!$result) {
                    $url = url('/no-permission', ['params' => ['prevloc' => $path]]);;
                    go($url);
                }
            }
        }
    ],
    'routes' => [
        [
            'pattern' => 'no-permission',
            'action' => function () {
                if (option('kerli81.securedpages.logintype') == 'panel') {
                    return new Page([
                        'slug' => 'no-permission',
                        'template' => option('kerli81.securedpages.panel.template'),
                        'content' => [
                            'title' => option('kerli81.securedpages.panel.title'),
                            'text' => option('kerli81.securedpages.panel.text')
                        ]
                    ]);
                } else if (option('kerli81.securedpages.logintype') == 'loginform') {
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
        'loginform' => require __DIR__ . '/src/LoginFormCtrl.php'
    ],
    'templates' => [
        'loginform' => __DIR__ . '/src/LoginFormTmpl.php'
    ]
]);
