<?php

namespace hypeJunction\Captcha;

use Elgg\EntityPermissionsException;
use Elgg\Request;

class CaptchaGatekeeper {

	/**
	 * Forward bots to /bots
	 *
	 * @param Request $request Request
	 *
	 * @return void
	 * @throws EntityPermissionsException
	 * @throws \DI\DependencyException
	 * @throws \DI\NotFoundException
	 */
	public function __invoke(Request $request) {

		if (!Captcha::verificationComplete()) {
			return;
		}

		if (!Captcha::isHuman()) {
			$ex = new EntityPermissionsException();
			$ex->setRedirectUrl(elgg_generate_url('bots'));

			throw $ex;
		}
	}
}