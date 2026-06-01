<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../MODELE/ConfirmationModel.php';
require_once __DIR__ . '/../VUE/confirmation.php';
