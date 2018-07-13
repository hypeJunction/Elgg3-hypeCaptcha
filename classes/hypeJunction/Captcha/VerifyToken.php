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

			elgg_get_session()->set('recaptcha.score', $data->score);

			$data->threshold = elgg_get_plugin_setting('threshold', 'hypeCaptcha');

			return elgg_ok_response((array) $data);
		}

		return elgg_error_response('', REFERER, $response->getStatusCode());
	}
}