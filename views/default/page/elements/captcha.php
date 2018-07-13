<?php
if (elgg_is_logged_in()) {
	return;
}

$key = \hypeJunction\Captcha\Captcha::siteKey();
if (!$key) {
    return;
}

if (\hypeJunction\Captcha\Captcha::verificationComplete()) {
    return;
}
?>
<script>
	function invokeRecaptcha() {
		grecaptcha.execute('<?= $key ?>', {
			action: 'homepage'
		}).then(function (token) {
			require(['elgg/Ajax'], function (Ajax) {
				let ajax = new Ajax(false);
				ajax.action('recaptcha', {
					data: {
						token: token
					}
				}).then(function (data) {
					if (data.score < data.threshold) {
						ajax.forward('bots');
					}
				});
			});
		})
	}

	require(['recaptcha']);
</script>