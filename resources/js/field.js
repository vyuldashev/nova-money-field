import IndexField from './components/IndexField.vue';
import DetailField from './components/DetailField.vue';
import FormField from './components/FormField.vue';

Nova.booting((Vue, router) => {
    Vue.component('index-nova-money-field', IndexField);
    Vue.component('detail-nova-money-field', DetailField);
    Vue.component('form-nova-money-field', FormField);
})
