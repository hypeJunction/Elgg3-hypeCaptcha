<?php

return [
	'bootstrap' => \hypeJunction\Captcha\Bootstrap::class,

	'actions' => [
		'recaptcha' => [
			'access' => 'public',
			'controller' => \hypeJunction\Captcha\VerifyToken::class,
		]
	],
];
