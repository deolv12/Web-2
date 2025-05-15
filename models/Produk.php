<?php
class Produk {
    private $conn;
    private $table = "produk";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nama, $harga, $stok) {
        $query = "INSERT INTO {$this->table} (nama_produk, harga, stok) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nama, $harga, $stok]);
    }

    public function update($id, $nama, $harga, $stok) {
        $query = "UPDATE {$this->table} SET nama_produk = ?, harga = ?, stok = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nama, $harga, $stok, $id]);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>
