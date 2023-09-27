import './bootstrap';

import Vue from 'vue';


window.Vue = require('vue');

//Lista de componentes

Vue.component('index', require('./components/Index.vue').default);
Vue.component('index-modulo', require('./components/IndexModulos.vue').default);

Vue.component('index-carga-datos', require('./components/CargaDatos/Index.vue').default);
Vue.component('index-registro-rutas', require('./components/RegistroRutas/Index.vue').default);


const app = new Vue({
	el: '#app'
})
