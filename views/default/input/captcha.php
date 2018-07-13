<?php
if (elgg_is_logged_in()) {
	return;
}

$key = \hypeJunction\Captcha\Captcha::siteKey();
if (!$key) {
	return;
}

if (\hypeJunction\Captcha\Captcha::isHuman()) {
    return;
}

echo elgg_view_field([
	'#type' => 'hidden',
	'name' => '__rc',
	'value' => 1,
]);

$id = 'c-' . base_convert(mt_rand(), 10, 36);
echo elgg_format_element('div', [
	'id' => $id,
]);
?>
<script>
	function invokeRecaptcha() {
		require(['jquery', 'ajax/Form', 'elgg/Ajax'], function ($, AjaxForm, Ajax) {
			var verified = false;

			var widget = grecaptcha.render('<?= $id ?>', {
				'sitekey': '<?= $key ?>',
			});

			var $form = $('#<?= $id ?>').closest('form');
            $form.find('[type="submit"]').prop('disabled', true);

			var form = new AjaxForm($form);

			form.onSubmit(function (resolve, reject) {
				var token = grecaptcha.getResponse(widget);

				var ajax = new Ajax();
				ajax.action('recaptcha', {
					data: {
						token: token
					}
				}).done(function (response) {
					if (response.is_human) {
						$form.find('[type="submit"]').prop('disabled', false);
						resolve();
					} else {
						elgg.register_error(elgg.echo('captcha:error'));
						reject();
                    }
				});
			});
		});
	}

	require(['recaptcha']);
</script>