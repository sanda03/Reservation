const now = () => new Date();

const plusHours = (hours) => {
    const date = new Date();
    date.setHours(date.getHours() + hours);
    return date;
};

const plusDays = (days) => {
    const date = new Date();
    date.setDate(date.getDate() + days);
    return date;
};

module.exports = { now, plusHours, plusDays };
