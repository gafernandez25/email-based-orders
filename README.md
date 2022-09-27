# Scope

Your task is to make the following possible:

- allow orders to come in via a dedicated email address
- provide an easy way to see all incoming orders
- make it easy to reply to an order

# Installation

1) Clone the repository
2) Go to application root directory
3) Install vendor packages with composer

```sh
composer install
```

5) Copy .env.example file to .env

``` sh
cp .env.example .env
```

6) Complete the following environment variables in .env file with the account where emails will be read from

(Double quotes are required if values have blank spaces)

``` sh
IMAP_READER_HOST=
IMAP_READER_PORT=
IMAP_READER_ENCRYPTION=
IMAP_READER_VALIDATE_CERT=
IMAP_READER_USERNAME=
IMAP_READER_PASSWORD=
IMAP_READER_FOLDER=""
```

7) Complete the following environment variables in .env file with the account where emails will be read from

(Double quotes are required if values have blank spaces)

``` sh
MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

You can easily use Mailtrap which will give you these values.
It's free and it does not send emails for real, so you won't have any problem with receivers.

[Mailtrap - How to start](https://help.mailtrap.io/article/12-getting-started-guide)

8) Execute artisan commands

``` sh
php artisan storage:link
php artisan config:clear
```

9) Make sure that thumbs directory inside public directory is owned by apache and has permission at least to write and
   execute.

``` sh
chown -R www-data:www-data bootstrap/cache/ storage/
```

# Testing

To run tests execute the following in root directory

``` sh
./vendor/bin/phpunit
```

or

``` sh
php artisan test
```
