<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM dokter WHERE id_dokter='$id'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $nama_dokter  = $_POST['nama_dokter'];
    $spesialisasi = $_POST['spesialisasi'];

    mysqli_query($koneksi, "UPDATE dokter SET nama_dokter='$nama_dokter', spesialisasi='$spesialisasi' WHERE id_dokter='$id'");
    header("Location: dokter.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dokter - Medica Center</title>
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
            <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-user-pen me-2" style="color:#0d9488;"></i>Edit Data Dokter</h5>
            <form method="POST" action="">
                <div class="mb-3"><label class="form-label small fw-medium text-secondary">Nama Dokter (Lengkap)</label><input type="text" name="nama_dokter" class="form-control" value="<?= $data['nama_dokter']; ?>" required></div>
                <div class="mb-3">
                    <label class="form-label small fw-medium text-secondary">Spesialisasi Bidang</label>
                    <select name="spesialisasi" class="form-select" required>
                        <option value="Dokter Umum" <?= $data['spesialisasi']=='Dokter Umum'?'selected':''; ?>>Dokter Umum</option>
                        <option value="Spesialis Anak (Sp.A)" <?= $data['spesialisasi']=='Spesialis Anak (Sp.A)'?'selected':''; ?>>Spesialis Anak (Sp.A)</option>
                        <option value="Spesialis Penyakit Dalam (Sp.PD)" <?= $data['spesialisasi']=='Spesialis Penyakit Dalam (Sp.PD)'?'selected':''; ?>>Spesialis Penyakit Dalam (Sp.PD)</option>
                        <option value="Spesialis Kebidanan & Kandungan (Sp.OG)" <?= $data['spesialisasi']=='Spesialis Kebidanan & Kandungan (Sp.OG)'?'selected':''; ?>>Spesialis Kebidanan & Kandungan (Sp.OG)</option>
                        <option value="Spesialis Bedah (Sp.B)" <?= $data['spesialisasi']=='Spesialis Bedah (Sp.B)'?'selected':''; ?>>Spesialis Bedah (Sp.B)</option>
                        <option value="Spesialis Jantung & Pembuluh Darah (Sp.JP)" <?= $data['spesialisasi']=='Spesialis Jantung & Pembuluh Darah (Sp.JP)'?'selected':''; ?>>Spesialis Jantung & Pembuluh Darah (Sp.JP)</option>
                        <option value="Spesialis Saraf / Neurologi (Sp.N)" <?= $data['spesialisasi']=='Spesialis Saraf / Neurologi (Sp.N)'?'selected':''; ?>>Spesialis Saraf / Neurologi (Sp.N)</option>
                        <option value="Spesialis Mata (Sp.M)" <?= $data['spesialisasi']=='Spesialis Mata (Sp.M)'?'selected':''; ?>>Spesialis Mata (Sp.M)</option>
                        <option value="Spesialis THT-KL" <?= $data['spesialisasi']=='Spesialis THT-KL'?'selected':''; ?>>Spesialis THT-KL</option>
                        <option value="Spesialis Kulit & Kelamin (Sp.DV)" <?= $data['spesialisasi']=='Spesialis Kulit & Kelamin (Sp.DV)'?'selected':''; ?>>Spesialis Kulit & Kelamin (Sp.DV)</option>
                        <option value="Spesialis Paru (Sp.P)" <?= $data['spesialisasi']=='Spesialis Paru (Sp.P)'?'selected':''; ?>>Spesialis Paru (Sp.P)</option>
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" name="update" class="btn text-white w-100 py-2 rounded-3 fw-semibold small" style="background-color: #0d9488;"><i class="fa-solid fa-save me-1"></i> Update Data</button>
                    <a href="dokter.php" class="btn btn-secondary w-100 py-2 rounded-3 fw-semibold small">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>