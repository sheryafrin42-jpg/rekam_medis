-- 1. Tabel Pasien
CREATE TABLE pasien (
    id_pasien INT AUTO_INCREMENT PRIMARY KEY,
    no_rm VARCHAR(20) NOT NULL,
    nama_pasien VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    tanggal_lahir DATE NOT NULL,
    alamat TEXT NOT NULL
);

-- 2. Tabel Dokter
CREATE TABLE dokter (
    id_dokter INT AUTO_INCREMENT PRIMARY KEY,
    nama_dokter VARCHAR(100) NOT NULL,
    spesialisasi VARCHAR(50) NOT NULL
);

-- 3. Tabel Obat
CREATE TABLE obat (
    id_obat INT AUTO_INCREMENT PRIMARY KEY,
    nama_obat VARCHAR(100) NOT NULL,
    satuan VARCHAR(30) NOT NULL,
    stok INT NOT NULL
);

-- 4. Tabel Rekam Medis (dengan Foreign Key)
CREATE TABLE rekam_medis (
    id_rekam INT AUTO_INCREMENT PRIMARY KEY,
    id_pasien INT NOT NULL,
    id_dokter INT NOT NULL,
    id_obat INT NOT NULL,
    tanggal_periksa DATE NOT NULL,
    keluhan TEXT NOT NULL,
    diagnosa TEXT NOT NULL,
    tindakan TEXT NOT NULL,
    resep VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_pasien) REFERENCES pasien(id_pasien) ON DELETE CASCADE,
    FOREIGN KEY (id_dokter) REFERENCES dokter(id_dokter) ON DELETE CASCADE,
    FOREIGN KEY (id_obat) REFERENCES obat(id_obat) ON DELETE CASCADE
);

-- Data Uji Coba (Dummy Data Awal)
INSERT INTO pasien (no_rm, nama_pasien, jenis_kelamin, tanggal_lahir, alamat) VALUES
('RM-001', 'Ahmad Subagyo', 'L', '1995-04-12', 'Jl. Merdeka No. 10, Tuban'),
('RM-002', 'Siti Rahma', 'P', '1998-08-25', 'Jl. Sunan Kalijaga No. 45, Tuban'),
('RM-003', 'Budi Santoso', 'L', '2001-01-15', 'Jl. Basuki Rahmat No. 12, Tuban');

INSERT INTO dokter (nama_dokter, spesialisasi) VALUES
('dr. Andi Wijaya', 'Dokter Umum'),
('dr. Maya Sari', 'Spesialis Anak');

INSERT INTO obat (nama_obat, satuan, stok) VALUES
('Paracetamol 500mg', 'Tablet', 100),
('Amoxicillin 500mg', 'Kapsul', 50),
('OBH Sirup', 'Botol', 25);