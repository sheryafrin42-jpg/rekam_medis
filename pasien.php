<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $no_rm         = $_POST['no_rm'];
    $nama_pasien   = $_POST['nama_pasien'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat        = $_POST['alamat'];

    mysqli_query($koneksi, "INSERT INTO pasien (no_rm, nama_pasien, jenis_kelamin, tanggal_lahir, alamat) 
                            VALUES ('$no_rm', '$nama_pasien', '$jenis_kelamin', '$tanggal_lahir', '$alamat')");
    header("Location: pasien.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM pasien WHERE id_pasien='$id'");
    header("Location: pasien.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pasien -MEDISYNC</title>
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
                    <li class="nav-item"><a class="nav-link active" href="pasien.php"><i class="fa-solid fa-users"></i> Data Pasien</a></li>
                    <li class="nav-item"><a class="nav-link" href="dokter.php"><i class="fa-solid fa-user-doctor"></i> Data Dokter</a></li>
                    <li class="nav-item"><a class="nav-link" href="obat.php"><i class="fa-solid fa-pills"></i> Data Obat</a></li>
                    <li class="nav-item"><a class="nav-link" href="rekam_medis.php"><i class="fa-solid fa-notes-medical"></i> Rekam Medis</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container main-container">
        <div class="mb-4">
            <h4 class="fw-bold m-0 text-dark">Pengelolaan Data Pasien</h4>
            <p class="text-muted small m-0">Tambah dan kelola pendaftaran data master pasien.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card-custom">
                    <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-user-plus me-2" style="color:#0d9488;"></i>Tambah Pasien Baru</h6>
                    <form method="POST" action="">
                        <div class="mb-3"><label class="form-label small fw-medium text-secondary">Nomor RM</label><input type="text" name="no_rm" class="form-control" placeholder="Contoh: RM-004" required></div>
                        <div class="mb-3"><label class="form-label small fw-medium text-secondary">Nama Lengkap</label><input type="text" name="nama_pasien" class="form-control" placeholder="Nama pasien" required></div>
                        <div class="mb-3"><label class="form-label small fw-medium text-secondary">Jenis Kelamin</label><select name="jenis_kelamin" class="form-select" required><option value="L">Laki-laki (L)</option><option value="P">Perempuan (P)</option></select></div>
                        <div class="mb-3"><label class="form-label small fw-medium text-secondary">Tanggal Lahir</label><input type="date" name="tanggal_lahir" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label small fw-medium text-secondary">Alamat Pasien</label><textarea name="alamat" class="form-control" rows="2" placeholder="Alamat rumah..." required></textarea></div>
                        <button type="submit" name="simpan" class="btn text-white w-100 py-2.5 rounded-3 fw-semibold small" style="background-color: #0d9488;"><i class="fa-solid fa-save me-1"></i> Simpan Pasien</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card-custom">
                    <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-users me-2" style="color:#0d9488;"></i>Daftar Master Pasien</h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="small text-secondary fw-semibold">No RM</th>
                                    <th class="small text-secondary fw-semibold">Nama Pasien</th>
                                    <th class="small text-secondary fw-semibold">L/P</th>
                                    <th class="small text-secondary fw-semibold">Tgl Lahir</th>
                                    <th class="small text-secondary fw-semibold">Alamat</th>
                                    <th class="text-center small text-secondary fw-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY id_pasien DESC");
                                while ($row = mysqli_fetch_assoc($data)) {
                                ?>
                                <tr>
                                    <td><span class="badge bg-secondary bg-opacity-10 text-dark fw-medium"><?= $row['no_rm']; ?></span></td>
                                    <td><strong class="text-dark small"><?= $row['nama_pasien']; ?></strong></td>
                                    <td><span class="badge <?= $row['jenis_kelamin']=='L'?'bg-primary':'bg-danger' ?> bg-opacity-10 text-dark small"><?= $row['jenis_kelamin']; ?></span></td>
                                    <td><span class="text-muted small"><?= $row['tanggal_lahir']; ?></span></td>
                                    <td><span class="text-muted small"><?= $row['alamat']; ?></span></td>
                                    <td class="text-center">
                                        <a href="edit_pasien.php?id=<?= $row['id_pasien']; ?>" class="btn btn-sm btn-light text-warning border-0 rounded-circle me-1" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="#" class="btn btn-sm btn-light text-danger border-0 rounded-circle" onclick="konfirmasiHapus(event, 'pasien.php?hapus=<?= $row['id_pasien']; ?>', '<?= $row['nama_pasien']; ?>')" title="Hapus"><i class="fa-solid fa-trash-can"></i></a>
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
            title: 'Hapus Data Pasien?',
            text: 'Apakah Anda yakin ingin menghapus ' + nama + '?',
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