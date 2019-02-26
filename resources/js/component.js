Nova.booting((Vue, router, store) => {
    Vue.component('index-nova-nestedset-select', require('./components/Select/IndexField'))
    Vue.component('detail-nova-nestedset-select', require('./components/Select/DetailField'))
    Vue.component('form-nova-nestedset-select', require('./components/Select/FormField'))
})
