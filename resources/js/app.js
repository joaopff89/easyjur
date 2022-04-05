/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;



/* importando e configurando o vuex */
import Vuex from 'Vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        item: {},
        transaction: {
            status: '',
            msg: ''
        }
    }
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('login-component', require('./components/Login.vue').default);
Vue.component('home-component', require('./components/Home.vue').default);
Vue.component('dicas-index-component', require('./components/DicasIndex.vue').default);
Vue.component('dicas-home-component', require('./components/DicasHome.vue').default);
Vue.component('dica-create-component', require('./components/DicaCreate.vue').default);
Vue.component('filter-component', require('./components/Filter.vue').default);
Vue.component('table-component', require('./components/Table.vue').default);
Vue.component('alert-component', require('./components/Alert.vue').default);
Vue.component('modal-component', require('./components/Modal.vue').default);
Vue.component('pagination-component', require('./components/Pagination.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
