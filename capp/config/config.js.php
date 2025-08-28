<?php
header('Content-Type: application/javascript');
require_once __DIR__ . '/app.php';
?>
window.APP_CONFIG = {
    OFFICE_LATITUDE: <?php echo json_encode(OFFICE_LATITUDE); ?>,
    OFFICE_LONGITUDE: <?php echo json_encode(OFFICE_LONGITUDE); ?>,
    GEOFENCE_RADIUS_M: <?php echo json_encode(GEOFENCE_RADIUS_M); ?>
};