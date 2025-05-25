export default function formatCurrency(
    amount,
    locale = "en-IN",
    currency = "INR"
) {
    return new Intl.NumberFormat(locale, {
        style: "currency",
        currency: currency,
        minimumFractionDigits: 2,
    }).format(amount);
}
