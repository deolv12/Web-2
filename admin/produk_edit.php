<?php
include_once 'top.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../database.php';

// Ambil data produk berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query untuk mengambil data produk
    $query = "SELECT * FROM produk WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $produk = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produk) {
        // Jika produk tidak ditemukan, arahkan ke halaman daftar produk
        header('Location: produk_list.php');
        exit;
    }
} else {
    // Jika ID tidak ditemukan, arahkan ke halaman daftar produk
    header('Location: produk_list.php');
    exit;
}
?>

<!--begin::App Wrapper-->
<div class="app-wrapper">
    <!--begin::Header-->
    <?php include_once 'partials/navbar.php'; ?>
    <!--end::Header-->

    <!--begin::Sidebar-->
    <?php include_once 'partials/sidebar.php'; ?>
    <!--end::Sidebar-->

    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">
                            <i class="bi bi-pencil-square"></i> Edit Produk
                        </h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="produk_list.php">Produk</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content Header-->
        
        <!--begin::App Content-->
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="bi bi-box-seam"></i> Form Edit Produk
                                </h3>
                                <div class="card-tools">
                                    <a href="produk_list.php" class="btn btn-sm btn-warning">
                                         Kembali
                                    </a>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <form action="produk_update.php" method="POST" class="needs-validation" novalidate>
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($produk['id']) ?>">
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="kode" class="form-label">Kode Produk</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
                                                <input type="text" class="form-control" id="kode" name="kode" 
                                                       value="<?= htmlspecialchars($produk['kode']) ?>" required>
                                                <div class="invalid-feedback">
                                                    Harap isi kode produk
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="nama" class="form-label">Nama Produk</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-box"></i></span>
                                                <input type="text" class="form-control" id="nama" name="nama" 
                                                       value="<?= htmlspecialchars($produk['nama']) ?>" required>
                                                <div class="invalid-feedback">
                                                    Harap isi nama produk
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="harga" class="form-label">Harga (Rp)</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" class="form-control" id="harga" name="harga" 
                                                       value="<?= htmlspecialchars($produk['harga']) ?>" required>
                                                <div class="invalid-feedback">
                                                    Harap isi harga produk
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="stok" class="form-label">Stok</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-boxes"></i></span>
                                                <input type="number" class="form-control" id="stok" name="stok" 
                                                       value="<?= htmlspecialchars($produk['stok']) ?>" required>
                                                <div class="invalid-feedback">
                                                    Harap isi stok produk
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="jenis_produk_id" class="form-label">Jenis Produk</label>
                                        <select class="form-select" id="jenis_produk_id" name="jenis_produk_id" required>
                                            <?php
                                            $query = "SELECT * FROM jenis_produk";
                                            $stmt = $pdo->prepare($query);
                                            $stmt->execute();
                                            
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                $selected = ($row['id'] == $produk['jenis_produk_id']) ? 'selected' : '';
                                                echo "<option value='{$row['id']}' $selected>{$row['nama']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap pilih jenis produk
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" 
                                                  rows="3"><?= htmlspecialchars($produk['deskripsi']) ?></textarea>
                                    </div>
                                    
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="reset" class="btn btn-danger me-md-2">
                                            Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            Simpan 
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
    
    <?php include_once 'partials/footer.php'; ?>
</div>
<!--end::App Wrapper-->
