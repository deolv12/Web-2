<?php
require_once '../config/Connection.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Cek apakah ID ada di database
    $cek = mysqli_query($koneksi, "SELECT * FROM kartu_diskon WHERE id = $id");
    if (mysqli_num_rows($cek) > 0) {
        $hapus = mysqli_query($koneksi, "DELETE FROM kartu_diskon WHERE id = $id");

        if ($hapus) {
            header('Location: diskon_list.php?status=hapus');
            exit;
        } else {
            header('Location: diskon_list.php?status=gagal&error=' . urlencode(mysqli_error($koneksi)));
            exit;
        }
    } else {
        // ID tidak ditemukan
        header('Location: diskon_list.php?status=gagal&error=Diskon tidak ditemukan');
        exit;
    }
} else {
    header('Location: diskon_list.php?status=gagal&error=ID tidak ditemukan');
    exit;
}
?>
