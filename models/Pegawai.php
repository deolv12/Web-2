<?php
class Pegawai {
    private $conn;
    private $table = "pegawai";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM pegawai";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getById($id) {
        $query = "SELECT * FROM pegawai WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nip, $nama, $jenis_kelamin, $jabatan) {
        $query = "INSERT INTO pegawai (nip, nama, jenis_kelamin, jabatan) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nip, $nama, $jenis_kelamin, $jabatan]);
    }

    public function update($id, $nip, $nama, $jenis_kelamin, $jabatan) {
        $query = "UPDATE pegawai SET nip = ?, nama = ?, jenis_kelamin = ?, jabatan = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nip, $nama, $jenis_kelamin, $jabatan, $id]);
    }

    public function delete($id) {
        $query = "DELETE FROM pegawai WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>
