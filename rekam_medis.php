<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $id_pasien       = $_POST['id_pasien'];
    $id_dokter       = $_POST['id_dokter'];
    $id_obat         = $_POST['id_obat'];
    $tanggal_periksa = $_POST['tanggal_periksa'];
    $keluhan         = $_POST['keluhan'];
    $diagnosa        = $_POST['diagnosa'];
    $tindakan        = $_POST['tindakan'];
    $resep           = $_POST['resep'];

    $query = "INSERT INTO rekam_medis (id_pasien, id_dokter, id_obat, tanggal_periksa, keluhan, diagnosa, tindakan, resep) 
              VALUES ('$id_pasien', '$id_dokter', '$id_obat', '$tanggal_periksa', '$keluhan', '$diagnosa', '$tindakan', '$resep')";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: rekam_medis.php");
    } else {
        echo "Gagal menyimpan: " . mysqli_error($koneksi);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM rekam_medis WHERE id_rekam='$id'");
    header("Location: rekam_medis.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis -MEDISYNC</title>
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
                    <li class="nav-item"><a class="nav-link" href="obat.php"><i class="fa-solid fa-pills"></i> Data Obat</a></li>
                    <li class="nav-item"><a class="nav-link active" href="rekam_medis.php"><i class="fa-solid fa-notes-medical"></i> Rekam Medis</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container main-container">
        <div class="mb-4">
            <h4 class="fw-bold m-0 text-dark">Modul Rekam Medis</h4>
            <p class="text-muted small m-0">Input data transaksi medis & riwayat pemeriksaan Pasien</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card-custom">
                    <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-stethoscope me-2" style="color:#0d9488;"></i>Form Input Medis</h6>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label small fw-medium text-secondary">Pilih Pasien</label>
                            <select name="id_pasien" class="form-select" required>
                                <option value="">-- Pilih Pasien --</option>
                                <?php
                                $pasien = mysqli_query($koneksi, "SELECT * FROM pasien");
                                while ($p = mysqli_fetch_assoc($pasien)) {
                                    echo "<option value='".$p['id_pasien']."'>".$p['no_rm']." - ".$p['nama_pasien']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-medium text-secondary">Dokter Pemeriksa</label>
                            <select name="id_dokter" class="form-select" required>
                                <option value="">-- Pilih Dokter --</option>
                                <?php
                                $dokter = mysqli_query($koneksi, "SELECT * FROM dokter");
                                while ($d = mysqli_fetch_assoc($dokter)) {
                                    echo "<option value='".$d['id_dokter']."'>".$d['nama_dokter']." (".$d['spesialisasi'].")</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-medium text-secondary">Obat Diberikan</label>
                            <select name="id_obat" class="form-select" required>
                                <option value="">-- Pilih Obat --</option>
                                <?php
                                $obat = mysqli_query($koneksi, "SELECT * FROM obat");
                                while ($o = mysqli_fetch_assoc($obat)) {
                                    echo "<option value='".$o['id_obat']."'>".$o['nama_obat']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3"><label class="form-label small fw-medium text-secondary">Tanggal Periksa</label><input type="date" name="tanggal_periksa" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label small fw-medium text-secondary">Keluhan</label><textarea name="keluhan" class="form-control" rows="2" placeholder="Keluhan pasien..." required></textarea></div>
                        <div class="mb-3"><label class="form-label small fw-medium text-secondary">Diagnosa</label><textarea name="diagnosa" class="form-control" rows="2" placeholder="Hasil diagnosa..." required></textarea></div>
                        <div class="mb-3"><label class="form-label small fw-medium text-secondary">Tindakan Medis</label><textarea name="tindakan" class="form-control" rows="2" placeholder="Tindakan..." required></textarea></div>
                        <div class="mb-3"><label class="form-label small fw-medium text-secondary">Resep & Dosis</label><input type="text" name="resep" class="form-control" placeholder="Contoh: 3x1 sehari sesudah makan" required></div>
                        <button type="submit" name="simpan" class="btn text-white w-100 py-2.5 rounded-3 fw-semibold small" style="background-color: #0d9488;"><i class="fa-solid fa-save me-1"></i> Simpan Catatan Medis</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card-custom">
                    <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-list-check me-2" style="color:#0d9488;"></i>Riwayat Pemeriksaan (SQL JOIN)</h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="small text-secondary fw-semibold">Tanggal</th>
                                    <th class="small text-secondary fw-semibold">Pasien</th>
                                    <th class="small text-secondary fw-semibold">Dokter</th>
                                    <th class="small text-secondary fw-semibold">Diagnosa</th>
                                    <th class="small text-secondary fw-semibold">Resep</th>
                                    <th class="text-center small text-secondary fw-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT rm.*, p.nama_pasien, p.no_rm, d.nama_dokter, o.nama_obat 
                                        FROM rekam_medis rm
                                        JOIN pasien p ON rm.id_pasien = p.id_pasien
                                        JOIN dokter d ON rm.id_dokter = d.id_dokter
                                        JOIN obat o ON rm.id_obat = o.id_obat
                                        ORDER BY rm.tanggal_periksa DESC";
                                
                                $query = mysqli_query($koneksi, $sql);
                                if (mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                    <td><span class="text-muted small"><?= $row['tanggal_periksa']; ?></span></td>
                                    <td><strong class="text-dark d-block small"><?= $row['nama_pasien']; ?></strong><small class="text-muted" style="font-size: 11px;"><?= $row['no_rm']; ?></small></td>
                                    <td><span class="text-dark small"><?= $row['nama_dokter']; ?></span></td>
                                    <td><strong class="text-danger small d-block"><?= $row['diagnosa']; ?></strong><small class="text-muted" style="font-size: 11px;"><?= $row['keluhan']; ?></small></td>
                                    <td><strong class="text-dark small d-block"><?= $row['nama_obat']; ?></strong><small class="text-muted" style="font-size: 11px;"><?= $row['resep']; ?></small></td>
                                    <td class="text-center">
                                        <a href="edit_rekam_medis.php?id=<?= $row['id_rekam']; ?>" class="btn btn-sm btn-light text-warning border-0 rounded-circle me-1" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="#" class="btn btn-sm btn-light text-danger border-0 rounded-circle" onclick="konfirmasiHapus(event, 'rekam_medis.php?hapus=<?= $row['id_rekam']; ?>', '<?= $row['nama_pasien']; ?>')" title="Hapus"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                </tr>
                                <?php } } else { ?>
                                <tr><td colspan="6" class="text-center text-muted py-4 small">Belum ada catatan rekam medis.</td></tr>
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
    function konfirmasiHapus(event, urlHapus, namaPasien) {
        event.preventDefault();
        Swal.fire({
            title: 'Hapus Rekam Medis?',
            text: 'Apakah Anda yakin ingin menghapus riwayat pemeriksaan atas nama ' + namaPasien + '?',
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