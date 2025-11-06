<?php
// Configuración
$company_name = "XcoderVR";
$company_email = "contacto@xcodervr.com"; // Cambiar por el correo real
$upload_dir = "assets/uploads/";
$max_file_size = 50 * 1024 * 1024; // 50MB

// Inicializar variables para evitar errores de undefined
$agency_name = $contact_person = $email = $phone = $property_type = $property_address = '';
$property_size = $bedrooms = $bathrooms = $property_description = $vr_level = $delivery_date = $special_instructions = '';
$uploaded_files = ['images' => []];

// Crear directorio de uploads si no existe
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Función para sanitizar datos
function sanitize_input($data) {
    if (!isset($data)) return '';
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Función para generar nombre único de archivo
function generate_filename($original_name) {
    $extension = pathinfo($original_name, PATHINFO_EXTENSION);
    return uniqid() . '.' . strtolower($extension);
}

// Procesar el formulario solo si es método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y sanitizar datos del formulario
    $agency_name = isset($_POST["agencyName"]) ? sanitize_input($_POST["agencyName"]) : '';
    $contact_person = isset($_POST["contactPerson"]) ? sanitize_input($_POST["contactPerson"]) : '';
    $email = isset($_POST["email"]) ? sanitize_input($_POST["email"]) : '';
    $phone = isset($_POST["phone"]) ? sanitize_input($_POST["phone"]) : '';
    $property_type = isset($_POST["propertyType"]) ? sanitize_input($_POST["propertyType"]) : '';
    $property_address = isset($_POST["propertyAddress"]) ? sanitize_input($_POST["propertyAddress"]) : '';
    $property_size = isset($_POST["propertySize"]) ? sanitize_input($_POST["propertySize"]) : '';
    $bedrooms = isset($_POST["bedrooms"]) ? sanitize_input($_POST["bedrooms"]) : '';
    $bathrooms = isset($_POST["bathrooms"]) ? sanitize_input($_POST["bathrooms"]) : '';
    $property_description = isset($_POST["propertyDescription"]) ? sanitize_input($_POST["propertyDescription"]) : '';
    $vr_level = isset($_POST["vrLevel"]) ? sanitize_input($_POST["vrLevel"]) : '';
    $delivery_date = isset($_POST["deliveryDate"]) ? sanitize_input($_POST["deliveryDate"]) : '';
    $special_instructions = isset($_POST["specialInstructions"]) ? sanitize_input($_POST["specialInstructions"]) : '';

    // Validar campos requeridos
    $errors = [];
    if (empty($agency_name)) $errors[] = "El nombre de la agencia es requerido";
    if (empty($contact_person)) $errors[] = "La persona de contacto es requerida";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Un email válido es requerido";
    if (empty($property_type)) $errors[] = "El tipo de propiedad es requerido";
    if (empty($property_address)) $errors[] = "La dirección de la propiedad es requerida";
    if (empty($property_size)) $errors[] = "El tamaño de la propiedad es requerido";

    // Validar archivos subidos
    if (isset($_FILES["propertyImages"]) && !empty($_FILES["propertyImages"]["name"][0])) {
        $images = $_FILES["propertyImages"];
        for ($i = 0; $i < count($images["name"]); $i++) {
            if ($images["error"][$i] == UPLOAD_ERR_OK) {
                if ($images["size"][$i] > 10 * 1024 * 1024) {
                    $errors[] = "La imagen " . $images["name"][$i] . " excede el tamaño máximo de 10MB.";
                    continue;
                }

                $allowed_types = ["image/jpeg", "image/png"];
                if (!in_array($images["type"][$i], $allowed_types)) {
                    $errors[] = "El archivo " . $images["name"][$i] . " no es una imagen válida (solo JPEG o PNG).";
                    continue;
                }

                $filename = generate_filename($images["name"][$i]);
                $destination = $upload_dir . $filename;
                if (move_uploaded_file($images["tmp_name"][$i], $destination)) {
                    $uploaded_files["images"][] = $filename;
                } else {
                    $errors[] = "Error al subir la imagen " . $images["name"][$i];
                }
            }
        }
    } else {
        $errors[] = "Debes subir al menos una imagen de la propiedad.";
    }

    // Procesar PDF si se subió
    if (isset($_FILES["propertyPDF"]) && $_FILES["propertyPDF"]["error"] == UPLOAD_ERR_OK) {
        if ($_FILES["propertyPDF"]["size"] > 20 * 1024 * 1024) {
            $errors[] = "El PDF excede el tamaño máximo de 20MB.";
        } elseif ($_FILES["propertyPDF"]["type"] != "application/pdf") {
            $errors[] = "El archivo PDF no es válido.";
        } else {
            $filename = generate_filename($_FILES["propertyPDF"]["name"]);
            $destination = $upload_dir . $filename;
            if (move_uploaded_file($_FILES["propertyPDF"]["tmp_name"], $destination)) {
                $uploaded_files["pdf"] = $filename;
            } else {
                $errors[] = "Error al subir el PDF.";
            }
        }
    }

    // Procesar video de propiedad si se subió
    if (isset($_FILES["propertyVideo"]) && $_FILES["propertyVideo"]["error"] == UPLOAD_ERR_OK) {
        if ($_FILES["propertyVideo"]["size"] > $max_file_size) {
            $errors[] = "El video de la propiedad excede el tamaño máximo de 50MB.";
        } else {
            $allowed_types = ["video/mp4", "video/quicktime"];
            if (!in_array($_FILES["propertyVideo"]["type"], $allowed_types)) {
                $errors[] = "El video de la propiedad no es un formato válido (solo MP4 o MOV).";
            } else {
                $filename = generate_filename($_FILES["propertyVideo"]["name"]);
                $destination = $upload_dir . $filename;
                if (move_uploaded_file($_FILES["propertyVideo"]["tmp_name"], $destination)) {
                    $uploaded_files["property_video"] = $filename;
                } else {
                    $errors[] = "Error al subir el video de la propiedad.";
                }
            }
        }
    }

    // Procesar video de zona si se subió
    if (isset($_FILES["zoneVideo"]) && $_FILES["zoneVideo"]["error"] == UPLOAD_ERR_OK) {
        if ($_FILES["zoneVideo"]["size"] > $max_file_size) {
            $errors[] = "El video de la zona excede el tamaño máximo de 50MB.";
        } else {
            $allowed_types = ["video/mp4", "video/quicktime"];
            if (!in_array($_FILES["zoneVideo"]["type"], $allowed_types)) {
                $errors[] = "El video de la zona no es un formato válido (solo MP4 o MOV).";
            } else {
                $filename = generate_filename($_FILES["zoneVideo"]["name"]);
                $destination = $upload_dir . $filename;
                if (move_uploaded_file($_FILES["zoneVideo"]["tmp_name"], $destination)) {
                    $uploaded_files["zone_video"] = $filename;
                } else {
                    $errors[] = "Error al subir el video de la zona.";
                }
            }
        }
    }

    // Si hay errores, mostrarlos
    if (!empty($errors)) {
        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Error en el formulario</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body>
            <div class='container py-5'>
                <div class='alert alert-danger'>
                    <h4 class='alert-heading'>Error al procesar el formulario</h4>
                    <ul>";
                    foreach ($errors as $error) {
                        echo "<li>$error</li>";
                    }
                    echo "</ul>
                    <a href='javascript:history.back()' class='btn btn-outline-danger'>Volver al formulario</a>
                </div>
            </div>
        </body>
        </html>";
        exit;
    }

    // Redirigir a página de éxito
    header("Location: submit_property.php?success=true");
    exit;
} else {
    // Si alguien intenta acceder directamente al script sin enviar el formulario
    header("Location: index.php");
    exit;
}