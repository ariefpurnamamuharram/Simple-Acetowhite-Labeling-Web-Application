# Simple Acetowhite Labeling Web Application
Repositori ini berisi prototipe aplikasi web sederhana untuk membantu melabeli lesi _acetowhite_ pada foto pemeriksaan IVA (inspeksi visual asam asetat). Aplikasi web ini ini dibangun dengan _framework_ Laravel. Kode sumber program ini ditulis oleh **Arief Purnama Muharram**.

## Welcome
![Welcome](screenshot.png)

## Label Management
![Label Management](screenshot2.png)

## Image Area Mark Feature
![Label Management](screenshot3.png)

![Label Management](screenshot4.png)

## API Support
![API Support](screenshot5.png)

### Daftar Akses API
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
