<?php
// Include koneksi dan model
include_once '../config/Connection.php';

// Mengambil koneksi database
$conn = require_once '../config/Connection.php';

// Tambah pesanan
if (isset($_POST['tambah_pesanan'])) {
    $anggota_id = $_POST['anggota_id'];
    $produk_id = $_POST['produk_id'];
    $jumlah = $_POST['jumlah'];
    $tanggal_pesanan = date('Y-m-d H:i:s');
    
    // Cek apakah stok produk cukup
    $stmt = $conn->prepare("SELECT stok FROM produk WHERE id = :produk_id");
    $stmt->bindParam(':produk_id', $produk_id, PDO::PARAM_INT);
    $stmt->execute();
    $produk = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($produk && $produk['stok'] >= $jumlah) {
        // Insert pesanan baru
        $stmt = $conn->prepare("INSERT INTO pesanan (anggota_id, produk_id, jumlah, tanggal_pesanan) VALUES (?, ?, ?, ?)");
        $stmt->execute([$anggota_id, $produk_id, $jumlah, $tanggal_pesanan]);
        
        // Update stok produk setelah pesanan
        $stmt = $conn->prepare("UPDATE produk SET stok = stok - ? WHERE id = ?");
        $stmt->execute([$jumlah, $produk_id]);
        
        header("Location: pesanan.php");
        exit;
    } else {
        echo "<script>alert('Stok produk tidak cukup atau produk tidak ditemukan.');</script>";
    }
}

// Hapus pesanan
if (isset($_POST['hapus_pesanan'])) {
    $id = $_POST['hapus_pesanan'];
    $stmt = $conn->prepare("DELETE FROM pesanan WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: pesanan.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Pesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h2>Manajemen Pesanan</h2>

    <!-- Form tambah pesanan -->
    <form method="POST" class="row g-3 mb-4">
        <div class="col-md-3">
            <label class="form-label">ID Anggota</label>
            <input type="number" name="anggota_id" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">ID Produk</label>
            <input type="number" name="produk_id" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>
        <div class="col-md-2 align-self-end">
            <button class="btn btn-primary" name="tambah_pesanan">Tambah Pesanan</button>
        </div>
    </form>

    <!-- Daftar pesanan -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Anggota</th>
                <th>ID Produk</th>
                <th>Jumlah</th>
                <th>Tanggal Pesanan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $conn->query("SELECT * FROM pesanan");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['anggota_id']}</td>
                    <td>{$row['produk_id']}</td>
                    <td>{$row['jumlah']}</td>
                    <td>{$row['tanggal_pesanan']}</td>
                    <td>
                        <form method='POST' onsubmit='return confirm(\"Hapus pesanan ini?\")' class='d-inline'>
                            <input type='hidden' name='hapus_pesanan' value='{$row['id']}'>
                            <button class='btn btn-danger btn-sm'>Hapus</button>
                        </form>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
