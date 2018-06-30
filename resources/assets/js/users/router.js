import VueRouter from 'vue-router';

import Home from './views/Home';
import Products from './views/Products';

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', name: 'home', component: Home },
        { path: '/stores/:id/products', name: 'stores.products', component: Products }
    ]
});

export default router;
