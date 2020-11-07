<?php
namespace classes;
use PDO;
use PDOException;
use mysqli;

class Database {
  
    const HOST = 'localhost';
    const DB_NAME = 'school';
    const DB_USER = 'root';
    const DB_PASS = 'rootroot';

    /**
     * connection to database
     *
     * @return $connection
     */
    private function connect()
    {
        $connection = new mysqli(self::HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        return $connection;
    }

    /**
     * returns student 
     *
     * @param [type] $id
     * @return array
     */
    public function doSelectStudent($id)
    {
        $connection = $this->connect();
        
        $query = 'SELECT s.sid, s.name, sb.data_type, sb.name as school_name from student as s JOIN school_board as sb ON s.sbid = sb.sbid WHERE s.sid = ' .$id;
        $result = mysqli_query($connection, $query);

        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }

        return false;
    }

    /**
     * returns student grades 
     *
     * @param [type] $id
     * @return array
     */
    public function doSelectStudentGrades($id)
    {
        $connection = $this->connect();

        $query = 'SELECT grade from grades WHERE sid = ' .$id;
        $result = mysqli_query($connection, $query);

        $response = [];
        if ($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $response[] = $row;
            }
        }

        return $response;
    }
}
