import './bootstrap';

import Vue from 'vue';

window.Vue = require('vue');

//Lista de componentes

Vue.component('index', require('./components/Index.vue').default);



const app = new Vue({
	el: '#app'
})
