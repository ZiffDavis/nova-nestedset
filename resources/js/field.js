Nova.booting((Vue, router, store) => {
    Vue.component('index-nova-nestedset', require('./components/IndexField'))
    Vue.component('detail-nova-nestedset', require('./components/DetailField'))
    Vue.component('form-nova-nestedset', require('./components/FormField'))
})
