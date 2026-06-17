# OrderNBrew

**OrderNBrew** adalah aplikasi web pemesanan dan pembayaran cafe berbasis Laravel dan MySQL. Aplikasi ini dibuat untuk memudahkan pelanggan dalam melihat menu, melakukan pemesanan, memilih nomor meja, melakukan pembayaran, serta melihat status pesanan secara online.

Di sisi cafe, sistem ini membantu admin, kasir, dan kitchen/barista dalam mengelola menu, memverifikasi pembayaran, memproses pesanan, serta melihat data penjualan.

---

## Deskripsi Project

OrderNBrew dirancang sebagai sistem digital untuk cafe agar proses pemesanan menjadi lebih cepat, rapi, dan terintegrasi. Pelanggan dapat memilih menu langsung melalui website, memasukkan pesanan ke keranjang, melakukan checkout, lalu melakukan pembayaran secara online atau melalui simulasi pembayaran.

Sistem ini juga menyediakan dashboard untuk pihak cafe, seperti admin untuk mengelola menu, kasir untuk mengecek pembayaran, dan kitchen/barista untuk memproses pesanan.

---

## Fitur Utama

### Customer
- Melihat daftar menu cafe
- Melihat kategori menu
- Menambahkan menu ke keranjang
- Mengatur jumlah pesanan
- Checkout pesanan
- Mengisi nama pelanggan dan nomor meja
- Memilih metode pembayaran
- Upload bukti pembayaran
- Melihat status pesanan melalui kode order

### Admin
- Login ke dashboard admin
- Melihat ringkasan data
- Mengelola kategori menu
- Mengelola data menu
- Mengatur harga, deskripsi, foto, dan status menu
- Melihat data pesanan

### Kasir
- Melihat daftar pesanan masuk
- Mengecek status pembayaran
- Memverifikasi pembayaran
- Menolak pembayaran jika tidak valid
- Mengubah status pembayaran menjadi paid/rejected

### Kitchen / Barista
- Melihat pesanan yang sudah dibayar
- Memproses pesanan
- Mengubah status pesanan:
  - Waiting
  - Processing
  - Ready
  - Completed

---

## Teknologi yang Digunakan

- Laravel
- PHP
- MySQL
- Blade Template
- Bootstrap
- HTML
- CSS
- JavaScript
- XAMPP / phpMyAdmin

---

## Struktur Database

Database yang digunakan bernama:

```sql
ordernbrew
