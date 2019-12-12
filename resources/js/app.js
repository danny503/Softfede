/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


Vue.component('equipo-component', require('./components/Equipo.vue').default);
Vue.component('categoria', require('./components/Categoria.vue').default);
Vue.component('sede-component', require('./components/Sede.vue').default);
Vue.component('rama-component', require('./components/Rama.vue').default);
Vue.component('tipo', require('./components/Tipo.vue').default);
Vue.component('rol', require('./components/Rol.vue').default);
Vue.component('user', require('./components/User.vue').default);
Vue.component('index', require('./components/Index.vue').default);
Vue.component('cuerpotecnico', require('./components/CuerpoTecnico.vue').default);
Vue.component('jugador', require('./components/Jugador.vue').default);
Vue.component('planilla', require('./components/PlanillaJuego.vue').default);
Vue.component('torneo', require('./components/Torneo.vue').default);
Vue.component('equipos', require('./components/Equipos.vue').default);
Vue.component('arbitro', require('./components/Arbitro.vue').default);

//Vue.component('index', require('./views/index.vue').default);
//Vue.component('login', require('./components/Login.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data :{
    	menu : 0
    }
});
