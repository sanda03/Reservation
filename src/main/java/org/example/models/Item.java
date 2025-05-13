package org.example.models;

public class Item {
    private String name;
    private boolean isReserved;

    public Item(String name) {
        this.name = name;
        this.isReserved = false;
    }

    public String getName() {
        return name;
    }

    public boolean isReserved() {
        return isReserved;
    }

    public void setReserved(boolean reserved) {
        this.isReserved = reserved;
    }

    @Override
    public String toString() {
        return name + (isReserved ? " (Réservé)" : " (Disponible)");
    }
}
