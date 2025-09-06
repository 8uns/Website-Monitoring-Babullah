# 🛫 Simpelbabullah  
**Sistem Informasi Laporan Pendapatan & E-Billing Bandar Udara Babullah**

---

## 📖 Deskripsi Sistem  
**Simpelbabullah** adalah aplikasi berbasis web yang digunakan oleh pihak Bandar Udara Babullah untuk **memantau pendapatan tenant** serta **mengelola proses penagihan (e-billing)** secara terpusat, transparan, dan efisien.  

Sistem ini membantu bandara dalam mengurangi proses manual, mempercepat distribusi tagihan, serta memastikan data pendapatan tenant tercatat dengan akurat dan dapat diakses kapan saja. Selain itu, Simpelbabullah juga terintegrasi dengan aplikasi kasir berbasis Android yang digunakan langsung oleh tenant.

---

## ✨ Fitur Utama  

### 🔹 Halaman Tenant  
- Manajemen data tenant / penyewa / kantin  
- Monitoring pendapatan harian, bulanan, dan tahunan  
- Akses cepat terhadap informasi tenant  

### 🔹 Halaman Tagihan & Billing  
- Penerbitan tagihan tenant (konsesi, listrik, sewa lapak)  
- Melihat dan mengunduh bukti pembayaran  
- Validasi pembayaran oleh pihak bandara  

### 🔹 Halaman Akun Tenant  
- Manajemen akun login untuk setiap tenant  
- Akun digunakan pada aplikasi kasir versi Android  
- Kontrol akses sesuai tenant terkait  

### 🔹 Halaman Profil & Pengaturan  
- Manajemen akun admin  
- Pengaturan profil sistem  

### 🔹 API untuk Aplikasi Kasir Android (Tenant)  
Sistem menyediakan REST API (JSON) agar tenant dapat terhubung melalui aplikasi kasir Android.  

Fitur API meliputi:  
- **Produk** → manajemen daftar produk tenant  
- **Inventaris** → pencatatan dan pengelolaan stok barang  
- **Transaksi** → pencatatan transaksi penjualan  
- **Item** → detail item dalam transaksi  
- **Billing** → akses informasi tagihan tenant (konsesi, listrik, sewa lapak)  
- **Pendapatan** → laporan pendapatan harian, bulanan, dan tahunan  


## 🛠 Teknologi yang Digunakan  
- **Backend**: PHP (tanpa framework, menerapkan konsep MVP)  
- **Frontend**: Bootstrap v5.0.2  + sedikit JavaScript untuk interaksi  
- **Database**: MySQL  
- **Tools**: XAMPP / LAMP / WAMP  

## 📞 Kontak
Pengembang: Rafli J Kasim  
Email: jkasim840@gmail.com  


✍️ Dibuat untuk mendukung transformasi digital pengelolaan keuangan di **Bandar Udara Babullah**.
