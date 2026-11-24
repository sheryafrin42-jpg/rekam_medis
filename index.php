<?php
include 'koneksi.php';

$jml_pasien = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pasien"))['total'];
$jml_dokter = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM dokter"))['total'];
$jml_obat   = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM obat"))['total'];
$jml_rekam  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM rekam_medis"))['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Executive - MEDICA CENTER</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Font Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root { 
            --main-bg: #f1f5f9; 
            --card-border: #e2e8f0; 
            --accent: #0d9488;
            --accent-hover: #0f766e;
            --dark-slate: #0f172a;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--main-bg); color: #334155; }
        
        /* Top Navigation Navbar */
        .top-navbar { 
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); 
            padding: 14px 0; 
            position: sticky; 
            top: 0; 
            z-index: 1000; 
            box-shadow: 0 4px 25px rgba(15,23,42,0.12); 
        }
        .navbar-brand { font-size: 1.25rem; font-weight: 700; color: #ffffff !important; display: flex; align-items: center; gap: 10px; }
        .navbar-brand i { color: #2dd4bf; }
        .nav-link { color: #94a3b8 !important; font-weight: 500; font-size: 0.925rem; padding: 8px 18px !important; border-radius: 10px; transition: all 0.25s ease; display: flex; align-items: center; gap: 8px; }
        .nav-link:hover { color: #ffffff !important; background: rgba(255, 255, 255, 0.08); }
        .nav-link.active { color: #ffffff !important; background: var(--accent) !important; box-shadow: 0 4px 14px rgba(13, 148, 136, 0.4); }

        .main-container { padding-top: 32px; padding-bottom: 50px; }
        
        /* Hero Welcome Card */
        .hero-banner {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0d9488 100%);
            border-radius: 20px;
            padding: 30px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);
            margin-bottom: 30px;
        }
        .hero-banner::after {
            content: '';
            position: absolute;
            right: -20px;
            bottom: -30px;
            width: 250px;
            height: 250px;
            background: rgba(45, 212, 191, 0.08);
            border-radius: 50%;
            pointer-events: none;
        }

        /* Metric Cards */
        .card-metric {
            background: #ffffff;
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
            transition: all 0.3s ease;
            height: 100%;
        }
        .card-metric:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.06);
            border-color: #cbd5e1;
        }
        .metric-icon-box {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
        }

        /* Standard Section Cards */
        .card-custom {
            background: #ffffff;
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        }

        /* Quick Action Item */
        .quick-action-btn {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            color: #334155;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.25s ease;
        }
        .quick-action-btn:hover {
            background: #ffffff;
            border-color: var(--accent);
            color: var(--accent);
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.12);
            transform: translateX(4px);
        }

        /* Table Styling */
        .table-custom tbody tr { transition: all 0.2s ease; }
        .table-custom tbody tr:hover { background-color: #f8fafc; }
        .avatar-initial {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(13, 148, 136, 0.1);
            color: var(--accent);
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <!-- Header Navigation Atas -->
    <nav class="top-navbar navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fa-solid fa-hospital-user fa-lg"></i>
                <span>MEDISYNC</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-2">
                    <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="pasien.php"><i class="fa-solid fa-users"></i> Data Pasien</a></li>
                    <li class="nav-item"><a class="nav-link" href="dokter.php"><i class="fa-solid fa-user-doctor"></i> Data Dokter</a></li>
                    <li class="nav-item"><a class="nav-link" href="obat.php"><i class="fa-solid fa-pills"></i> Data Obat</a></li>
                    <li class="nav-item"><a class="nav-link" href="rekam_medis.php"><i class="fa-solid fa-notes-medical"></i> Rekam Medis</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container main-container">
        
        <!-- Hero Banner Welcome -->
        <div class="hero-banner d-flex justify-content-between align-items-center">
            <div>
                <span class="badge bg-teal bg-opacity-20 text-teal border border-teal border-opacity-30 px-3 py-1.5 rounded-pill mb-2 small fw-medium" style="background: rgba(45, 212, 191, 0.15); color: #2dd4bf;">
                    <i class="fa-solid fa-shield-halved me-1"></i> Sistem Manajemen Rekam Medis Integratif
                </span>
                <h3 class="fw-bold m-0 mt-1">Selamat Datang di Medica Center</h3>
                <p class="text-white-50 m-0 mt-1 small">Pantau statistik operasional klinik, jumlah tim medis, serta rekam medis pasien secara real-time.</p>
            </div>
            <div class="d-none d-md-block text-end">
                <div class="small text-white-50"><i class="fa-regular fa-calendar me-1"></i> <?= date('d F Y') ?></div>
                <div class="fw-bold mt-1" style="color: #2dd4bf;"><i class="fa-solid fa-circle text-success me-1" style="font-size: 8px;"></i> Status Server: Aktif</div>
            </div>
        </div>

        <!-- Metric Cards Row -->
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card-metric">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted small fw-semibold">TOTAL PASIEN</span>
                        <div class="metric-icon-box" style="background: rgba(13, 148, 136, 0.1); color: #0d9488;">
                            <i class="fa-solid fa-user-injured"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold text-dark m-0"><?= number_format($jml_pasien) ?></h2>
                    <div class="d-flex align-items-center gap-1 mt-2 text-success small fw-medium">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                        <span>Terdaftar dalam sistem</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card-metric">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted small fw-semibold">DOKTER PRAKTIK</span>
                        <div class="metric-icon-box" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold text-dark m-0"><?= number_format($jml_dokter) ?></h2>
                    <div class="d-flex align-items-center gap-1 mt-2 text-primary small fw-medium">
                        <i class="fa-solid fa-stethoscope"></i>
                        <span>Spesialis & Dokter Umum</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card-metric">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted small fw-semibold">KATALOG OBAT</span>
                        <div class="metric-icon-box" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                            <i class="fa-solid fa-pills"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold text-dark m-0"><?= number_format($jml_obat) ?></h2>
                    <div class="d-flex align-items-center gap-1 mt-2 text-warning small fw-medium">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <span>Item obat siap edar</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card-metric">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted small fw-semibold">PEMERIKSAAN</span>
                        <div class="metric-icon-box" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                            <i class="fa-solid fa-file-medical"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold text-dark m-0"><?= number_format($jml_rekam) ?></h2>
                    <div class="d-flex align-items-center gap-1 mt-2 text-danger small fw-medium">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <span>Total transaksi medis</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row Graphic & Quick Action -->
        <div class="row g-4 mb-4">
            <!-- Chart Visualisasi -->
            <div class="col-lg-8">
                <div class="card-custom">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="fw-bold m-0 text-dark">Grafik Aktivitas Pemeriksaan Medis</h6>
                            <p class="text-muted small m-0">Ringkasan estimasi pemeriksaan bulanan tahun berjalan</p>
                        </div>
                        <span class="badge bg-light text-secondary border px-2.5 py-1.5 rounded-pill small">Tahun <?= date('Y') ?></span>
                    </div>
                    <div style="height: 260px;">
                        <canvas id="rekamChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Quick Action Shortcuts -->
            <div class="col-lg-4">
                <div class="card-custom h-100">
                    <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-bolt text-warning me-2"></i>Aksi Cepat Menu</h6>
                    <div class="d-flex flex-column gap-2.5">
                        <a href="pasien.php" class="quick-action-btn">
                            <i class="fa-solid fa-user-plus text-teal" style="color: #0d9488; font-size: 1.1rem;"></i>
                            <span>Tambah Pasien Baru</span>
                        </a>
                        <a href="rekam_medis.php" class="quick-action-btn">
                            <i class="fa-solid fa-notes-medical text-primary" style="font-size: 1.1rem;"></i>
                            <span>Catat Pemeriksaan Medis</span>
                        </a>
                        <a href="dokter.php" class="quick-action-btn">
                            <i class="fa-solid fa-user-md text-success" style="font-size: 1.1rem;"></i>
                            <span>Kelola Data Dokter</span>
                        </a>
                        <a href="obat.php" class="quick-action-btn">
                            <i class="fa-solid fa-capsules text-warning" style="font-size: 1.1rem;"></i>
                            <span>Update Inventaris Obat</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Records Table -->
        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h6 class="fw-bold m-0 text-dark"><i class="fa-solid fa-clock-rotate-left me-2" style="color:#0d9488;"></i>Riwayat Pemeriksaan Terakhir</h6>
                    <p class="text-muted small m-0">5 data transaksi rekam medis terbaru di sistem</p>
                </div>
                <a href="rekam_medis.php" class="btn btn-sm btn-outline-dark rounded-pill px-3 fw-medium">Lihat Semua Data</a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-custom align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="small text-secondary fw-semibold">Tanggal</th>
                            <th class="small text-secondary fw-semibold">Pasien</th>
                            <th class="small text-secondary fw-semibold">Dokter Pemeriksa</th>
                            <th class="small text-secondary fw-semibold">Diagnosa Utama</th>
                            <th class="text-center small text-secondary fw-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT rm.*, p.nama_pasien, p.no_rm, d.nama_dokter 
                                FROM rekam_medis rm
                                JOIN pasien p ON rm.id_pasien = p.id_pasien
                                JOIN dokter d ON rm.id_dokter = d.id_dokter
                                ORDER BY rm.tanggal_periksa DESC LIMIT 5";
                        $query = mysqli_query($koneksi, $sql);
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                                $initial = strtoupper(substr($row['nama_pasien'], 0, 1));
                        ?>
                        <tr>
                            <td><span class="text-muted small fw-medium"><?= date('d/m/Y', strtotime($row['tanggal_periksa'])); ?></span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2.5">
                                    <div class="avatar-initial"><?= $initial ?></div>
                                    <div>
                                        <strong class="text-dark d-block small"><?= $row['nama_pasien']; ?></strong>
                                        <small class="text-muted" style="font-size: 11px;"><?= $row['no_rm']; ?></small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="text-dark small fw-medium"><i class="fa-solid fa-user-doctor me-1 text-muted"></i><?= $row['nama_dokter']; ?></span></td>
                            <td><span class="badge bg-danger bg-opacity-10 text-danger px-2.5 py-1.5 rounded-pill fw-medium"><?= $row['diagnosa']; ?></span></td>
                            <td class="text-center"><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 small">Selesai</span></td>
                        </tr>
                        <?php } } else { ?>
                        <tr><td colspan="5" class="text-center text-muted py-4 small">Belum ada riwayat rekam medis.</td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script Chart.js -->
    <script>
    const ctx = document.getElementById('rekamChart').getContext('2d');
    const rekamChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Jumlah Pemeriksaan',
                data: [12, 19, 15, 25, 22, 30, 28, 35, 40, 38, 45, 50],
                borderColor: '#0d9488',
                backgroundColor: 'rgba(13, 148, 136, 0.08)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: '#0d9488',
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { borderDash: [4, 4], color: '#f1f5f9' },
                    ticks: { font: { family: 'Plus Jakarta Sans', size: 11 } }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Plus Jakarta Sans', size: 11 } }
                }
            }
        }
    });
    </script>
</body>
</html>