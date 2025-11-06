<?php
require_once 'includes/db.php';
require_once 'includes/header.php';

$pageTitle = 'Catálogo de Propiedades - XcodersVR';
$customScript = 'filters.js';

// Obtener filtros de la URL
$filters = [
    'bedrooms' => isset($_GET['bedrooms']) ? $_GET['bedrooms'] : '',
    'bathrooms' => isset($_GET['bathrooms']) ? $_GET['bathrooms'] : '',
    'min_price' => isset($_GET['min_price']) ? $_GET['min_price'] : '',
    'max_price' => isset($_GET['max_price']) ? $_GET['max_price'] : '',
    'area' => isset($_GET['area']) ? $_GET['area'] : ''
];

// Obtener casas con filtros aplicados
$houses = getHouses($filters);

// Si no hay filtros, mostrar todas las casas
if (empty(array_filter($filters))) {
    $houses = [
        [
            'id' => 1,
            'title' => 'Casa Moderna en Zona Residencial',
            'description' => 'Hermosa casa moderna con amplios espacios, acabados de lujo y vista al jardín.',
            'price' => 350000,
            'bedrooms' => 3,
            'bathrooms' => 2,
            'area' => 180,
            'location' => 'Residencial Las Lomas',
            'image' => 'casa1.jpeg',
            'vr_available' => 1
        ],
        [
            'id' => 2,
            'title' => 'Casa Campestre con Piscina',
            'description' => 'Acogedora casa campestre con amplio jardín, piscina y área de BBQ ideal para reuniones familiares.',
            'price' => 420000,
            'bedrooms' => 4,
            'bathrooms' => 3,
            'area' => 250,
            'location' => 'Bosques del Norte',
            'image' => 'casa2.jpeg',
            'vr_available' => 1
        ]
    ];
}
?>

<div class="row mb-4">
    <div class="col-md-6">
        <h1 class="fw-bold text-success">Catálogo de Propiedades</h1>
        <p class="text-muted">Explora nuestras propiedades disponibles con tecnología VR</p>
    </div>
    <div class="col-md-6 text-md-end">
        <button class="btn btn-outline-success" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse" aria-expanded="false" aria-controls="filtersCollapse">
            <i class="fas fa-filter me-2"></i>Filtros
        </button>
    </div>
</div>

<!-- Filtros -->
<div class="collapse mb-5" id="filtersCollapse">
    <div class="card card-body shadow-sm">
        <form id="filterForm" method="GET" action="catalog.php">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="bedrooms" class="form-label">Habitaciones</label>
                    <select class="form-select" id="bedrooms" name="bedrooms">
                        <option value="">Cualquier cantidad</option>
                        <option value="1" <?php echo ($filters['bedrooms'] == '1') ? 'selected' : ''; ?>>1</option>
                        <option value="2" <?php echo ($filters['bedrooms'] == '2') ? 'selected' : ''; ?>>2</option>
                        <option value="3" <?php echo ($filters['bedrooms'] == '3') ? 'selected' : ''; ?>>3</option>
                        <option value="4" <?php echo ($filters['bedrooms'] == '4') ? 'selected' : ''; ?>>4+</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="bathrooms" class="form-label">Baños</label>
                    <select class="form-select" id="bathrooms" name="bathrooms">
                        <option value="">Cualquier cantidad</option>
                        <option value="1" <?php echo ($filters['bathrooms'] == '1') ? 'selected' : ''; ?>>1</option>
                        <option value="2" <?php echo ($filters['bathrooms'] == '2') ? 'selected' : ''; ?>>2</option>
                        <option value="3" <?php echo ($filters['bathrooms'] == '3') ? 'selected' : ''; ?>>3</option>
                        <option value="4" <?php echo ($filters['bathrooms'] == '4') ? 'selected' : ''; ?>>4+</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="min_price" class="form-label">Precio mínimo</label>
                    <input type="number" class="form-control" id="min_price" name="min_price" placeholder="Mínimo" value="<?php echo $filters['min_price']; ?>">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="max_price" class="form-label">Precio máximo</label>
                    <input type="number" class="form-control" id="max_price" name="max_price" placeholder="Máximo" value="<?php echo $filters['max_price']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="area" class="form-label">Área mínima (m²)</label>
                    <input type="number" class="form-control" id="area" name="area" placeholder="Área en m²" value="<?php echo $filters['area']; ?>">
                </div>
                <div class="col-md-9 d-flex align-items-end justify-content-end">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fas fa-search me-2"></i>Aplicar Filtros
                    </button>
                    <a href="catalog.php" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Limpiar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Listado de Propiedades -->
<div class="row">
    <?php if (empty($houses)): ?>
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>No se encontraron propiedades con los filtros seleccionados.
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($houses as $house): ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100 property-card shadow-sm animate__animated animate__fadeIn">
                    <div class="position-relative">
                        <img src="assets/image/<?php echo $house['image']; ?>" class="card-img-top" alt="<?php echo $house['title']; ?>">
                        <div class="position-absolute top-0 end-0 bg-success text-white px-3 py-1 m-2 rounded">
                            $<?php echo number_format($house['price'], 0, ',', '.'); ?>
                        </div>
                        <?php if ($house['vr_available']): ?>
                            <div class="position-absolute top-0 start-0 bg-info text-white px-3 py-1 m-2 rounded">
                                <i class="fas fa-vr-cardboard me-1"></i> VR Disponible
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $house['title']; ?></h5>
                        <p class="card-text text-muted"><?php echo $house['location']; ?></p>
                        <p class="card-text"><?php echo $house['description']; ?></p>
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
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <div class="d-flex justify-content-between">
                
                            <?php if ($house['vr_available']): ?>
                                <a href="schedule.php?house_id=<?php echo $house['id']; ?>" class="btn btn-success">
                                    <i class="fas fa-vr-cardboard me-2"></i>Agendar VR
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php
require_once 'includes/footer.php';
?>