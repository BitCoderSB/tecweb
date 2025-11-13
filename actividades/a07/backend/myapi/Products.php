<?php
namespace MyAPI;

require_once 'DataBase.php';

class Products extends DataBase {
    private $response;

    public function __construct($dbname, $host = 'localhost', $user = 'root', $password = '') {
        parent::__construct($host, $user, $password, $dbname);
        $this->response = [];
    }

    public function getAll() {
        $query = "SELECT * FROM productos";
        $result = $this->conexion->query($query);

        $this->response = [];
        while ($row = $result->fetch_assoc()) {
            $this->response[] = $row;
        }
    }

    public function insert($nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen) {
        $stmt = $this->conexion->prepare(
            "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado)
             VALUES (?, ?, ?, ?, ?, ?, ?, 0)"
        );

        $stmt->bind_param("sssdsis", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);
        $stmt->execute();

        $this->response = ["insertado" => $stmt->affected_rows];
    }

    public function delete($id) {
        $stmt = $this->conexion->prepare(
            "DELETE FROM productos WHERE id = ?"
        );

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $this->response = ["eliminado" => $stmt->affected_rows];
    }

    public function update($id, $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen) {
        $stmt = $this->conexion->prepare(
            "UPDATE productos SET nombre=?, marca=?, modelo=?, precio=?, detalles=?, unidades=?, imagen=? WHERE id=?"
        );

        $stmt->bind_param("sssdsisi", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen, $id);
        $stmt->execute();

        $this->response = ["actualizado" => $stmt->affected_rows];
    }

    public function singleByName($nombre) {
        $stmt = $this->conexion->prepare(
            "SELECT * FROM productos WHERE nombre = ?"
        );

        $stmt->bind_param("s", $nombre);
        $stmt->execute();

        $result = $stmt->get_result();
        $this->response = $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getData() {
        return json_encode($this->response);
    }
}
