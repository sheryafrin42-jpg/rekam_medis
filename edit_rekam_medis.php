<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM rekam_medis WHERE id_rekam='$id'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $id_pasien       = $_POST['id_pasien'];
    $id_dokter       = $_POST['id_dokter'];
    $id_obat         = $_POST['id_obat'];
    $tanggal_periksa = $_POST['tanggal_periksa'];
    $keluhan         = $_POST['keluhan'];
    $diagnosa        = $_POST['diagnosa'];
    $tindakan        = $_POST['tindakan'];
    $resep           = $_POST['resep'];

    mysqli_query($koneksi, "UPDATE rekam_medis SET id_pasien='$id_pasien', id_dokter='$id_dokter', id_obat='$id_obat', tanggal_periksa='$tanggal_periksa', keluhan='$keluhan', diagnosa='$diagnosa', tindakan='$tindakan', resep='$resep' WHERE id_rekam='$id'");
    header("Location: rekam_medis.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rekam Medis - Medica Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --main-bg: #f8fafc; --card-border: #e2e8f0; --accent: #0d9488; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--main-bg); color: #334155; }
        .top-navbar { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 14px 0; }
        .navbar-brand { font-weight: 700; color: #ffffff !important; }
        .card-custom { background: #ffffff; border: 1px solid var(--card-border); border-radius: 18px; padding: 24px; max-width: 650px; margin: 40px auto; }
        .form-control, .form-select { border-radius: 8px; border: 1px solid #cbd5e1; padding: 10px 14px; font-size: 0.875rem; }
    </style>
</head>
<body>
    <nav class="top-navbar navbar navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fa-solid fa-hospital-user text-info me-2"></i>Medica Center</a>
        </div>
    </nav>

    <div class="container">
        <div class="card-custom shadow-sm">
            <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-notes-medical me-2" style="color:#0d9488;"></i>Edit Catatan Rekam Medis</h5>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label small fw-medium text-secondary">Pilih Pasien</label>
                    <select name="id_pasien" class="form-select" required>
                        <?php
                        $pasien = mysqli_query($koneksi, "SELECT * FROM pasien");
                        while ($p = mysqli_fetch_assoc($pasien)) {
                            $selected = ($p['id_pasien'] == $data['id_pasien']) ? 'selected' : '';
                            echo "<option value='".$p['id_pasien']."' $selected>".$p['no_rm']." - ".$p['nama_pasien']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-medium text-secondary">Dokter Pemeriksa</label>
                    <select name="id_dokter" class="form-select" required>
                        <?php
                        $dokter = mysqli_query($koneksi, "SELECT * FROM dokter");
                        while ($d = mysqli_fetch_assoc($dokter)) {
                            $selected = ($d['id_dokter'] == $data['id_dokter']) ? 'selected' : '';
                            echo "<option value='".$d['id_dokter']."' $selected>".$d['nama_dokter']." (".$d['spesialisasi'].")</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-medium text-secondary">Obat Diberikan</label>
                    <select name="id_obat" class="form-select" required>
                        <?php
                        $obat = mysqli_query($koneksi, "SELECT * FROM obat");
                        while ($o = mysqli_fetch_assoc($obat)) {
                            $selected = ($o['id_obat'] == $data['id_obat']) ? 'selected' : '';
                            echo "<option value='".$o['id_obat']."' $selected>".$o['nama_obat']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3"><label class="form-label small fw-medium text-secondary">Tanggal Periksa</label><input type="date" name="tanggal_periksa" class="form-control" value="<?= $data['tanggal_periksa']; ?>" required></div>
                <div class="mb-3"><label class="form-label small fw-medium text-secondary">Keluhan</label><textarea name="keluhan" class="form-control" rows="2" required><?= $data['keluhan']; ?></textarea></div>
                <div class="mb-3"><label class="form-label small fw-medium text-secondary">Diagnosa</label><textarea name="diagnosa" class="form-control" rows="2" required><?= $data['diagnosa']; ?></textarea></div>
                <div class="mb-3"><label class="form-label small fw-medium text-secondary">Tindakan Medis</label><textarea name="tindakan" class="form-control" rows="2" required><?= $data['tindakan']; ?></textarea></div>
                <div class="mb-3"><label class="form-label small fw-medium text-secondary">Resep & Dosis</label><input type="text" name="resep" class="form-control" value="<?= $data['resep']; ?>" required></div>
                <div class="d-flex gap-2">
                    <button type="submit" name="update" class="btn text-white w-100 py-2 rounded-3 fw-semibold small" style="background-color: #0d9488;"><i class="fa-solid fa-save me-1"></i> Update Rekam Medis</button>
                    <a href="rekam_medis.php" class="btn btn-secondary w-100 py-2 rounded-3 fw-semibold small">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>