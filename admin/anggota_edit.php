<?php
include_once 'top.php';


require_once __DIR__ . '/../database.php'; // Pastikan path ke database.php benar

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query dengan PDO
    $query = "SELECT a.*, p.nip, p.nama as nama_pegawai 
              FROM anggota a
              JOIN pegawai p ON a.pegawai_id = p.id
              WHERE a.id = :id";

    // Menyiapkan statement
    $stmt = $pdo->prepare($query);
    // Mengikat parameter
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    // Menjalankan query
    $stmt->execute();

    // Mengambil hasilnya
    $anggota = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!--begin::App Wrapper-->
<div class="app-wrapper">
    <!--begin::Header-->
    <?php include_once 'navbar.php'; ?>
    <!--end::Header-->

    <!--begin::Sidebar-->
    <?php include_once 'sidebar.php'; ?>
    <!--end::Sidebar-->

    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Edit Anggota</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="produk_list.php">Daftar Anggota</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--begin::App Content-->
        <div class="app-content">
            <div class="col-md-12">
                <!--begin::Quick Example-->
                <div class="card card-warning card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">Edit Anggota</div>
                    </div>
                    <div class="card-body">
                        <form action="anggota_update.php" method="POST">
                            <input type="hidden" name="id" value="<?= $anggota['id'] ?>">

                            <div class="mb-3">
                                <label class="form-label">Pegawai</label>
                                <input type="text" class="form-control" value="<?= $anggota['nip'] ?> - <?= $anggota['nama_pegawai'] ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kartu Diskon</label>
                                <select class="form-select" name="kartu_diskon_id">
                                    <option value="">Tidak ada diskon</option>
                                    <?php
                                    // Mengambil data kartu diskon menggunakan PDO
                                    $query = "SELECT * FROM kartu_diskon";
                                    $stmt = $pdo->prepare($query);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    foreach ($result as $row) {
                                        $selected = $row['id'] == $anggota['kartu_diskon_id'] ? 'selected' : '';
                                        echo "<option value='{$row['id']}' $selected>{$row['nama']} ({$row['persen_diskon']}%)</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status Keanggotaan</label>
                                <select class="form-select" name="status_aktif" required>
                                    <option value="aktif" <?= $anggota['status_aktif'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="non_aktif" <?= $anggota['status_aktif'] == 'non_aktif' ? 'selected' : '' ?>>Non-Aktif</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="anggota_list.php" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--end::App Main-->
    
    <?php include_once 'footer.php'; ?>

</div>
