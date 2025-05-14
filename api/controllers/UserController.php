<?php

class UserController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function listUsers() {
        // Fetch all users from the database
        $query = "SELECT * FROM users";
        $result = $this->db->query($query);
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    }

    public function addUser() {
        $data = json_decode(file_get_contents("php://input"), true);
        $query = "INSERT INTO users (name, email, role) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $data['name'], $data['email'], $data['role']);
        $stmt->execute();
        echo json_encode(["success" => $stmt->affected_rows > 0]);
    }

    public function editUser() {
        $data = json_decode(file_get_contents("php://input"), true);
        $query = "UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssi", $data['name'], $data['email'], $data['role'], $data['id']);
        $stmt->execute();
        echo json_encode(["success" => $stmt->affected_rows > 0]);
    }

    public function deleteUser() {
        $data = json_decode(file_get_contents("php://input"), true);
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $data['id']);
        $stmt->execute();
        echo json_encode(["success" => $stmt->affected_rows > 0]);
    }
}
?>