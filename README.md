# Web Desa Malik

Website Desa Malik adalah sebuah aplikasi berbasis web yang bertujuan untuk membantu memudahkan proses manajemen surat, analisis data, dan administrasi bagi pengurus desa serta pembuatan artikel yang dapat dibaca oleh warga desa untuk kemudahan dalam pencarian informasi terkini mengenai desa. Aplikasi ini dirancang khusus untuk memenuhi kebutuhan pengelolaan informasi di desa Malik.

## Fitur

- **Administrasi**: Aplikasi ini memiliki fitur administrasi yang memungkinkan pengguna untuk mengelola informasi penting terkait dengan desa, seperti data penduduk. Pengguna dapat dengan mudah mengubah dan mengupdate informasi tersebut.
- **Analisis Data**: Aplikasi ini dilengkapi dengan fitur analisis data yang membantu dalam mengumpulkan dan menganalisis data-data penting terkait dengan kegiatan di desa. Pengguna dapat melihat laporan, diagram, dan grafik berdasarkan data yang ada untuk memperoleh wawasan yang berguna.
- **Manajemen Surat**: Aplikasi ini menyediakan antarmuka untuk mengelola surat-surat yang dibuat. Pengguna dapat dengan mudah menambahkan, mengedit, dan menghapus surat-surat dengan template yang ada.
- **Pembuatan Artikel**: Aplikasi ini memungkinkan pengguna untuk membuat artikel-artikel yang dapat dibaca oleh warga desa. Pengguna dapat menulis artikel, menyematkan gambar, dan mempublikasikan artikel tersebut di website desa. Hal ini memungkinkan warga desa untuk mendapatkan informasi terbaru dan berita penting dengan mudah.

## Detail Teknis

Pastikan anda dapat memenuhi beberapa dependensi berikut:
- PHP >= 8.1.0 (dengan beberapa plugin standar seperti fpm, mysql, mbstring, xml, bcmath, intl, curl, zip, dll.)
- Composer >= 2.2.0

## Instalasi

<!-- ### *Linux* -->
1. Clone repository ini ke dalam direkori lokal anda:
	```bash
	git clone https://github.com/hafizh24122002/web_desa
	```
2. Pindah ke direktori proyek:
	```bash
	cd web_desa/
	```
3. Install Dependensi yang diperlukan:
	```bash
	composer install
	```
4. Copy file `.env.example` menjadi `.env`:
	```bash
	cp .env.example .env
	```
5. Generate `APP_KEY` baru:
	```bash
	php artisan key:generate
	```
6. Sesuaikan koneksi dengan database MySQL anda pada file `.env`, nilai default nya adalah sebagai berikut:
	```
	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=web_desa
	DB_USERNAME=root
	DB_PASSWORD=
	```
7. Lakukan migrasi database:
	```bash
	php artisan migrate:fresh --seed
	```
8. Jalankan Laravel pada localhost:
	```bash
	php artisan serve
	```

## Beberapa Masalah yang Mungkin Ditemui

`Class "..." not found`

- Masih terdapat dependensi yang belum terinstall jalankan kembali:
	```bash
	composer install
	```
- *TODO*

<!-- ## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->
