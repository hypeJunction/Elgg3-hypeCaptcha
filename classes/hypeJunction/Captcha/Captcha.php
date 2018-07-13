<?php

namespace hypeJunction\Captcha;

class Captcha {

	const DEFAULT_THRESHOLD = 0.5;

	/**
	 * Get bot threshold
	 *
	 * @return float
	 * @throws \DI\DependencyException
	 * @throws \DI\NotFoundException
	 */
	public static function threshold() {
		$threshold = elgg()->get('recaptcha.threshold');
		if (!isset($threshold)) {
			return self::DEFAULT_THRESHOLD;
		}

		return (float) $threshold;
	}

	/**
	 * Check if recaptcha check should be passed
	 * @return bool
	 */
	public static function bypasses() {
		$session = elgg_get_session();
		$bypass = $session->get('recaptcha.bypass');
		return elgg_trigger_plugin_hook('bypass', 'captcha', null, $bypass);
	}

	/**
	 * Get site key
	 * @return mixed
	 * @throws \DI\DependencyException
	 * @throws \DI\NotFoundException
	 */
	public static function siteKey() {
		return elgg()->get('recaptcha.site_key');
	}

	/**
	 * Check if verification is complete
	 * @return bool
	 */
	public static function verificationComplete() {
		$session = elgg_get_session();
		$score = $session->get('recaptcha.score');

		return isset($score);
	}

	/**
	 * Check if user is a human
	 * Returns true or false if the verification has completed
	 * returns null if verification has not been done yet
	 *
	 * @return bool
	 * @throws \DI\DependencyException
	 * @throws \DI\NotFoundException
	 */
	public static function isHuman() {
		if (self::bypasses()) {
			return true;
		}

		$session = elgg_get_session();
		$score = $session->get('recaptcha.score');

		return $score >= self::threshold();
	}
}