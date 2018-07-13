<?php

return [
	'bootstrap' => \hypeJunction\Captcha\Bootstrap::class,

	'actions' => [
		'recaptcha' => [
			'access' => 'public',
			'controller' => \hypeJunction\Captcha\VerifyToken::class,
		]
	],

	'settings' => [
		'threshold' => 0.5,
	],

	'routes' => [
		'bots' => [
			'path' => '/bots',
			'resource' => 'bots',
		],
	],
];
