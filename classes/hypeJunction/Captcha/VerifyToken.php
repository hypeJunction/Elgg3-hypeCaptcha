<?php

namespace hypeJunction\Captcha;

use Elgg\Request;
use GuzzleHttp\Client;

class VerifyToken {

	public function __invoke(Request $request) {

		$token = $request->getParam('token');

		$client = new Client();

		$response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
			'query' => [
				'secret' => elgg_get_plugin_setting('secret_key', 'hypeCaptcha'),
				'response' => $token,
			],
		]);

		if ($response->getStatusCode() === 200) {
			$contents = $response->getBody()->getContents();
			$data = json_decode($contents);

			if ($data->success) {
				Captcha::rememberHuman();
			}

			return elgg_ok_response([
				'is_human' => $data->success,
			]);
		}

		return elgg_error_response('', REFERER, $response->getStatusCode());
	}
}