Nova.booting((Vue, router) => {
    Vue.component('index-nova-money-field', require('./components/IndexField'));
    Vue.component('detail-nova-money-field', require('./components/DetailField'));
    Vue.component('form-nova-money-field', require('./components/FormField'));
})
