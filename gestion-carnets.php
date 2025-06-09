<?php
/*
Plugin Name: Gestión de Carnets FIDE
*/

add_shortcode('gestion_carnets_fide', 'shortcode_gestion_carnets_fide');
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', [], false, true);
    wp_enqueue_script('gestion-carnets-js', plugin_dir_url(__FILE__).'gestion-carnets.js', ['jquery'], null, true);
    wp_enqueue_style('gestion-carnets-css', plugin_dir_url(__FILE__).'gestion-carnets.css');
});

function shortcode_gestion_carnets_fide() {
    ob_start();
    ?>
    <div class="container my-4">
        <h2 class="mb-4">Gestión de Carnets FIDE</h2>
        <div class="mb-3 d-flex gap-2">
            <select id="filtro-liga" class="form-select w-auto">
                <option value="">Todas las ligas</option>
            </select>
            <input type="text" id="buscador-carnets" class="form-control w-auto" placeholder="Buscar...">
            <button id="exportar-csv" class="btn btn-success">Exportar CSV</button>
            <button id="exportar-json" class="btn btn-secondary">Exportar JSON</button>
            <button id="importar-csv" class="btn btn-primary">Importar CSV</button>
            <button id="recargar-carnets" class="btn btn-outline-dark">Recargar</button>
            <button class="btn btn-dark ms-auto" data-bs-toggle="modal" data-bs-target="#modal-carnet">Agregar Carnet</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm" id="tabla-carnets">
                <thead class="table-success text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>FIDE ID</th>
                        <th>Fecha</th>
                        <th>Liga</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Modal Carnet -->
    <div class="modal fade" id="modal-carnet" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Formulario de Carnet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="form-carnet">
                        <input type="hidden" id="id">
                        <div class="mb-2">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" id="nombre" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label for="fide_id" class="form-label">FIDE ID</label>
                            <input type="text" id="fide_id" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="fecha" class="form-label">Fecha (dd/mm/yyyy)</label>
                            <input type="text" id="fecha" class="form-control" placeholder="dd/mm/yyyy" required>
                        </div>
                        <div class="mb-2">
                            <label for="liga" class="form-label">Liga</label>
                            <input type="text" id="liga" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-success" id="guardar-carnet">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
