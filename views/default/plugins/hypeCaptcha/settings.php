<?php

$entity = elgg_extract('entity', $vars);

$link = elgg_view('output/url', [
	'href' => 'https://www.google.com/recaptcha/admin',
]);

echo elgg_view_message('notice', elgg_echo('captcha:notice', [$link]), [
	'title' => '',
]);

echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo('captcha:site_key'),
	'name' => 'params[site_key]',
	'value' => $entity->site_key,
]);

echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo('captcha:secret_key'),
	'name' => 'params[secret_key]',
	'value' => $entity->secret_key,
]);

echo elgg_view_field([
	'#type' => 'hidden',
	'name' => 'flush_cache',
	'value' => '1',
]);