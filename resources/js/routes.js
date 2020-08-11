import Bookables from './components/bookables/Bookables'
import Bookable from './components/bookable/Bookable'
import VueRouter from 'vue-router'

const routes = [
    {
        path: '/',
        component: Bookables,
        name: 'home',
    },
    {
        path: '/bookable/:id',
        component: Bookable,
        name: 'bookable'
    }
];

const router = new VueRouter({
    routes,
    mode: 'history',
});

export default router;
