# Free_Market

- ある企業が開発した独自のフリマアプリ。

![FreeMarket_Top](https://github.com/ishinagakazuyuki/Free_Market/assets/135584828/6452348e-be60-428f-8cdc-c245c86ca3d0)

## 作成した目的

- 模擬案件を通して、自分自身の力量を確かめるため。

## 機能一覧

- 会員登録
- ログイン・ログアウト
- 商品一覧取得
- 商品詳細取得
- 検索機能
- ユーザ商品お気に入り一覧取得
- ユーザ情報取得
- ユーザ購入商品一覧取得
- ユーザ出品商品一覧取得
- プロフィール変更
- 商品お気に入り追加
- 商品お気に入り削除
- 商品コメント追加
- 商品コメント削除
- 出品
- 購入
- 配送先変更
- 支払い方法変更
- ユーザ削除（管理者のみ）
- メール送信（管理者のみ）

## 使用技術(実行環境)
◇開発環境
- Laravel Framework 8.83.27
- PHP 7.4.9 (cli) (built: Sep  1 2020 02:33:08) ( NTS )
- MySQL 8.0.26
- nginx 1.21.1
- phpMyAdmin　5.2.1
- mailhog

◇本番環境(AWS)
- Amazon EC2<br>
Ubuntu 22.04.3 LTS<br>
Laravel Framework 8.83.27<br>
PHP 8.1.2-1ubuntu2.14 (cli) (built: Aug 18 2023 11:41:11) (NTS)<br>
nginx 1.18.0 (Ubuntu)<br>
phpMyAdmin 5.1.1deb5ubuntu1<br>
- Amazon RDS<br>
MySQL 8.0.35<br>
- Amazon S3
- Amazon SES
## テーブル設計

![table drawio](https://github.com/ishinagakazuyuki/Free_Market/assets/135584828/18a0af1a-db32-4160-8ff0-e657a020f56a)

## ER 図

![ER drawio](https://github.com/ishinagakazuyuki/Free_Market/assets/135584828/1d814bd2-8bff-4f93-8fa8-d722c43d5b81)

## 環境構築

①クローン先のディレクトリに移動後、以下のコマンドを実行してください。<br>
◇初期設定<br>
git clone git@github.com:ishinagakazuyuki/Free_Market.git<br>
cd Free_Market<br>
docker-compose up -d --build<br>
docker-compose exec php bash<br>
composer install<br>
composer -v<br>
composer create-project --prefer-dist laravel/laravel stripe-project<br>
composer require stripe/stripe-php<br>
cp .env.example .env<br>
php artisan key:generate<br>
php artisan storage:link<br>
exit<br>
sudo chmod -R 777 *<br>
<br>
②.envファイルを以下の通りに修正してください。<br>
◇修正<br>
DB_HOST=mysql<br>
DB_DATABASE=laravel_db<br>
DB_USERNAME=laravel_user<br>
DB_PASSWORD=laravel_pass<br>
<br>
MAIL_FROM_ADDRESS=hello@example.com<br>
<br>
◇追加<br>
STRIPE_KEY="pk_test_51OIxl4IvhPYinHV0oio7tzICY0iGzWe2KNnXgu4Ss6RhyBvr20bhqRsg27hvSYZxM6IvJJsjrn4jo8Ln0PiPPF42007MtXePQG"<br>
STRIPE_SECRET="sk_test_51OIxl4IvhPYinHV083T4Rcf6DaT7ZhB1bqiXoG5ao2SEaHZX2RDQGBk2lctaJy3sJBFAXjV60nUgFTEEr5Gw5iT500WIYGmmES"<br>
<br>
③テーブルのリフレッシュ<br>
cd Free_Market<br>
docker-compose exec php bash<br>
php artisan migrate:fresh<br>
exit<br>
<br>
④初期ユーザーの登録<br>
以下のURLにアクセスして、必要事項を入力しユーザーを登録する。<br>
http://localhost/register <br>
<br>
以下のURLに接続して、クエリを実行する。<br>
http://localhost:8080/<br>
<br>
brandsテーブル初期設定用SQL<br>
INSERT INTO `brands`(`brand_name`) VALUES (' アレックス '),(' エルオス '),(' チャネル '),(' ガッチ ')<br>
<br>
categoriesテーブル初期設定用SQL<br>
INSERT INTO `categories`(`first`, `second`) VALUES (' 洋服 ', ' メンズ '),(' 洋服 ', ' レディス '),(' 靴 ', ' メンズ '),(' 靴 ', ' レディス ');<br>
<br>
conditionsテーブル初期設定用SQL<br>
INSERT INTO `conditions`(`name`) VALUES (' 未使用 '),(' 良好 '),(' 目立った傷・汚れなし '),(' 傷・汚れあり ')<br>
<br>
permissionsテーブル初期設定用SQL<br>
INSERT INTO `permissions`(`user_id`,`permission`) VALUES (' 1 ',' 1 ');<br>
　→初期ユーザーのIDが1以外の場合はVALUESの値を修正してください。<br>
<br>
⑤画像ファイルの配置<br>
cd Free_Market<br>
mkdir src/storage/app/public/images<br>
sudo chmod -R 777 src/storage/app/public/images<br>
<br>
Free_Marketディレクトリに存在する「images.zip」を解凍し、その中にある画像ファイルを<br>
src/storage/app/public/images に格納してください。<br>
<br>
⑥ダミーデータの登録<br>
cd Free_Market<br>
docker-compose exec php bash<br>
php artisan db:seed<br>
exit<br>
<br><br>
★本番環境へのアクセス<br>
URL：https://freemarket003.site/<br>
管理権限アカウント<br>
ユーザー名：ishikazu0920@gmail.com<br>
パスワード：zaq12wsx<br>
