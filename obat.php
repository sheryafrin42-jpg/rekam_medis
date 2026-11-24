<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama_obat = $_POST['nama_obat'];
    $satuan    = $_POST['satuan'];
    $stok      = $_POST['stok'];

    mysqli_query($koneksi, "INSERT INTO obat (nama_obat, satuan, stok) VALUES ('$nama_obat', '$satuan', '$stok')");
    header("Location: obat.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM obat WHERE id_obat='$id'");
    header("Location: obat.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Obat - MEDISYNC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root { --main-bg: #f8fafc; --card-border: #e2e8f0; --accent: #0d9488; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--main-bg); color: #334155; }
        .top-navbar { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 14px 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 20px rgba(15,23,42,0.08); }
        .navbar-brand { font-size: 1.25rem; font-weight: 700; color: #ffffff !important; display: flex; align-items: center; gap: 10px; }
        .navbar-brand i { color: #2dd4bf; }
        .nav-link { color: #94a3b8 !important; font-weight: 500; font-size: 0.925rem; padding: 8px 18px !important; border-radius: 10px; transition: all 0.25s ease; display: flex; align-items: center; gap: 8px; }
        .nav-link:hover { color: #ffffff !important; background: rgba(255, 255, 255, 0.05); }
        .nav-link.active { color: #ffffff !important; background: var(--accent) !important; box-shadow: 0 4px 12px rgba(13, 148, 136, 0.35); }
        .main-container { padding-top: 35px; padding-bottom: 50px; }
        .card-custom { background: #ffffff; border: 1px solid var(--card-border); border-radius: 18px; padding: 24px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
        .form-control, .form-select { border-radius: 8px; border: 1px solid #cbd5e1; padding: 10px 14px; font-size: 0.875rem; }
    </style>
</head>
<body>

    <nav class="top-navbar navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fa-solid fa-hospital-user fa-lg"></i><span>MEDISYNC</span></a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-2">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="pasien.php"><i class="fa-solid fa-users"></i> Data Pasien</a></li>
                    <li class="nav-item"><a class="nav-link" href="dokter.php"><i class="fa-solid fa-user-doctor"></i> Data Dokter</a></li>
                    <li class="nav-item"><a class="nav-link active" href="obat.php"><i class="fa-solid fa-pills"></i> Data Obat</a></li>
                    <li class="nav-item"><a class="nav-link" href="rekam_medis.php"><i class="fa-solid fa-notes-medical"></i> Rekam Medis</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container main-container">
        <div class="mb-4">
            <h4 class="fw-bold m-0 text-dark">Inventaris Data Obat</h4>
            <p class="text-muted small m-0">Tambah & pantau persediaan stok obat klinik.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card-custom">
                    <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-prescription-bottle-medical me-2" style="color:#0d9488;"></i>Tambah Obat Baru</h6>
                    <form method="POST" action="">
                        <div class="mb-3"><label class="form-label small fw-medium text-secondary">Nama Obat</label><input type="text" name="nama_obat" class="form-control" placeholder="Nama obat" required></div>
                        <div class="mb-3"><label class="form-label small fw-medium text-secondary">Satuan Obat</label><input type="text" name="satuan" class="form-control" placeholder="Tablet/Botol/Kapsul" required></div>
                        <div class="mb-3"><label class="form-label small fw-medium text-secondary">Jumlah Stok</label><input type="number" name="stok" class="form-control" placeholder="0" required></div>
                        <button type="submit" name="simpan" class="btn text-white w-100 py-2.5 rounded-3 fw-semibold small" style="background-color: #0d9488;"><i class="fa-solid fa-save me-1"></i> Simpan Obat</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card-custom">
                    <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-pills me-2" style="color:#0d9488;"></i>Daftar Stok Obat</h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="small text-secondary fw-semibold">No</th>
                                    <th class="small text-secondary fw-semibold">Nama Obat</th>
                                    <th class="small text-secondary fw-semibold">Satuan</th>
                                    <th class="small text-secondary fw-semibold">Stok</th>
                                    <th class="text-center small text-secondary fw-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = mysqli_query($koneksi, "SELECT * FROM obat ORDER BY id_obat DESC");
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($data)) {
                                ?>
                                <tr>
                                    <td><span class="text-muted small"><?= $no++; ?></span></td>
                                    <td><strong class="text-dark small"><?= $row['nama_obat']; ?></strong></td>
                                    <td><span class="badge bg-secondary bg-opacity-10 text-dark small"><?= $row['satuan']; ?></span></td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success fw-bold small"><?= $row['stok']; ?></span></td>
                                    <td class="text-center">
                                        <a href="edit_obat.php?id=<?= $row['id_obat']; ?>" class="btn btn-sm btn-light text-warning border-0 rounded-circle me-1" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="#" class="btn btn-sm btn-light text-danger border-0 rounded-circle" onclick="konfirmasiHapus(event, 'obat.php?hapus=<?= $row['id_obat']; ?>', '<?= $row['nama_obat']; ?>')" title="Hapus"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function konfirmasiHapus(event, urlHapus, nama) {
        event.preventDefault();
        Swal.fire({
            title: 'Hapus Data Obat?',
            text: 'Apakah Anda yakin ingin menghapus obat ' + nama + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            customClass: { popup: 'rounded-4' }
        }).then((result) => { if (result.isConfirmed) { window.location.href = urlHapus; } });
    }
    </script>
</body>
</html>