<template>
    <div class="sticky-top">
        <ul class="nav flex-column background py-1 mt-3 sidebar-nav">
            <li class="nav-item">
                <span class="nav-link">Dashboards</span>
            </li>

            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'overview' }">Overview</router-link>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#stores" data-toggle="collapse" aria-expanded="false" aria-controls="stores">
                    Stores <i class="float-right fas fa-caret-down"></i>
                </a>
            </li>
            <div class="collapse" id="stores">
                <ul class="nav flex-column nav-sub-menu">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'stores.create' }">Create New Store</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'stores.index' }">View Stores</router-link>
                    </li>
                </ul>
            </div>

            <li class="nav-item">
                <a class="nav-link" href="#categories" data-toggle="collapse" aria-expanded="false" aria-controls="categories">
                    Categories <i class="float-right fas fa-caret-down"></i>
                </a>
            </li>
            <div class="collapse" id="categories">
                <ul class="nav flex-column nav-sub-menu">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'categories.create' }">Create New Category</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'categories.index' }">View Categories</router-link>
                    </li>
                </ul>
            </div>

             <li class="nav-item">
                <a class="nav-link" href="#products" data-toggle="collapse" aria-expanded="false" aria-controls="products">
                    Products <i class="float-right fas fa-caret-down"></i>
                </a>
            </li>
            <div class="collapse" id="products">
                <ul class="nav flex-column nav-sub-menu">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'products.create' }">Create New Product</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'products.index' }">View Products</router-link>
                    </li>
                </ul>
            </div>
        </ul>

        <ul class="nav flex-column background py-1 mt-3 sidebar-nav">
            <li class="nav-item">
                <span class="nav-link">Access Control List</span>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#admins" data-toggle="collapse" aria-expanded="false" aria-controls="admins">
                    Admins <i class="float-right fas fa-caret-down"></i>
                </a>
            </li>
            <div class="collapse" id="admins">
                <ul class="nav flex-column nav-sub-menu">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'admins.create' }">Create New Admin</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'admins.index' }">View Admins</router-link>
                    </li>
                </ul>
            </div>

            <li class="nav-item">
                <a class="nav-link" href="#roles" data-toggle="collapse" aria-expanded="false" aria-controls="roles">
                    Roles <i class="float-right fas fa-caret-down"></i>
                </a>
            </li>
            <div class="collapse" id="roles">
                <ul class="nav flex-column nav-sub-menu">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'roles.create' }">Create New Role</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'roles.index' }">View Roles</router-link>
                    </li>
                </ul>
            </div>

            <li class="nav-item">
                <a class="nav-link" href="#permissions" data-toggle="collapse" aria-expanded="false" aria-controls="permissions">
                    Permissions <i class="float-right fas fa-caret-down"></i>
                </a>
            </li>
            <div class="collapse" id="permissions">
                <ul class="nav flex-column nav-sub-menu">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'permissions.create' }">Create New Permission</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'permissions.index' }">View Permissions</router-link>
                    </li>
                </ul>
            </div>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                assignedRoles: [],
                permissions: []
            }
        },

        mounted() {
        }
    }
</script>
