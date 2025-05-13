require 'date'

module DateUtils
  def self.now
    DateTime.now
  end

  def self.plus_hours(hours)
    DateTime.now + (hours.to_f / 24)
  end

  def self.plus_days(days)
    DateTime.now + days
  end
end
