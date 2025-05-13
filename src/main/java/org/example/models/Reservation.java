package org.example.models;

import java.time.LocalDateTime;

public class Reservation {
    private Item item;
    private LocalDateTime startTime;
    private LocalDateTime endTime;

    public Reservation(Item item, LocalDateTime startTime, LocalDateTime endTime) {
        this.item = item;
        this.startTime = startTime;
        this.endTime = endTime;
    }

    public Item getItem() {
        return item;
    }

    public LocalDateTime getStartTime() {
        return startTime;
    }

    public LocalDateTime getEndTime() {
        return endTime;
    }

    public long getDurationInHours() {
        return java.time.Duration.between(startTime, endTime).toHours();
    }

    @Override
    public String toString() {
        return "Réservation de " + item.getName() + " du " + startTime + " au " + endTime
                + " (Durée: " + getDurationInHours() + " heures)";
    }
}
