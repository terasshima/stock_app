# Portfolio Viewer

## Overview
株のポートフォリオ作成アプリ

## Description
このアプリは、使用者が設定した株のポートフォリオをグラフ化させます。
その際用いられるのは、パイグラフです。


## Usage
composerインストール、.envファイル作成、アプリケーションキー初期化
```
$ cd your/project
$ git clone git@github.com:hiroaki510/stock_app.git
//Composerをインストールしてから
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan key:generate --env=testing
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
データベースファイルの作成
```
$ cd database
$ ls -a
factories migrations seeds .gitignore
$ touch database.sqlite
```
マイグレーション
```
$ cd your/project
$ php artisan migrate
```
これでローカルサーバーが立ち上がり、ローカル環境でアプリの使用が出来ます。
```
$ cd your/project
$ php artisan serve
```
