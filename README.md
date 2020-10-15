<h1 align="center">Project Destinasi Wisata Riau</h1>
<h3 align="center">TryAl Developer</h3>

Cara Buat Controller Dialam Sub Folder
```sh
$ php artisan make:controller Backend/PenggunaController --resource
```

# List Middleware
```sh
- super_admin
- auth_destinasi
- auth_ekraf
- auth_sdp
- auth_pemasaran
- auth_upt
- auth_kabupaten
```

# Cara Menggunakan Middleware
Masukan multiple setelah role,  masukan sesuai kebutuhan
```php
    public function __construct()
    {
        $this->middleware(['role:super_admin,auth_destinasi']);
    }
```
