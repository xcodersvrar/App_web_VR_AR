<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "xcoder_vr";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Función para obtener todas las casas
function getHouses($filters = []) {
    global $conn;
    
    $sql = "SELECT * FROM houses WHERE 1=1";
    
    // Aplicar filtros
    if (!empty($filters['bedrooms'])) {
        $sql .= " AND bedrooms = " . intval($filters['bedrooms']);
    }
    if (!empty($filters['bathrooms'])) {
        $sql .= " AND bathrooms = " . intval($filters['bathrooms']);
    }
    if (!empty($filters['min_price'])) {
        $sql .= " AND price >= " . intval($filters['min_price']);
    }
    if (!empty($filters['max_price'])) {
        $sql .= " AND price <= " . intval($filters['max_price']);
    }
    if (!empty($filters['area'])) {
        $sql .= " AND area >= " . intval($filters['area']);
    }
    
    $result = $conn->query($sql);
    
    $houses = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $houses[] = $row;
        }
    }
    
    return $houses;
}

// Función para obtener una casa por ID
function getHouseById($id) {
    global $conn;
    
    $sql = "SELECT * FROM houses WHERE id = " . intval($id);
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    
    return null;
}

// Función para guardar una cita
function saveAppointment($data) {
    global $conn;
    
    $stmt = $conn->prepare("INSERT INTO appointments (house_id, name, email, phone, date, time, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $data['house_id'], $data['name'], $data['email'], $data['phone'], $data['date'], $data['time'], $data['notes']);
    
    return $stmt->execute();
}
?>