<?php
class JenisProduk {
    private $conn;
    private $table = "jenis_produk";  // Nama tabel dalam database

    // Konstruktor untuk inisialisasi koneksi database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Mendapatkan semua jenis produk
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Menambahkan jenis produk baru
    public function create($nama) {
        $query = "INSERT INTO " . $this->table . " (nama) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nama]);
    }

    // Mengupdate jenis produk
    public function update($id, $nama) {
        $query = "UPDATE " . $this->table . " SET nama = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nama, $id]);
    }

    // Menghapus jenis produk
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }

    // Mendapatkan jenis produk berdasarkan ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
