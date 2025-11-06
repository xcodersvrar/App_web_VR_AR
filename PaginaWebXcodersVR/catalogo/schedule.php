<?php
require_once 'includes/db.php';
require_once 'includes/header.php';

$pageTitle = 'Agendar Demostración VR - XcoderVR';
$customScript = 'schedule.js';

// Obtener ID de la casa desde la URL
$houseId = isset($_GET['house_id']) ? intval($_GET['house_id']) : 0;

// Obtener información de la casa
$house = getHouseById($houseId);

if (!$house) {
    // Redirigir si no se encuentra la casa
    header('Location: catalog.php');
    exit;
}

// Procesar el formulario si se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentData = [
        'house_id' => $houseId,
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'date' => $_POST['date'],
        'time' => $_POST['time'],
        'notes' => $_POST['notes']
    ];
    
    if (saveAppointment($appointmentData)) {
        $successMessage = "¡Tu cita ha sido agendada exitosamente! Te hemos enviado un correo de confirmación.";
    } else {
        $errorMessage = "Hubo un error al agendar tu cita. Por favor intenta nuevamente.";
    }
}
?>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-sm animate__animated animate__fadeIn">
            <div class="card-header bg-success text-white">
                <h2 class="h4 mb-0"><i class="fas fa-vr-cardboard me-2"></i>Agendar Demostración VR</h2>
            </div>
            <div class="card-body">
                <?php if (isset($successMessage)): ?>
                    <div class="alert alert-success">
                        <?php echo $successMessage; ?>
                    </div>
                    <div class="text-center mt-4">
                        <a href="catalog.php" class="btn btn-success">
                            <i class="fas fa-arrow-left me-2"></i>Volver al Catálogo
                        </a>
                    </div>
                <?php else: ?>
                    <?php if (isset($errorMessage)): ?>
                        <div class="alert alert-danger">
                            <?php echo $errorMessage; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <img src="assets/image/<?php echo $house['image']; ?>" class="img-fluid rounded" alt="<?php echo $house['title']; ?>">
                        </div>
                        <div class="col-md-8">
                            <h4><?php echo $house['title']; ?></h4>
                            <p class="text-muted"><?php echo $house['location']; ?></p>
                            <div class="property-features mb-3">
                                <span class="badge bg-light text-dark me-2">
                                    <i class="fas fa-bed text-success me-1"></i> <?php echo $house['bedrooms']; ?> Hab.
                                </span>
                                <span class="badge bg-light text-dark me-2">
                                    <i class="fas fa-bath text-success me-1"></i> <?php echo $house['bathrooms']; ?> Baños
                                </span>
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-ruler-combined text-success me-1"></i> <?php echo $house['area']; ?> m²
                                </span>
                            </div>
                            <p class="text-success fw-bold">$<?php echo number_format($house['price'], 0, ',', '.'); ?></p>
                        </div>
                    </div>
                    
                    <form id="appointmentForm" method="POST" action="schedule.php?house_id=<?php echo $houseId; ?>">
                        <h5 class="mb-4 border-bottom pb-2">Información de Contacto</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="date" class="form-label">Fecha de Demostración</label>
                                <input type="date" class="form-control" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="time" class="form-label">Hora de Demostración</label>
                                <select class="form-select" id="time" name="time" required>
                                    <option value="">Seleccionar hora</option>
                                    <option value="09:00">09:00 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="12:00">12:00 PM</option>
                                    <option value="13:00">01:00 PM</option>
                                    <option value="14:00">02:00 PM</option>
                                    <option value="15:00">03:00 PM</option>
                                    <option value="16:00">04:00 PM</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="notes" class="form-label">Notas Adicionales</label>
                                <textarea class="form-control" id="notes" name="notes" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label" for="terms">
                                Acepto los <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">términos y condiciones</a>
                            </label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-calendar-check me-2"></i>Confirmar Cita
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Términos y Condiciones -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="termsModalLabel">Términos y Condiciones</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Demostraciones VR con XcoderVR</h6>
                <p>Al agendar una demostración VR con XcoderVR, aceptas los siguientes términos y condiciones:</p>
                <ol>
                    <li>La demostración VR tiene una duración aproximada de 30 minutos.</li>
                    <li>Debes presentarte puntualmente a la hora agendada.</li>
                    <li>En caso de no poder asistir, debes cancelar con al menos 24 horas de anticipación.</li>
                    <li>XcoderVR se reserva el derecho de cancelar o reprogramar citas por causas de fuerza mayor.</li>
                    <li>La demostración VR no sustituye una visita física a la propiedad.</li>
                </ol>
                <p>Para más información, consulta nuestra política de privacidad.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Entendido</button>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>