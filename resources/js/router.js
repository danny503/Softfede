import Vue    from 'vue'
import Router from 'vue-router'

import Home    from '@/components/Home'
import Rama   from '@/components/Rama'
import Contact from '@/components/Contact'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/',
            component: Home
        },
        {
            path: '/rama',
            name: 'Programacion',
            component: ()=>import('./views.Rama.vue')
        },
        {
            path: '/contact',
            component: Contact
        }
    ],
    linkActiveClass: "active",
    mode: "history"
})
