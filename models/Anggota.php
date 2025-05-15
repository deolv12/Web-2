<?php
require_once __DIR__ . '/../database/Connection.php';

class Anggota
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::make(); // Menggunakan koneksi PDO dari class Connection
    }

    public function getAllAnggota()
    {
        $query = "SELECT a.*, p.nip, p.nama, p.jabatan, k.nama as kartu_diskon, k.persen_diskon
                  FROM anggota a
                  JOIN pegawai p ON a.pegawai_id = p.id
                  LEFT JOIN kartu_diskon k ON a.kartu_diskon_id = k.id
                  ORDER BY p.nama ASC";

        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
