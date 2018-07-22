# Portfolio Viewer

## Overview
株のポートフォリオ作成アプリ

## Description
このアプリは、使用者が設定した株のポートフォリオを自動でグラフ化させます。
その際用いられるのは、パイグラフです。
また、東京証券取引所に上場している企業のみポートフォリオに組めませんが、株価を30分毎に自動取得出来ます。

## Usage
```
$ cd your/project 
$ git clone git@github.com:hiroaki510/stock_app.git
$ cp .env.example .env
$ open .env
```
.envファイルを以下に変更
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your/gmail/address
MAIL_PASSWORD=your/gmail/password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your/gmail/address
MAIL_FROM_NAME="Portfolio Viewer"
```


## Licence

[MIT](https://github.com/tcnksm/tool/blob/master/LICENCE)

## Author

[tcnksm](https://github.com/tcnksm)

