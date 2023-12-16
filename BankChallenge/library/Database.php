<?php
class Database {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Returns all records in given table
    public function GetAllRecords($table) {
        $query = "SELECT * FROM $table";
        $statement = $this->pdo->query($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    // Returns records on given table with offset
    public function GetRecordsByOffset($table, $offset, $limit) {
        $query = "SELECT * FROM $table LIMIT :limit OFFSET :offset";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    // Returns the single record on given table
    public function GetRecordById($table, $id) {
        $query = "SELECT * FROM $table WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    // Inserts data on given table
    public function InsertRecord($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        $statement = $this->pdo->prepare($query);
        $statement->execute($data);

        return $this->pdo->lastInsertId();
    }
    // Updates data on given table
    public function UpdateRecord($table, $id, $data) {
        $setClause = "";
        foreach ($data as $key => $value) {
            $setClause .= "$key=:$key, ";
        }
        $setClause = rtrim($setClause, ', ');
        // Begin Transaction
        $this->pdo->beginTransaction();

        $query = "UPDATE $table SET $setClause WHERE id = :id";
        $statement = $this->pdo->prepare($query);

        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
        // Commit Transaction
        $this->pdo->commit();
        return $statement->rowCount();
    }
    // Delete data on given table
    public function DeleteRecord($table, $conditions) {
        $whereClause = "";
        foreach ($conditions as $key => $value) {
            $whereClause .= "$key=:$key AND ";
        }
        $whereClause = rtrim($whereClause, ' AND ');

        $query = "DELETE FROM $table WHERE $whereClause";
        $statement = $this->pdo->prepare($query);

        foreach ($conditions as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();

        return $statement->rowCount();
    }

}
?>