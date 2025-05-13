class Item
  attr_reader :name
  attr_accessor :reserved

  def initialize(name)
    @name = name
    @reserved = false
  end

  def set_reserved(reserved)
    @reserved = reserved
  end

  def is_reserved?
    @reserved
  end
end
