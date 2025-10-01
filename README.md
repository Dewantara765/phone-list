
## Tentang Project ini

Ini adalah project web app list smartphone yang dikembangkan menggunakan Vue.js, Inertia.js, Laravel, Tailwind CSS (VILT)

## Cara Run Project ini di Local
1. Gunakan [XAMPP](https://www.apachefriends.org/) atau software sejenisnya jika anda memakai Windows/MacOS. Jika anda menggunakan Linux, anda bisa setup manual untuk web server, PHP, dan databasenya.

2. Siapkan file .env bisa lihat contohnya di ```.env.example``` .

3. Install [Composer](https://getcomposer.org/download/) dan [Nodejs](https://nodejs.org/en/download/). Composer untuk install depedency PHP dan Nodejs untuk install depedency Javascript. Kalau sudah, bisa skip langkah ini.

4. Clone project dengan command berikut.
```bash
    git clone https://github.com/Dewantara765/vilt-stack-phone-list.git
```

5. Run command di bawah ini untuk install depedency PHP. 
```bash
    composer install
```

6. Run command di bawah ini untuk install depedency Javascript. 
```bash
    npm install
```
7. Pastikan sudah start service database dan web servernya. Jika di XAMPP, start Apache dan MySQL nya

8. Run 2 command di bawah ini di 2 terminal yg terpisah (karena harus berjalan bersamaan)
```bash
    php artisan serve --host=0.0.0.0
    npm run dev
```
9. 2 command ini untuk migrate dan seed database anda (buat database dlu di PHPMyAdmin/manager database yang anda gunakan lalu set di .env)
   ```bash
      php artisan migrate
      php artisan db:seed 
   ```
10. Jika project belum bisa berjalan anda bisa cek ```ipconfig``` lalu ganti dengan IP anda di file ```vite.config.js```
11. Untuk verifikasi email anda harus menggunakan email asli (untuk pengirim). Sedangkan, untuk penerima (saat register akun) anda boleh memakai email sementara (karena fungsinya hanya untuk menerima inbox)
