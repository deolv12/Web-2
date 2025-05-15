<?php
class KartuDiskon {
    private $conn;
    private $table = "kartu_diskon";  // Nama tabel dalam database

    // Konstruktor untuk inisialisasi koneksi database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Mendapatkan semua kartu diskon
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Menambahkan kartu diskon baru
    public function create($nama, $diskon) {
        $query = "INSERT INTO " . $this->table . " (nama, diskon) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nama, $diskon]);
    }

    // Mengupdate kartu diskon
    public function update($id, $nama, $diskon) {
        $query = "UPDATE " . $this->table . " SET nama = ?, diskon = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nama, $diskon, $id]);
    }

    // Menghapus kartu diskon
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }

    // Mendapatkan kartu diskon berdasarkan ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
