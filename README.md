# 天和くんBOT

- twitterにて、話しかけると配牌してくれるbot
- herokuへ構築する。

## 手順メモ

- Heroku > deploy >gitubと連携
- 以下も対応

```bash
$ echo "web: vendor/bin/heroku-php-apache2 public/" > Procfile
$ php artisan key:generate --show
hogehogehogehoge..... # ←これをherokuのConfig Varsに記載

```
