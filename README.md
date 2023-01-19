# SI-Manajemen-Surat

Project ini menggunakan framework Laravel dan Filament.

## Fitur

-   Manajemen data surat masuk dan keluar
-   Manajemen data pegawai

## Instalasi

Copy dan masuk kedalam folder project

    cd si-manajemen-surat

Install depedensi melalui komposer

    composer install

Copy file konfigurasi .env dan sesuaikan nilainya

    cp .env.example .env

Generate key untuk project laravel

    php artisan key:generate

Jalankan migrasi untuk membuat tabel pada database

    php artisan migrate

Jalankan database seed untuk mengisi data

    php artisan db:seed

Mulai menjalankan local development server

    php artisan serve

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

## About Filament

Filament is a collection of tools for rapidly building beautiful TALL stack apps, designed for humans.

## Contributing

Thank you for considering contributing to this project!

## License

The project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
