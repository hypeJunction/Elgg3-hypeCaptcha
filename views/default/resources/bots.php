<?php

$title = elgg_echo('captcha:page:bots');

$error = elgg_echo('captcha:page:bots:error');

$content = elgg_view_message('error', $error, [
	'title' => false,
]);

$layout = elgg_view_layout('default', [
	'title' => $title,
	'content' => $content,
]);

$shell = elgg_get_config('walled_garden') ? 'walled_garden' : 'default';

echo elgg_view_page(null, $layout, $shell);