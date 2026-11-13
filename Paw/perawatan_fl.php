<?php

// Panggil koneksi ke database
include 'connection.php';

// 1. CREATE data Logic
if (isset($_POST['simpan_data'])) {

    // Tangkap data dari form
    $nomor_seri = $_POST['nomor_seri'];
    $tanggal_perawatan = $_POST['tanggal_perawatan'];

    // Siapkan query
    $query = "INSERT INTO perawatan_armada (nomor_seri, tanggal_perawatan) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $nomor_seri, $tanggal_perawatan);

    // Eksekusi dan cek hasil
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Data perawatan berhasil disimpan!');
                window.location.href = 'perawatan_fl.php'; // Refresh halaman
              </script>";
    } else {
        echo "<script>alert('Gagal menyimpan data!');</script>";
    }
}

// 2. UPDATE data Logic
if (isset($_POST['update_data'])) {
    $id = $_POST['id'];
    $nomor_seri = $_POST['nomor_seri'];
    $tanggal_perawatan = $_POST['tanggal_perawatan'];

    $query = "UPDATE Perawatan_armada SET nomor_seri = ?, tanggal_perawatan = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $nomor_seri, $tanggal_perawatan, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Data perawatan berhasil diperbarui!');
                window.location.href = 'perawatan_fl.php';
              </script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}

// 3. DELETE data Logic
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $query = "DELETE FROM perawatan_armada WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Data perawatan berhasil dihapus!');
                window.location.href = 'perawatan_fl.php';
              </script>";
    } else {
        echo "<script>alert('Gagal menghapus data!');</script>";
    }
}

// (READ nya ini) Tangkap kata kunci pencarian dari URL (jika ada) 
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Armada - Forklift</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body>
    <main class="container my-5">
        <!-- Header & Tombol Utama -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Jadwal Perawatan Forklift</h2>
                <p class="text-muted mb-0">Daftar riwayat dan rencana perawatan armada forklift.</p>
            </div>
            <div>
                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalPerawatan">
                    + Input Perawatan
                </button>
                <a href="index.php" class="btn btn-outline-secondary">Kembali ke Menu</a>
            </div>
        </div>

        <!-- FITUR PENCARIAN -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="perawatan_fl.php" method="GET" class="row g-2 align-items-center">
                    <div class="col-md-9 col-sm-8">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari berdasarkan nomor seri armada (contoh: FK-1)..." value="<?= htmlspecialchars($keyword); ?>">
                    </div>
                    <div class="col-md-3 col-sm-4 d-flex gap-2">
                        <button type="submit" class="btn btn-success w-100">Cari</button>
                        <?php if (!empty($keyword)): ?>
                            <a href="perawatan_fl.php" class="btn btn-outline-danger">Reset</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- TABEL MENAMPILKAN DATA DATABASE (READ + SEARCH) -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center" style="width: 70px;">No</th>
                                <th>Nomor Seri / Armada</th>
                                <th>Tanggal Perawatan</th>
                                <th class="text-center" style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;

                            // Logika Query dengan Pencarian
                            if (!empty($keyword)) {
                                $search_param = "%" . $keyword . "%";
                                $query_search = "SELECT * FROM perawatan_armada WHERE nomor_seri LIKE ? ORDER BY tanggal_perawatan DESC";
                                $stmt_search = mysqli_prepare($conn, $query_search);
                                mysqli_stmt_bind_param($stmt_search, "s", $search_param);
                                mysqli_stmt_execute($stmt_search);
                                $result = mysqli_stmt_get_result($stmt_search);
                            } else {
                                $result = mysqli_query($conn, "SELECT * FROM perawatan_armada ORDER BY tanggal_perawatan DESC");
                            }

                            if (mysqli_num_rows($result) > 0):
                                while ($row = mysqli_fetch_assoc($result)):
                            ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td>
                                            <span class="fw-bold"><?= strtoupper(htmlspecialchars($row['nomor_seri'])); ?></span>
                                        </td>
                                        <td><?= date('d M Y', strtotime($row['tanggal_perawatan'])); ?></td>
                                        <td class="text-center">
                                            <!-- Tombol Pemicu Modal Edit -->
                                            <button type="button" class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id']; ?>">
                                                Edit
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <a href="perawatan_fl.php?hapus=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal perawatan ini?')">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- MODAL EDIT (UPDATE) -->
                                    <div class="modal fade" id="modalEdit<?= $row['id']; ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Perawatan Armada</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="" method="POST">
                                                    <div class="modal-body">
                                                        <!-- ID Tersembunyi -->
                                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">

                                                        <div class="mb-3 text-start">
                                                            <label class="form-label fw-bold">Pilih Armada (Forklift)</label>
                                                            <select class="form-select" name="nomor_seri" required>
                                                                <option value="fk_1" <?= $row['nomor_seri'] == 'fk_1' ? 'selected' : ''; ?>>FK-1</option>
                                                                <option value="fk_2" <?= $row['nomor_seri'] == 'fk_2' ? 'selected' : ''; ?>>FK-2</option>
                                                                <option value="fk_3" <?= $row['nomor_seri'] == 'fk_3' ? 'selected' : ''; ?>>FK-3</option>
                                                                <option value="fk_4" <?= $row['nomor_seri'] == 'fk_4' ? 'selected' : ''; ?>>FK-4</option>
                                                                <option value="fk_5" <?= $row['nomor_seri'] == 'fk_5' ? 'selected' : ''; ?>>FK-5</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3 text-start">
                                                            <label class="form-label fw-bold">Tanggal Perawatan</label>
                                                            <input type="date" class="form-control" name="tanggal_perawatan" value="<?= $row['tanggal_perawatan']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" name="update_data" class="btn btn-success">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endwhile;
                            else:
                                ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <?= !empty($keyword) ? 'Tidak ada data perawatan yang sesuai dengan kata kunci "' . htmlspecialchars($keyword) . '".' : 'Belum ada data perawatan yang dijadwalkan.'; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- MODAL TAMBAH DATA (CREATE) -->
    <div class="modal fade" id="modalPerawatan" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Form Perawatan Armada Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="mb-3 text-start">
                            <label for="nomor_seri" class="form-label fw-bold">Pilih Armada (Forklift)</label>
                            <select class="form-select" name="nomor_seri" required>
                                <option value="" disabled selected>Pilih armada...</option>
                                <option value="fk_1">FK-1</option>
                                <option value="fk_2">FK-2</option>
                                <option value="fk_3">FK-3</option>
                                <option value="fk_4">FK-4</option>
                                <option value="fk_5">FK-5</option>
                            </select>
                        </div>

                        <div class="mb-3 text-start">
                            <label for="tanggal_perawatan" class="form-label fw-bold">Tanggal Perawatan</label>
                            <input type="date" class="form-control" name="tanggal_perawatan" required>
                        </div>

                        <div class="modal-footer px-0 pb-0 border-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="simpan_data" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>