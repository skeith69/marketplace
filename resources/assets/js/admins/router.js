import VueRouter from 'vue-router';
import store from './store';

const Overview = () => import('./views/Overview');

/**
 * Admins
 *
 */
const AdminsIndex = () => import('./views/admins/Index');
const AdminsCreate = () => import('./views/admins/Create');
const AdminsView = () => import('./views/admins/View');
const AdminsEdit = () => import('./views/admins/Edit');
const AdminsAssignRoles = () => import('./views/admins/AssignRoles');

/**
 * Categories
 *
 */
const CategoriesIndex = () => import('./views/categories/Index');
const CategoriesCreate = () => import('./views/categories/Create');
const CategoriesView = () => import('./views/categories/View');
const CategoriesEdit = () => import('./views/categories/Edit');

/**
 * Permissions
 *
 */
const PermissionsIndex = () => import('./views/permissions/Index');
const PermissionsCreate = () => import('./views/permissions/Create');
const PermissionsView = () => import('./views/permissions/View');
const PermissionsEdit = () => import('./views/permissions/Edit');

/**
 * Products
 *
 */
const ProductsIndex = () => import('./views/products/Index');
const ProductsCreate = () => import('./views/products/Create');
const ProductsView = () => import('./views/products/View');
const ProductsEdit = () => import('./views/products/Edit');

/**
 * Roles
 *
 */
const RolesIndex = () => import('./views/roles/Index');
const RolesCreate = () => import('./views/roles/Create');
const RolesView = () => import('./views/roles/View');
const RolesEdit = () => import('./views/roles/Edit');
const RolesAssignPermissions = () => import('./views/roles/AssignPermissions');

/**
 * Sales
 *
 */
const SalesIndex = () => import('./views/sales/Index');
const SalesCreate = () => import('./views/sales/Create');
const SalesView = () => import('./views/sales/View');
const SalesEdit = () => import('./views/sales/Edit');

/**
 * Stores
 *
 */
const StoresIndex = () => import('./views/stores/Index');
const StoresCreate = () => import('./views/stores/Create');
const StoresView = () => import('./views/stores/View');
const StoresEdit = () => import('./views/stores/Edit');

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', name: 'overview', component: Overview },

        // admins
        { path: '/admins', name: 'admins.index', component: AdminsIndex},
        { path: '/admins/create', name: 'admins.create', component: AdminsCreate },
        { path: '/admins/:id', name: 'admins.view', component: AdminsView },
        { path: '/admins/:id/edit', name: 'admins.edit', component: AdminsEdit },
        { path: '/admins/:id/assign-roles', name: 'admins.assign-roles', component: AdminsAssignRoles },

        // categories
        { path: '/categories', name: 'categories.index', component: CategoriesIndex},
        { path: '/categories/create', name: 'categories.create', component: CategoriesCreate },
        { path: '/categories/:id', name: 'categories.view', component: CategoriesView },
        { path: '/categories/:id/edit', name: 'categories.edit', component: CategoriesEdit },

        // permissions
        { path: '/permissions', name: 'permissions.index', component: PermissionsIndex},
        { path: '/permissions/create', name: 'permissions.create', component: PermissionsCreate },
        { path: '/permissions/:id', name: 'permissions.view', component: PermissionsView },
        { path: '/permissions/:id/edit', name: 'permissions.edit', component: PermissionsEdit },

        // products
        { path: '/products', name: 'products.index', component: ProductsIndex},
        { path: '/products/create', name: 'products.create', component: ProductsCreate },
        { path: '/products/:id', name: 'products.view', component: ProductsView },
        { path: '/products/:id/edit', name: 'products.edit', component: ProductsEdit },

        // roles
        { path: '/roles', name: 'roles.index', component: RolesIndex},
        { path: '/roles/create', name: 'roles.create', component: RolesCreate },
        { path: '/roles/:id', name: 'roles.view', component: RolesView },
        { path: '/roles/:id/edit', name: 'roles.edit', component: RolesEdit },
        { path: '/roles/:id/assign-permissions', name: 'roles.assign-permissions', component: RolesAssignPermissions },

        // sales
        { path: '/sales', name: 'sales.index', component: SalesIndex},
        { path: '/sales/create', name: 'sales.create', component: SalesCreate },
        { path: '/sales/:id', name: 'sales.view', component: SalesView },
        { path: '/sales/:id/edit', name: 'sales.edit', component: SalesEdit },

        // stores
        { path: '/stores', name: 'stores.index', component: StoresIndex},
        { path: '/stores/create', name: 'stores.create', component: StoresCreate },
        { path: '/stores/:id', name: 'stores.view', component: StoresView },
        { path: '/stores/:id/edit', name: 'stores.edit', component: StoresEdit }
    ]
});

export default router;
