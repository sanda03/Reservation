class Item {
    constructor(name) {
        this.name = name;
        this.isReserved = false;
    }

    setReserved(reserved) {
        this.isReserved = reserved;
    }

    getName() {
        return this.name;
    }

    isItemReserved() {
        return this.isReserved;
    }
}

module.exports = Item;