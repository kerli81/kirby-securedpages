<?php

namespace Plugin\SecuredPage;

use Kirby;
use Kirby\Cms\Page;

load([
    'Plugin\SecuredPage\RouterAfterHook' => 'src/RouterAfterHook.php'
], __DIR__);


Kirby::plugin('kerli81/securedpages', [
    'options' => [
        'nopermission.title' => 'No Permission',
        'nopermission.text' => 'Page is protected. Please (link:panel text:Login)',
        'nopermission.template' => 'error'
    ],
    'hooks' => [
        'route:after' => function ($route, $path, $method, $result) {
            if ($route->env() == 'site') {

                $hook = new RouterAfterHook();
                $result = $hook->process($result, $this->user());

                if (! $result) {
                    go('/no-permission');
                }
            }
        }
    ],
    'routes' => [
        [
            'pattern' => 'no-permission',
            'action' => function () {
                return new Page([
                    'slug' => 'no-permission',
                    'template' => option('kerli81.securedpages.nopermission.template'),
                    'content' => [
                        'title' => option('kerli81.securedpages.nopermission.title'),
                        'text' => option('kerli81.securedpages.nopermission.text')
                    ]
                ]);
            }
        ]
    ],
    'blueprints' => [
        'fields/kerli81.securedpages.pageconfiguration' => __DIR__ . '/blueprints/fields/pagesecurity.yml'
    ]
]);

?>