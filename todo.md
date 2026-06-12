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
10. [X] Pada saat menambahkan product di route '/cart' muncul output error berikut dan diarahkan ke route 'cart/add/12?quantity=2'
"""
Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
The GET method is not supported for route cart/add/12. Supported methods: POST.
"""
ini berlaku juga pada beranda route '/' jika ingin menambahkan product yang sama tidak terakumulasi atau quantity nya tidak bertambah.
11. [X] Pada route '/orders' tambahkan detail pesanan si customer contoh pada route 'orders/3' tetapi batasi customer hanya bisa melihat detail pesanan customer itu sendiri. 
12. [X] Pada route 'admin/orders' di bagian navigasi bar hilangkan button "+ Tambah Produk" karena tidak sesuai dengan fungsionalitas admin/orders yang seharusnya hanya melihat pesanan yang masuk.
13. [X] Pada route 'admin/dashboard' perbaiki tidak perlu redudansi "Quick Report Penjualan" karena sudah ada pada route 'admin/reports/sales', jadi buatkan statistik saja seperti Total Produk, Total Pesanan, Total Pelanggan, Total Penjualan, Produk Terlaris (top 5), Produk dengan stock menipis (< 5 stock), grafik penjualan, dll.
14. [X] Perbaiki fungsi search bar pencarian product pada customer, search bar pada Daftar Pesanan, Daftar Produk, Daftar Supplier pada sisi admin, 
15. [X] tambahkan payment gateway  jadi nantinya semua pembayaran di lakukan dengan midtrans.
"""
# Midtrans Configuration
MIDTRANS_ID_MERCHANT=**********
MIDTRANS_CLIENT_KEY=Mid-client-**********
MIDTRANS_SERVER_KEY=Mid-server-**********
"""
16. [X] ubah logic pada route 'admin/orders' jadi statusnya ("Pending", "Processing", "Ready to Ship", "Shipped") jadi setelah customer selesai membayar status otomatis berubah menjadi "Processing".
17. [X] Pada route '/checkout' hilangkan opsi "Metode Pengiriman", "Metode Pembayaran". untuk metode pembayaran tidak perlu memilih lagi karena otomatis menggunakan midtrans.
18. [X] Pada route '/admin/orders' pada status "Shipped" hilangkan logic untuk memasukkan "Nama Kurir" dan "Nomor Resi" dan pada route "/orders" hilangkan "Informasi Pengiriman" karena sudah tidak memakai Metode Pengiriman, dan juga Metode Pembayaran pada route 'orders/:id' pastikan sesuai dengan metode yang digunakan customer pada midtrans.
19. [X] Pada route 'orders' tambahkan fitur untuk membatalkan pesanan dengan kondisi status pesanan masih "Pending" atau belum dibayar.
20. [X] Pada route 'admin/orders' tambahkan filter pesanan dari statusnya.
21. [X] Pada route 'admin/dashboard' ada statistik yang menampilkan Total Pelanggan bisakah itu nanti di klik dan menampilkan daftar pelanggan dan bisa melihat history pembelian dari pelanggan itu?
22. [X] Pada route 'orders' tambahkan fitur untuk edit pesanana dengan kondisi status pesanan masih "Pending" atau belum dibayar. dan ratakan button dengan Detail Pesanan, Batalkan Pesanan.
23. [X] Pada route 'admin/suppliers' terdapat error berikut:
"""
Symfony\Component\Routing\Exception\RouteNotFoundException
Route [admin.suppliers.edit] not defined.
"""
buat agar supplier ini isinya dapat melihat si supplier itu menyuplai product apa dari table products, nah 1 suplier ini bisa menyuplai banyak product.
24. [X] Perbaiki bug pada route 'admin/orders' role admin ingin melihat detail pesanan tetapi malah mengalihkan ke route 'orders/5' yang dimana ini sisi client jadi jika user (si admin) ini tidak login sebagai customer maka di arahkan ke login.