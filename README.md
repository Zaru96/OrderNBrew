<div align="center">

# ☕ OrderNBrew

### *Smart Cafe Ordering & Payment System*

<p>
  <img src="https://img.shields.io/badge/Laravel-Framework-red?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/MySQL-Database-blue?style=for-the-badge&logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-UI-purple?style=for-the-badge&logo=bootstrap" alt="Bootstrap">
  <img src="https://img.shields.io/badge/Status-Development-yellow?style=for-the-badge" alt="Status">
</p>

**OrderNBrew** adalah aplikasi web pemesanan dan pembayaran cafe berbasis **Laravel** dan **MySQL**  
yang dirancang untuk membantu proses **order, pembayaran, dan manajemen pesanan cafe** secara digital.

</div>

---

## 📌 Overview

OrderNBrew dibuat untuk mempermudah pelanggan cafe dalam:

- Melihat daftar menu
- Menambahkan menu ke keranjang
- Melakukan checkout
- Memilih metode pembayaran
- Mengirim bukti pembayaran
- Melihat status pesanan

Di sisi pengelola cafe, sistem ini juga membantu:

- **Admin** untuk mengelola kategori dan menu
- **Kasir** untuk memverifikasi pembayaran
- **Kitchen / Barista** untuk memproses pesanan
- **Owner / Admin** untuk melihat data operasional

---

## ✨ Features

### 👤 Customer
- View menu cafe
- Filter menu berdasarkan kategori
- Add to cart
- Checkout pesanan
- Input nama pelanggan & nomor meja
- Pilih metode pembayaran
- Upload bukti pembayaran
- Tracking status pesanan

### 🛠 Admin
- Login dashboard admin
- Kelola kategori menu
- Kelola data menu
- Lihat ringkasan data
- Lihat pesanan

### 💳 Cashier
- Lihat daftar pesanan masuk
- Verifikasi pembayaran
- Approve / reject pembayaran
- Update status pembayaran

### 👨‍🍳 Kitchen / Barista
- Melihat pesanan yang sudah dibayar
- Update status pesanan:
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
| **Blade** | Templating engine Laravel |
| **Bootstrap** | Frontend UI framework |
| **HTML / CSS / JS** | Frontend basic structure |
| **XAMPP** | Local server environment |

---

## 🗂 Database Structure

Database yang digunakan:

```sql
ordernbrew
