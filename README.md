**MEDISYNC (Sistem Informasi Rekam Medis Klinik)** adalah platform manajemen pelayanan kesehatan berbasis web yang dirancang secara khusus untuk mendigitalisasi, mengintegrasikan, dan mengotomatiskan seluruh alur administrasi klinis pada fasilitas kesehatan tingkat pertama, klinik pratama, maupun praktik dokter mandiri.

Pada sistem konvensional yang masih mengandalkan buku register atau kartu berobat fisik, tenaga kesehatan sering menghadapi berbagai kendala krusial—mulai dari lamanya waktu pencarian berkas rekam medis saat pasien kembali berobat, risiko kerusakan atau hilangnya dokumen fisik, duplikasi pencatatan identitas pasien, hingga ketidaksesuaian antara resep yang dikeluarkan dokter dengan ketersediaan stok obat di bagian farmasi. **MEDISYNC** hadir untuk mengatasi seluruh permasalahan tersebut melalui satu ekosistem digital terpusat dengan antarmuka modern yang bersih, responsif, dan ramah pengguna (*user-friendly*).

### Ruang Lingkup & Alur Kerja Sistem

Aplikasi ini dirancang mengikuti alur pelayanan nyata di klinik secara berurutan dan saling terhubung:

1. **Pendaftaran & Pendataan Pasien (Front-Office):**
   Petugas administrasi mencatat identitas lengkap pasien baru (nama, jenis kelamin, tanggal lahir, alamat, dan nomor telepon) ke dalam basis data master. Untuk pasien lama, petugas dapat langsung mencari dan memperbarui informasi pasien tanpa perlu membuat data ganda.
2. **Penjadwalan & Pengelolaan Tenaga Medis:**
   Sistem menyimpan daftar dokter yang bertugas beserta bidang spesialisasi dan informasi kontaknya, sehingga setiap sesi pemeriksaan dapat dipertanggungjawabkan secara jelas kepada dokter yang menangani.
3. **Pemeriksaan Klinis & Pencatatan Rekam Medis:**
   Saat pasien menjalani pemeriksaan, dokter atau petugas medis mencatat tanggal kunjungan, keluhan utama pasien, hasil diagnosa medis, serta tindakan klinis yang diberikan. Seluruh data ini terikat langsung dengan ID Pasien dan ID Dokter terkait.
4. **Integrasi Resep & Manajemen Farmasi:**
   Dalam satu form pemeriksaan yang sama, dokter dapat langsung menentukan resep obat yang dibutuhkan pasien berdasarkan daftar obat yang tersedia di database klinik, sehingga bagian farmasi memiliki acuan yang akurat dan terdokumentasi dengan rapi.
5. **Pemantauan Operasional Real-Time (Dashboard):**
   Halaman utama menyajikan ringkasan metrik operasional klinik secara langsung—mencakup total pasien terdaftar, jumlah dokter aktif, variasi item obat yang tersedia, serta akumulasi riwayat pemeriksaan yang telah dilakukan.

### Keunggulan & Arsitektur Sistem

* **Integritas Data Relasional (Relational Database):** Dibangun di atas struktur basis data MySQL yang telah melalui proses normalisasi. Menggunakan relasi *Primary Key* dan *Foreign Key* antar tabel (`pasien`, `dokter`, `obat`, dan `rekam_medis`) serta implementasi query `INNER JOIN` untuk menampilkan informasi terpadu tanpa redundansi data.
* **Antarmuka Modern & Responsif:** Menggunakan kerangka kerja Bootstrap 5 dengan tipografi *Plus Jakarta Sans* dan ikonografi FontAwesome, memastikan tampilan tetap rapi dan nyaman diakses baik melalui komputer meja (*desktop*) maupun perangkat tablet.
* **Pengalaman Pengguna Interaktif:** Dilengkapi komponen umpan balik visual seperti konfirmasi penghapusan data dan notifikasi status transaksi menggunakan SweetAlert2 untuk meminimalkan kesalahan input (*human error*).
* **Arsitektur Modular yang Ringan:** Dikembangkan menggunakan PHP Native (MySQLi) dengan pemisahan modul halaman (`index`, `pasien`, `dokter`, `obat`, `rekam_medis`) dan file konfigurasi tunggal (`koneksi.php`), sehingga sangat ringan dijalankan di server lokal maupun hosting serta mudah dikembangkan lebih lanjut.
