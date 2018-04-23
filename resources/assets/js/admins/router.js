import VueRouter from 'vue-router';

import Overview from './views/Overview';

/**
 * Admins
 * 
 */
import AdminsIndex from './views/admins/Index';
import AdminsCreate from './views/admins/Create';
import AdminsView from './views/admins/View';
import AdminsEdit from './views/admins/Edit';

/**
 * Stores
 * 
 */
import StoresIndex from './views/stores/Index';
import StoresCreate from './views/stores/Create';
import StoresView from './views/stores/View';
import StoresEdit from './views/stores/Edit';

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', name: 'overview', component: Overview },

        // admins
        { path: '/admins', name: 'admins.index', component: AdminsIndex},
        { path: '/admins/create', name: 'admins.create', component: AdminsCreate },
        { path: '/admins/:id', name: 'admins.view', component: AdminsView },
        { path: '/admins/:id/edit', name: 'admins.edit', component: AdminsEdit },

        // stores
        { path: '/stores', name: 'stores.index', component: StoresIndex},
        { path: '/stores/create', name: 'stores.create', component: StoresCreate },
        { path: '/stores/:id', name: 'stores.view', component: StoresView },
        { path: '/stores/:id/edit', name: 'stores.edit', component: StoresEdit },
    ]
});

export default router;
