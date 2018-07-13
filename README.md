hypeCaptcha
===========
![Elgg 3.0](https://img.shields.io/badge/Elgg-3.0-orange.svg?style=flat-square)

Protects the site from bots using reCaptcha v3

## How this works

Whenever an authenticated user visits any page on the site, the plugin verifies the token and stores reCaptcha score in the session.
Users will low scores, aka bots, will be preventing from navigating the site further.

To override the check, use ``'bypass','captcha'`` hook.

There is a risk of false positives, so you may want to implement some sort of verification process,
e.g. you could use twilio_authy plugin to send an SMS code to the provided phone number, and set ``recaptcha.bypass``
session value.