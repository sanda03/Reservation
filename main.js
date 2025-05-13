const Item = require('./models/item');
const ReservationService = require('./services/reservationService');
const { now, plusHours, plusDays } = require('./utils/dateUtils');

const reservationService = new ReservationService();
const car = new Item('Voiture');

const start = now();
const endSameDay = plusHours(5);

const startNow = plusDays(1);
const endNextDay = plusDays(1);

console.log('\n🔵 Réservation d\'une après-midi (même jour) :');
reservationService.reserveItem(car, start, endSameDay);

console.log('\n🔵 Réservation sur deux jours :');
reservationService.reserveItem(car, startNow, endNextDay);

console.log('\n📋 Liste des réservations :');
reservationService.listReservations();
