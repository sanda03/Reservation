package org.example.services;

import org.example.models.Item;
import org.example.models.Reservation;

import java.time.LocalDateTime;
import java.time.temporal.ChronoUnit;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class ReservationService {
    private Map<String, Reservation> reservationMap = new HashMap<>();

    private long calculateDays(LocalDateTime startTime, LocalDateTime endTime) {
        long days = ChronoUnit.DAYS.between(startTime.toLocalDate(), endTime.toLocalDate());
        return days == 0 ? 1 : days + 1;
    }
    public boolean isAvailable(Item item, LocalDateTime startTime, LocalDateTime endTime) {
        return reservationMap.values().stream()
                .filter(res -> res.getItem().equals(item))
                .noneMatch(res -> !(res.getEndTime().isBefore(startTime) || res.getStartTime().isAfter(endTime)));
    }

    public boolean reserveItem(Item item, LocalDateTime startTime, LocalDateTime endTime) {
        long days = calculateDays(startTime, endTime);
        System.out.println("Durée calculée : " + days + " jour(s)");
        if (!isAvailable(item, startTime, endTime)) {
            System.out.println("L'item " + item.getName() + " est déjà réservé pendant cette période.");
            return false;
        }
        Reservation reservation = new Reservation(item, startTime, endTime);
        reservationMap.put(item.getName(), reservation);
        item.setReserved(true);
        System.out.println("Réservation effectuée : " + reservation);
        return true;
    }

    public void cancelReservation(Item item) {
        reservationMap.remove(item.getName());
        item.setReserved(false);
        System.out.println("Réservation annulée pour : " + item.getName());
    }

    public void listReservations() {
        reservationMap.values().forEach(System.out::println);
    }
}
