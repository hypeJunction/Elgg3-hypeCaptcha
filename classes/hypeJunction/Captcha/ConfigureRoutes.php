<?php

namespace hypeJunction\Captcha;

use Elgg\Hook;

class ConfigureRoutes {

	/**
	 * Set captcha gatekeeper
	 *
	 * @param Hook $hook Hook
	 *
	 * @return array
	 */
	public function __invoke(Hook $hook) {
		$config = $hook->getValue();

		$middleware = elgg_extract('middleware', $config, []);
		array_unshift($middleware, CaptchaGatekeeper::class);

		$config['middleware'] = $middleware;

		return $config;
	}
}