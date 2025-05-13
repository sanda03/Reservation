const { differenceInDays } = require('date-fns');

class ReservationService {
    constructor() {
        this.reservationMap = new Map();
        this.reservationId = 1; // Pour générer des identifiants uniques
    }

    // Vérification de la disponibilité avancée
    isAvailable(item, startTime, endTime) {
        for (const reservation of this.reservationMap.values()) {
            if (reservation.item.getName() === item.getName()) {
                if (!(reservation.endTime <= startTime || reservation.startTime >= endTime)) {
                    return false;
                }
            }
        }
        return true;
    }

    // Calcul du nombre de jours
    calculateDays(startTime, endTime) {
        const days = differenceInDays(endTime, startTime);
        return days === 0 ? 1 : days + 1;
    }

    // Réservation d'un item
    reserveItem(item, startTime, endTime) {
        const days = this.calculateDays(startTime, endTime);
        console.log(`Durée calculée : ${days} jour(s)`);

        if (!this.isAvailable(item, startTime, endTime)) {
            console.log(`L'item ${item.getName()} est déjà réservé pendant cette période.`);
            return false;
        }

        // Créer une réservation avec un identifiant unique
        const reservation = {
            id: this.reservationId++, // Incrémentation de l'ID
            item,
            startTime,
            endTime,
            days
        };

        this.reservationMap.set(reservation.id, reservation);
        item.setReserved(true);
        console.log(`✅ Réservation effectuée : ${item.getName()} du ${startTime} au ${endTime} (Durée: ${days} jour(s))`);
        return true;
    }

    // Liste des réservations
    listReservations() {
        if (this.reservationMap.size === 0) {
            console.log("🚫 Aucune réservation n'a été trouvée.");
            return;
        }

        console.log("\n📋 Liste des réservations :");
        for (const reservation of this.reservationMap.values()) {
            console.log(`🔹 Réservation ID ${reservation.id} - ${reservation.item.getName()} du ${reservation.startTime} au ${reservation.endTime} (Durée: ${reservation.days} jour(s))`);
        }
    }

    // Annuler une réservation
    cancelReservation(id) {
        if (this.reservationMap.has(id)) {
            const reservation = this.reservationMap.get(id);
            reservation.item.setReserved(false);
            this.reservationMap.delete(id);
            console.log(`❌ Réservation annulée pour : ${reservation.item.getName()} (ID ${id})`);
        } else {
            console.log(`⚠️ Aucune réservation trouvée avec l'ID ${id}`);
        }
    }
}

module.exports = ReservationService;
