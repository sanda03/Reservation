require_relative './models/item'
require_relative './services/reservation_service'
require_relative './utils/date_utils'

reservation_service = ReservationService.new
car = Item.new("Voiture")
house = Item.new("Maison")

reservation_service.reserve_item(car, DateUtils.now, DateUtils.plus_hours(5))

reservation_service.reserve_item(house, DateUtils.now, DateUtils.plus_days(2))

reservation_service.list_reservations
