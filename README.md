````md
<div align="center">

<img src="docs/logo.png" alt="OrderNBrew Logo" width="180"/>

# ☕ OrderNBrew

### Smart Cafe Ordering & Payment System

<p>
  <img src="https://img.shields.io/badge/Laravel-Framework-red?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/MySQL-Database-blue?style=for-the-badge&logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-UI-purple?style=for-the-badge&logo=bootstrap" alt="Bootstrap">
  <img src="https://img.shields.io/badge/Status-Development-yellow?style=for-the-badge" alt="Status">
</p>

**OrderNBrew** adalah aplikasi web pemesanan dan pembayaran cafe berbasis **Laravel** dan **MySQL** yang dirancang untuk membantu proses pemesanan, pembayaran, dan pengelolaan pesanan cafe secara digital.

</div>

---

## 🌐 Live Demo

Project dapat diakses melalui link berikut:

🔗 **Live Website:** [https://zaru30.42web.io/](https://zaru30.42web.io/)

---

## 📌 Overview

OrderNBrew dibuat untuk mempermudah pelanggan cafe dalam melakukan pemesanan tanpa harus memesan secara manual ke kasir. Pelanggan dapat melihat menu, memilih pesanan, memasukkan pesanan ke keranjang, melakukan checkout, memilih metode pembayaran, dan melihat status pesanan secara online.

Di sisi pengelola cafe, sistem ini membantu admin, kasir, dan kitchen/barista dalam mengelola operasional pesanan secara lebih terstruktur.

---

## ✨ Features

### 👤 Customer

- Melihat daftar menu cafe
- Melihat kategori menu
- Menambahkan menu ke keranjang
- Mengatur jumlah pesanan
- Melakukan checkout
- Mengisi nama pelanggan dan nomor meja
- Memilih metode pembayaran
- Upload bukti pembayaran
- Melihat status pesanan melalui kode order

### 🛠 Admin

- Login ke dashboard admin
- Melihat ringkasan data sistem
- Mengelola kategori menu
- Mengelola data menu cafe
- Mengatur nama menu, harga, deskripsi, foto, dan status menu
- Melihat data pesanan

### 💳 Cashier

- Login ke dashboard kasir
- Melihat daftar pesanan masuk
- Mengecek status pembayaran
- Memverifikasi pembayaran
- Menyetujui atau menolak pembayaran
- Mengubah status pembayaran menjadi `paid` atau `rejected`

### 👨‍🍳 Kitchen / Barista

- Login ke dashboard kitchen
- Melihat pesanan yang sudah dibayar
- Memproses pesanan
- Mengubah status pesanan:
  - Waiting
  - Processing
  - Ready
  - Completed

---

## 🧰 Tech Stack

| Technology | Description |
|---|---|
| **Laravel** | Backend framework |
| **PHP** | Server-side programming language |
| **MySQL** | Database |
| **Blade** | Laravel templating engine |
| **Bootstrap** | Frontend UI framework |
| **HTML** | Struktur tampilan halaman |
| **CSS** | Styling halaman |
| **JavaScript** | Interaksi halaman |
| **XAMPP** | Local development server |
| **InfinityFree** | Free hosting deployment |

---

## 🗂 Database Structure

Database yang digunakan:

```sql
ordernbrew
````

### Main Tables

| Table           | Function                                      |
| --------------- | --------------------------------------------- |
| `users`         | Menyimpan data user admin, kasir, dan kitchen |
| `categories`    | Menyimpan kategori menu                       |
| `menus`         | Menyimpan data menu cafe                      |
| `cafe_tables`   | Menyimpan data meja cafe                      |
| `orders`        | Menyimpan data pesanan utama                  |
| `order_details` | Menyimpan detail item pesanan                 |
| `payments`      | Menyimpan data pembayaran                     |

---

## 🔄 System Workflow

### Customer Flow

1. Customer membuka website OrderNBrew
2. Customer melihat daftar menu
3. Customer memilih menu yang ingin dipesan
4. Menu masuk ke cart
5. Customer melakukan checkout
6. Customer mengisi nama dan nomor meja
7. Sistem membuat kode order
8. Customer memilih metode pembayaran
9. Customer upload bukti pembayaran
10. Kasir memverifikasi pembayaran
11. Pesanan diteruskan ke kitchen/barista
12. Customer dapat melihat status pesanan

### Cashier Flow

1. Kasir login ke dashboard
2. Kasir melihat daftar pesanan
3. Kasir memeriksa bukti pembayaran
4. Kasir menyetujui atau menolak pembayaran
5. Jika pembayaran disetujui, status pembayaran berubah menjadi `paid`
6. Pesanan dapat diproses oleh kitchen/barista

### Kitchen Flow

1. Kitchen login ke dashboard
2. Kitchen melihat pesanan yang sudah dibayar
3. Kitchen memproses pesanan
4. Kitchen mengubah status pesanan
5. Pesanan selesai dan siap diberikan ke customer

---

## 📍 Main Routes

| Page              | Route                |
| ----------------- | -------------------- |
| Home              | `/`                  |
| Menu              | `/menu`              |
| Cart              | `/cart`              |
| Checkout          | `/checkout`          |
| Tracking Order    | `/tracking`          |
| Login             | `/login`             |
| Admin Dashboard   | `/admin/dashboard`   |
| Cashier Dashboard | `/cashier/dashboard` |
| Kitchen Dashboard | `/kitchen/dashboard` |

---

## 🔐 User Role

Sistem OrderNBrew menggunakan beberapa role pengguna:

| Role       | Access                                                     |
| ---------- | ---------------------------------------------------------- |
| `admin`    | Mengelola data menu, kategori, dan melihat dashboard admin |
| `cashier`  | Melihat dan memverifikasi pembayaran                       |
| `kitchen`  | Melihat dan memproses pesanan                              |
| `customer` | Melakukan pemesanan melalui website                        |

---

## 📊 Payment Status

| Status     | Description                          |
| ---------- | ------------------------------------ |
| `unpaid`   | Pesanan belum dibayar                |
| `pending`  | Pembayaran menunggu verifikasi kasir |
| `paid`     | Pembayaran berhasil diverifikasi     |
| `rejected` | Pembayaran ditolak                   |

---

## 📦 Order Status

| Status            | Description                         |
| ----------------- | ----------------------------------- |
| `waiting_payment` | Menunggu pembayaran                 |
| `waiting`         | Menunggu diproses                   |
| `processing`      | Pesanan sedang dibuat               |
| `ready`           | Pesanan siap diantar atau disajikan |
| `completed`       | Pesanan selesai                     |
| `cancelled`       | Pesanan dibatalkan                  |

---

## 🍽 Sample Menu

| Menu                | Category    | Price    |
| ------------------- | ----------- | -------- |
| Americano           | Coffee      | Rp18.000 |
| Cappuccino          | Coffee      | Rp25.000 |
| Iced Latte          | Coffee      | Rp24.000 |
| Matcha Latte        | Non-Coffee  | Rp28.000 |
| French Fries        | Snack       | Rp18.000 |
| Chicken Wings       | Snack       | Rp30.000 |
| Nasi Goreng Special | Main Course | Rp32.000 |
| Cheesecake          | Dessert     | Rp27.000 |

---

## 🚀 Installation Guide

### 1. Clone Repository

```bash
git clone https://github.com/username/ordernbrew.git
cd ordernbrew
```

### 2. Install Dependencies

```bash
composer install
```

Jika menggunakan frontend asset:

```bash
npm install
npm run build
```

### 3. Copy Environment File

Untuk Linux / MacOS:

```bash
cp .env.example .env
```

Untuk Windows PowerShell:

```bash
copy .env.example .env
```

### 4. Generate App Key

```bash
php artisan key:generate
```

### 5. Setup Database

Buka file `.env`, lalu sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ordernbrew
DB_USERNAME=root
DB_PASSWORD=
```

Pastikan database `ordernbrew` sudah dibuat di phpMyAdmin.

### 6. Run Migration

```bash
php artisan migrate
```

### 7. Start Development Server

```bash
php artisan serve
```

Buka website di browser:

```text
http://127.0.0.1:8000
```

---

## 📁 Project Structure

```bash
ordernbrew/
│── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   └── Models/
│
│── bootstrap/
│
│── config/
│
│── database/
│   └── migrations/
│
│── public/
│   ├── css/
│   ├── js/
│   └── build/
│
│── resources/
│   └── views/
│       ├── admin/
│       ├── auth/
│       ├── cashier/
│       ├── customer/
│       ├── kitchen/
│       └── layouts/
│
│── routes/
│   └── web.php
│
│── storage/
│
│── vendor/
│
│── docs/
│   └── logo.png
│
│── artisan
│── composer.json
│── composer.lock
│── package.json
│── README.md
└── .env.example
```

---

```

---

## 🌟 Advantages

* Sistem pemesanan cafe berbasis web
* Mendukung multi-role user
* Memiliki fitur order dan pembayaran
* Menggunakan database MySQL
* Cocok untuk project kuliah dan portfolio
* Memiliki alur customer, kasir, admin, dan kitchen
* Dapat dikembangkan menjadi sistem cafe yang lebih lengkap

---

## 🛣 Roadmap

Fitur yang dapat dikembangkan ke depannya:

* [ ] QR Code menu per meja
* [ ] Invoice digital / PDF
* [ ] Export laporan penjualan
* [ ] Grafik penjualan harian dan bulanan
* [ ] Notifikasi pesanan real-time
* [ ] Integrasi payment gateway
* [ ] Sistem diskon dan voucher
* [ ] Review dan rating menu
* [ ] Riwayat pesanan customer

---

## ⚠️ Deployment Note

Project ini menggunakan **Laravel + MySQL**, sehingga tidak dapat dijalankan secara penuh di GitHub Pages karena GitHub Pages hanya mendukung static website seperti HTML, CSS, dan JavaScript.

Project ini dideploy menggunakan hosting yang mendukung:

* PHP
* MySQL
* Laravel
* File `.env`
* Folder `vendor`
* Rewrite `.htaccess`
* Document root ke folder `public`

Live deployment:

🔗 https://zaru30.42web.io/

---

## 👨‍💻 Author

**Addinul Haq**

* GitHub: https://github.com/Zaru96

---

## 📄 License

Project ini dibuat untuk kebutuhan pembelajaran, eksperimen, dan pengembangan project web.

---

<div align="center">

### ☕ Order faster, brew better.

</div>
```
