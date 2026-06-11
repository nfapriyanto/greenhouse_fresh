1. [X] Perbaiki error pada route 'admin/products/:id/edit':
Symfony\Component\Routing\Exception\RouteNotFoundException
Route [admin.products] not defined.
2. [X] Button Next dan Previous pada route '/' gagal reload apakah mungkin karena vite tailwindnya? atau karena apa?
3. [X] Pastikan route 'admin/reports/sales' berfungsi untuk melihat report penjualan berdasarkan tanggal, export excel dan pdf nya.
4. [X] Pada route 'admin/orders' perbaiki agar nama pelanggan muncul, totalnya sesuai, dan statusnya agar bisa diupdate (belum dibayar, sudah dibayar, dikirim, selesai). saat sebelum mengubah status penjualan menjadi "dikirim" buat agar memasukkan nama kurir, dan nomor resi agar tampil pada route 'orders' pada sisi user.
5. [X] Pastikan logic stock berfungsi dengan benar apabila status pesanan "selesai" maka stock akan berkurang.
6. [X] Apabila ada migratioon yang kurang maka tambahkan agar tidak ada error, dan tambahkan seeder anda bisa menggunakan factory agar mempermudahkannya, buat agar data sesuai dengan kenyataan, untuk product anda tidak perlu mengupload gambarnya atau gunakan dummy image.
7. [X] terdapat bug pada route 'storage/payments/:namafile' saat ingin melihat bukti transfer
8. [X] buatkan dokumentasi profesional dan lengkap tentang project ini.
9. [X] buatkan Docker file agar bisa di jalankan di docker gunakan referensi dari project 'dapur-bunda' dan 'pdns'.