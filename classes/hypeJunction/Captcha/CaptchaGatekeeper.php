<?php

namespace hypeJunction\Captcha;

use Elgg\EntityPermissionsException;
use Elgg\HttpException;
use Elgg\Request;

class CaptchaGatekeeper {

	/**
	 * Forward bots to /bots
	 *
	 * @param Request $request Request
	 *
	 * @return void
	 * @throws HttpException
	 * @throws \DI\DependencyException
	 * @throws \DI\NotFoundException
	 */
	public function __invoke(Request $request) {

		if (Captcha::isHuman()) {
			return null;
		}

		$protected = $request->getParam('__rc');
		if (isset($protected) && !Captcha::isHuman()) {
			throw new HttpException(elgg_echo('captcha:gatekeeper'), ELGG_HTTP_FORBIDDEN);
		}
	}
}