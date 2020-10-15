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
