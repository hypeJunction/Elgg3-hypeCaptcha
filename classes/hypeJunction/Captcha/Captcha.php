<?php

namespace hypeJunction\Captcha;

class Captcha {

	/**
	 * Check if recaptcha check should be passed
	 * @return bool
	 */
	public static function bypasses() {
		$bypass = false;
		if (elgg_is_logged_in()) {
			$user = elgg_get_logged_in_user_entity();
			if ($user->recaptcha_is_human) {
				$bypass = true;
			}
		} else {
			$session = elgg_get_session();
			$bypass = $session->get('recaptcha.bypass');
		}

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
		$is_human = $session->get('recaptcha.is_human');

		return isset($is_human);
	}

	/**
	 * Remember solved captcha
	 * @return void
	 */
	public static function rememberHuman() {
		$session = elgg_get_session();
		$session->set('recaptcha.is_human', true);

		$user = elgg_get_logged_in_user_entity();
		if ($user) {
			$user->recaptcha_is_human = true;
		}
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
		return (bool) $session->get('recaptcha.is_human');
	}
}