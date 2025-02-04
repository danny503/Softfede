require('./bootstrap');

window.Vue = require('vue');
import router from './routes'

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
Vue.component('propartido', require('./components/ProPartido.vue').default);
Vue.component('puntajepartido', require('./components/PuntajePartido.vue').default);
Vue.component('partidosprogramados', require('./components/PartidosProgramados.vue').default);
Vue.component('programaciontecnico', require('./components/programacionTecnico.vue').default);
Vue.component('tablaposicion', require('./components/TablaPosicion.vue').default);
Vue.component('programacionfecha', require('./components/ProgramacionFecha.vue').default);
Vue.component('navbar', require('./components/ComponentNavbar.vue').default);
Vue.component('home', require('./components/Home.vue').default);
Vue.component('about', require('./components/About.vue').default);
Vue.component('show', require('./components/ShowContent.vue').default);


const app = new Vue({
    el: '#app',
    router,
    data :{
        menu : 0,
        navbar: 0
    }
});
