<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
<h1 align="center">Project Destinasi Wisata Riau</h1>
<h3 align="center">TryAl Developer</h3>

Cara Buat Controller Dialam Sub Folder
```sh
$ php artisan make:controller Backend/PenggunaController --resource
```

# List Middleware
```sh
- 1 super_admin
- 2 auth_destinasi
- 3 auth_ekraf
- 4 auth_sdp
- 5 auth_pemasaran
- 6 auth_upt
- 7 auth_kabupaten
```

# Cara Menggunakan Middleware
Masukan multiple setelah role,  masukan sesuai kebutuhan
```php
    public function __construct()
    {
        $this->middleware(['role:super_admin,auth_destinasi']);
    }
```

# Configurasi
storage dan .env tambahkan manual
```sh
# update composer
$ composer update

# untuk mendapatkan key baru
$ php artisan key:generate
$ php artisan migrate:fresh --seed
```

# KODE SOSIAL MEDIA
```sh
- 1 objek wisata
- 2 restaurant
- 3 hotel
- 4 cindramata
```