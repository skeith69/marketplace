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
 * Categories
 * 
 */
import CategoriesIndex from './views/categories/Index';
import CategoriesCreate from './views/categories/Create';
import CategoriesView from './views/categories/View';
import CategoriesEdit from './views/categories/Edit';

/**
 * Products
 * 
 */
import ProductsIndex from './views/products/Index';
import ProductsCreate from './views/products/Create';
import ProductsView from './views/products/View';
import ProductsEdit from './views/products/Edit';

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

        // categories
        { path: '/categories', name: 'categories.index', component: CategoriesIndex},
        { path: '/categories/create', name: 'categories.create', component: CategoriesCreate },
        { path: '/categories/:id', name: 'categories.view', component: CategoriesView },
        { path: '/categories/:id/edit', name: 'categories.edit', component: CategoriesEdit },

        // products
        { path: '/products', name: 'products.index', component: ProductsIndex},
        { path: '/products/create', name: 'products.create', component: ProductsCreate },
        { path: '/products/:id', name: 'products.view', component: ProductsView },
        { path: '/products/:id/edit', name: 'products.edit', component: ProductsEdit },

        // stores
        { path: '/stores', name: 'stores.index', component: StoresIndex},
        { path: '/stores/create', name: 'stores.create', component: StoresCreate },
        { path: '/stores/:id', name: 'stores.view', component: StoresView },
        { path: '/stores/:id/edit', name: 'stores.edit', component: StoresEdit }
    ]
});

export default router;
