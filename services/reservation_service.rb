require 'date'
require_relative '../models/item'

class ReservationService
  Reservation = Struct.new(:id, :item, :start_time, :end_time, :days)

  def initialize
    @reservations = {}
    @reservation_id = 1
  end

  def is_available?(item, start_time, end_time)
    @reservations.values.none? do |reservation|
      reservation.item.name == item.name &&
      !(reservation.end_time <= start_time || reservation.start_time >= end_time)
    end
  end

  def calculate_days(start_time, end_time)
    days = (end_time - start_time).to_i
    days.zero? ? 1 : days + 1
  end

  def reserve_item(item, start_time, end_time)
    days = calculate_days(start_time, end_time)
    puts "Durée calculée : #{days} jour(s)"

    unless is_available?(item, start_time, end_time)
      puts "🚫 L'item #{item.name} est déjà réservé pendant cette période."
      return false
    end

    reservation = Reservation.new(@reservation_id, item, start_time, end_time, days)
    @reservations[@reservation_id] = reservation
    item.set_reserved(true)
    @reservation_id += 1

    puts "✅ Réservation effectuée : #{item.name} du #{start_time} au #{end_time} (Durée: #{days} jour(s))"
    true
  end

  def list_reservations
    if @reservations.empty?
      puts "🚫 Aucune réservation trouvée."
      return
    end

    puts "\n📋 Liste des réservations :"
    @reservations.each do |id, reservation|
      puts "🔹 Réservation ID #{id} - #{reservation.item.name} du #{reservation.start_time} au #{reservation.end_time} (Durée: #{reservation.days} jour(s))"
    end
  end
end
