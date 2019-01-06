Nova.booting((Vue, router) => {
    Vue.component('index-nova-money-field', require('./components/IndexField').default);
    Vue.component('detail-nova-money-field', require('./components/DetailField').default);
    Vue.component('form-nova-money-field', require('./components/FormField').default);
})
