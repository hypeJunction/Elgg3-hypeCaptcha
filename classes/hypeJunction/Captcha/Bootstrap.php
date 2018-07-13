<?php

namespace hypeJunction\Captcha;

use Elgg\Includer;
use Elgg\PluginBootstrap;

class Bootstrap extends PluginBootstrap {

	/**
	 * Get plugin root
	 * @return string
	 */
	protected function getRoot() {
		return $this->plugin->getPath();
	}

	/**
	 * {@inheritdoc}
	 */
	public function load() {
		Includer::requireFileOnce($this->getRoot() . '/autoloader.php');
	}

	/**
	 * {@inheritdoc}
	 */
	public function boot() {
		elgg_register_plugin_hook_handler('route:config', 'all', ConfigureRoutes::class);
	}

	/**
	 * {@inheritdoc}
	 */
	public function init() {
		elgg_define_js('recaptcha', [
			'src' => elgg_http_add_url_query_elements('//www.google.com/recaptcha/api.js', [
				'onload' => 'invokeRecaptcha',
			]),
			'exports' => 'window.grecaptcha',
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function ready() {

	}

	/**
	 * {@inheritdoc}
	 */
	public function shutdown() {

	}

	/**
	 * {@inheritdoc}
	 */
	public function activate() {

	}

	/**
	 * {@inheritdoc}
	 */
	public function deactivate() {

	}

	/**
	 * {@inheritdoc}
	 */
	public function upgrade() {

	}

}