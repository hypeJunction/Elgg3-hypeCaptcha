<?php

namespace hypeJunction\Captcha;

use Elgg\Hook;

class ConfigureRoutes {

	/**
	 * Set captcha gatekeeper for actions
	 *
	 * @param Hook $hook Hook
	 *
	 * @return array
	 * @throws \DI\DependencyException
	 * @throws \DI\NotFoundException
	 */
	public function __invoke(Hook $hook) {
		if (Captcha::isHuman()) {
			return null;
		}

		$type = $hook->getType();
		list($prefix, ) = explode(':', $type, 2);

		if ($prefix === 'action') {
			$config = $hook->getValue();

			$middleware = elgg_extract('middleware', $config, []);
			array_unshift($middleware, CaptchaGatekeeper::class);

			$config['middleware'] = $middleware;

			return $config;
		}
	}
}