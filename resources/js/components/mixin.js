export default {
    computed: {
        fieldValue() {
            return this.field.displayedAs || this.field.value
        },

        formattedValue() {
            if (this.fieldValue === undefined || this.fieldValue === null) {
                return '-';
            }

            return this.fieldValue.toLocaleString(this.field.locale, {
                style: 'currency',
                currency: this.field.currency,
                minimumFractionDigits: 2,
                maximumFractionDigits: this.field.subUnits
            });
        },
    }
}
