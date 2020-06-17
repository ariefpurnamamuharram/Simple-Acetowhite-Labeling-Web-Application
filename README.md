# Simple Acetowhite Labeling Web Application
Repositori ini berisi aplikasi web sederhana untuk membantu melabeli lesi _acetowhite_ pada foto pemeriksaan IVA (inspeksi visual asam asetat) serviks. Aplikasi web ini ini dibangun dengan menggunakan _framework_ Laravel. Kode sumber program ini ditulis oleh **Arief Purnama Muharram**.

## Panduan Instalasi
1. Klon repositori, `git clone https://github.com/ariefpurnamamuharram/Simple-Acetowhite-Labeling-Web-Application.git` atau `https://github.com/CerviCam/Simple-Acetowhite-Labeling-Web-Application.git`.
2. Salin file `.env.example` menjadi `.env`. Rubah pengatauran akses database Anda.
3. Jalankan instalasi Composer dengan perintah `composer install`.
4. Jalankan instalasi NPM dengan perintah `npm install`.
5. Jalankan perintah `php artisan key:generate`.
6. Jalankan migrasi database dengan perintah `php artisan migrate`.
7. Jalankan database seeder dengan perintah `php artisan db:seed`.
8. Selesai.

## Screenshots
![Welcome](screenshot.png)

![Label Management](screenshot2.png)

![Label Management](screenshot3.png)

![Label Management](screenshot4.png)

![API Support](screenshot5.png)

## Daftar Akses API
- Download koleksi foto IVA positif
```
curl \
    -X GET \
    -H "Accept: application/json" \
    -H "Authorization: Bearer XXX" \
    http://localhost/api/download-iva-positive \
    --output file.zip
```
Ganti `XXX` dengan API Token Anda.

- Download koleksi foto IVA negatif
```
curl \
    -X GET \
    -H "Accept: application/json" \
    -H "Authorization: Bearer XXX" \
    http://localhost/api/download-iva-negative \
    --output file.zip
```
Ganti `XXX` dengan API Token Anda.

## Kontributor
Tim riset CerviCam:
1. Dr. dr. Hariyono Winarto, Sp.OG(K).
2. dr. Anindya Pradipta Susanto, B.Eng., MM.
3. Ucca Ratulangi Widitha, S.Ked.
4. Alessa Fahira, S.Ked.
5. Arief Purnama Muharram, S.Ked.
6. Harits Abdurrahman, S.Kom.
7. Arya Lukmana
