hypeCaptcha
===========
![Elgg 3.0](https://img.shields.io/badge/Elgg-3.0-orange.svg?style=flat-square)

Protects the site from bots using reCaptcha

## Usage

```php
echo elgg_view_field(['#type' => 'captcha']);
```

Users are only requested to solve a captcha one. If they proved they are human, they won't be bothered again.