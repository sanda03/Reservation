<?php

class ReservationService {
    private $reservationMap;
    private $reservationId;

    public function __construct() {
        $this->reservationMap = [];
        $this->reservationId = 1;
    }

    // Vérification de la disponibilité
    private function isAvailable($item, $startTime, $endTime) {
        foreach ($this->reservationMap as $reservation) {
            if ($reservation['item']->getName() === $item->getName()) {
                if (!($reservation['endTime'] <= $startTime || $reservation['startTime'] >= $endTime)) {
                    return false;
                }
            }
        }
        return true;
    }

    // Calcul du nombre de jours
    private function calculateDays($startTime, $endTime) {
        $interval = $startTime->diff($endTime)->days;
        return $interval === 0 ? 1 : $interval + 1;
    }

    // Réserver un item
    public function reserveItem($item, $startTime, $endTime) {
        $days = $this->calculateDays($startTime, $endTime);
        echo "Durée calculée : {$days} jour(s)\n";

        if (!$this->isAvailable($item, $startTime, $endTime)) {
            echo "L'item " . $item->getName() . " est déjà réservé pendant cette période.\n";
            return false;
        }

        $reservation = [
            'id' => $this->reservationId++,
            'item' => $item,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'days' => $days
        ];

        $this->reservationMap[] = $reservation;
        $item->setReserved(true);
        echo "✅ Réservation effectuée : " . $item->getName() . " du " . $startTime->format('Y-m-d H:i') . " au " . $endTime->format('Y-m-d H:i') . " (Durée: {$days} jour(s))\n";
        return true;
    }

    // Liste des réservations
    public function listReservations() {
        if (empty($this->reservationMap)) {
            echo "🚫 Aucune réservation n'a été trouvée.\n";
            return;
        }

        echo "\n📋 Liste des réservations :\n";
        foreach ($this->reservationMap as $reservation) {
            echo "🔹 Réservation ID " . $reservation['id'] . " - " . $reservation['item']->getName() . " du " . $reservation['startTime']->format('Y-m-d H:i') . " au " . $reservation['endTime']->format('Y-m-d H:i') . " (Durée: " . $reservation['days'] . " jour(s))\n";
        }
    }

    // Annuler une réservation
    public function cancelReservation($id) {
        foreach ($this->reservationMap as $key => $reservation) {
            if ($reservation['id'] === $id) {
                $reservation['item']->setReserved(false);
                unset($this->reservationMap[$key]);
                echo "❌ Réservation annulée pour : " . $reservation['item']->getName() . " (ID $id)\n";
                return;
            }
        }
        echo "⚠️ Aucune réservation trouvée avec l'ID $id\n";
    }
}
?>
