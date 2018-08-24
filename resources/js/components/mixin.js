export default {
    computed: {
        formattedValue() {
            return this.field.value.toLocaleString(this.field.locale, {
                style: 'currency',
                currency: this.field.currency,
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        },
    }
}