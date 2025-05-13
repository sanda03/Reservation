<?php

require_once 'models/Item.php';
require_once 'services/ReservationService.php';
require_once 'utils/DateUtils.php';

$reservationService = new ReservationService();
$car = new Item("Voiture");
$house = new Item("Maison");

// Réservation d'une après-midi (même jour)
$start = DateUtils::now();
$endSameDay = DateUtils::plusHours(5);

echo "\n🔵 Réservation d'une après-midi (même jour) :\n";
$reservationService->reserveItem($car, $start, $endSameDay);

// Réservation sur plusieurs jours
$endNextDay = DateUtils::plusDays(1);
echo "\n🔵 Réservation sur deux jours :\n";
$reservationService->reserveItem($house, $start, $endNextDay);

// Liste des réservations
$reservationService->listReservations();
?>
