<?php

namespace models;

require_once __DIR__ . '/../config/connection.php';

use config\Connection;
use PDO;

class Pembayaran
{
    private static function connect()
    {
        return Connection::make();
    }

    public static function get()
    {
        $pdo = self::connect();
        $sql = "
            SELECT pembayaran.*, pesanan.tanggal AS tanggal_pesanan
            FROM pembayaran
            JOIN pesanan ON pembayaran.pesanan_id = pesanan.id
        ";
        $statement = $pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = self::connect();
        $sql = "INSERT INTO pembayaran (jumlah_bayar, tanggal, pesanan_id) 
                VALUES (:jumlah_bayar, :tanggal, :pesanan_id)";
        $statement = $pdo->prepare($sql);

        // Sesuaikan key ini dengan nama yang dipakai di $data
        $jumlahBayar = $data['total_bayar']; // jika di form namanya total_bayar
        $tanggal = $data['tanggal'];
        $pesananId = $data['pesanan_id'];

        $statement->bindParam(':jumlah_bayar', $jumlahBayar);
        $statement->bindParam(':tanggal', $tanggal);
        $statement->bindParam(':pesanan_id', $pesananId);

        return $statement->execute();
    }


    public static function find($id)
    {
        $pdo = self::connect();
        $sql = 'SELECT * FROM pembayaran WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($data)
    {
        $pdo = self::connect();
        $sql = "UPDATE pembayaran 
                SET jumlah_bayar = :jumlah_bayar, tanggal = :tanggal, pesanan_id = :pesanan_id 
                WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':jumlah_bayar', $data['jumlah_bayar']);
        $statement->bindParam(':tanggal', $data['tanggal']);
        $statement->bindParam(':pesanan_id', $data['pesanan_id']);
        $statement->bindParam(':id', $data['id']);

        return $statement->execute();
    }

    public static function delete($id)
    {
        $pdo = self::connect();
        $sql = 'DELETE FROM pembayaran WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }
}
