<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM pasien WHERE id_pasien='$id'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $no_rm         = $_POST['no_rm'];
    $nama_pasien   = $_POST['nama_pasien'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat        = $_POST['alamat'];

    mysqli_query($koneksi, "UPDATE pasien SET no_rm='$no_rm', nama_pasien='$nama_pasien', jenis_kelamin='$jenis_kelamin', tanggal_lahir='$tanggal_lahir', alamat='$alamat' WHERE id_pasien='$id'");
    header("Location: pasien.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pasien - Medica Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --main-bg: #f8fafc; --card-border: #e2e8f0; --accent: #0d9488; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--main-bg); color: #334155; }
        .top-navbar { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 14px 0; }
        .navbar-brand { font-weight: 700; color: #ffffff !important; }
        .card-custom { background: #ffffff; border: 1px solid var(--card-border); border-radius: 18px; padding: 24px; max-width: 600px; margin: 40px auto; }
        .form-control, .form-select { border-radius: 8px; border: 1px solid #cbd5e1; padding: 10px 14px; }
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
            <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-user-pen me-2" style="color:#0d9488;"></i>Edit Data Pasien</h5>
            <form method="POST" action="">
                <div class="mb-3"><label class="form-label small fw-medium text-secondary">Nomor RM</label><input type="text" name="no_rm" class="form-control" value="<?= $data['no_rm']; ?>" required></div>
                <div class="mb-3"><label class="form-label small fw-medium text-secondary">Nama Lengkap</label><input type="text" name="nama_pasien" class="form-control" value="<?= $data['nama_pasien']; ?>" required></div>
                <div class="mb-3">
                    <label class="form-label small fw-medium text-secondary">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="L" <?= $data['jenis_kelamin']=='L'?'selected':''; ?>>Laki-laki (L)</option>
                        <option value="P" <?= $data['jenis_kelamin']=='P'?'selected':''; ?>>Perempuan (P)</option>
                    </select>
                </div>
                <div class="mb-3"><label class="form-label small fw-medium text-secondary">Tanggal Lahir</label><input type="date" name="tanggal_lahir" class="form-control" value="<?= $data['tanggal_lahir']; ?>" required></div>
                <div class="mb-3"><label class="form-label small fw-medium text-secondary">Alamat Pasien</label><textarea name="alamat" class="form-control" rows="2" required><?= $data['alamat']; ?></textarea></div>
                <div class="d-flex gap-2">
                    <button type="submit" name="update" class="btn text-white w-100 py-2 rounded-3 fw-semibold small" style="background-color: #0d9488;"><i class="fa-solid fa-save me-1"></i> Update Data</button>
                    <a href="pasien.php" class="btn btn-secondary w-100 py-2 rounded-3 fw-semibold small">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>