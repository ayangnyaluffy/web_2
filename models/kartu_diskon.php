<?php
namespace models;

require_once __DIR__ . '/../config/connection.php';

use config\Connection;
use PDO;

class KartuDiskon
{
    private static function connect()
    {
        return Connection::make(); 
    }

    public static function get()
    {
        $pdo = self::connect();
        $sql = "SELECT * FROM kartu_diskon";
        $statement = $pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

   
 public static function create($data)
{
    try {
        $pdo = self::connect();
        $sql = "INSERT INTO kartu_diskon (nama, deskripsi, persen_diskon) 
                VALUES (:nama, :deskripsi, :persen_diskon)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':nama', $data['nama']);
        $statement->bindParam(':deskripsi', $data['deskripsi']);
        $statement->bindParam(':persen_diskon', $data['persen_diskon']);
        $statement->execute();
        return true;
    } catch (\PDOException $e) {
        return false;
    }
}



    
   public static function find($id)
{
    $pdo = self::connect();
    $sql = 'SELECT * FROM kartu_diskon WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC) ?: null; 
}


    public static function update($data)
    {
        $pdo = self::connect();
        $sql = "UPDATE kartu_diskon 
                SET nama = :nama, 
                    deskripsi = :deskripsi, 
                    persen_diskon = :persen_diskon 
                WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $data['id']);
        $statement->bindParam(':nama', $data['nama']);
        $statement->bindParam(':deskripsi', $data['deskripsi']);
        $statement->bindParam(':persen_diskon', $data['persen_diskon']);

        return $statement->execute();
    }

    // Menghapus data kartu diskon
    public static function delete($id)
    {
        $pdo = self::connect();
        $sql = 'DELETE FROM kartu_diskon WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }
}
