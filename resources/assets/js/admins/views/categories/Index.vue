<template>
    <div>
        <div class="card">
            <div class="card-header clearfix">
                Categories / View Categories
            </div>
            <div class="card-body">
                <table class="table table-hover table-sm">
                    <caption>
                        <div class="row">
                            <div class="col-md-9">
                                List of Categories - Total Items {{ this.meta.total }}
                            </div>
                            <div class="col-md-3">
                                <div class="progress" height="30px;" v-if="showProgress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody v-if="categories">
                        <tr v-for="{ id, name, description } in categories">
                            <td>{{ id }}</td>
                            <td>{{ name }}</td>
                            <td>{{ description }}</td>
                            <td>
                                <router-link class="text-info" :to="{ name: 'categories.view', params: { id: id }}">View</router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br>

        <div class="clearfix">
            <div v-if="pageCount">
                <nav class="float-left">
                    <ul class="pagination">
                        <li class="page-item" v-bind:class="isPrevDisabled">
                            <a class="page-link" href="#" @click.prevent="goToPreviousPage" disabled>Previous</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" @click.prevent="goToFirstPage">First</a>
                        </li>
                        <li class="page-item" v-for="pageNumber in pageNumbers" v-bind:class="isPageActive(pageNumber)">
                            <a class="page-link" href="#" @click.prevent="goToPage(pageNumber)">{{ pageNumber }}</a>
                        </li>
                        <li class="page-item" v-bind:class="isNextDisabled">
                            <a class="page-link" href="#" @click.prevent="goToLastPage">Last</a>
                        </li>
                        <li class="page-item" v-bind:class="isNextDisabled">
                            <a class="page-link" href="#" @click.prevent="goToNextPage">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div v-else>
                <nav class="float-left">
                    <ul class="pagination">
                        <li class="page-item" v-bind:class="isPrevDisabled">
                            <a class="page-link" href="#" @click.prevent="goToPreviousPage" disabled>Previous</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" @click.prevent="goToFirstPage">First</a>
                        </li>
                        <li class="page-item" v-for="pageNumber in pageNumbers" v-bind:class="isPageActive(pageNumber)">
                            <a class="page-link" href="#" @click.prevent="goToPage(pageNumber)">{{ pageNumber }}</a>
                        </li>
                        <li class="page-item" v-bind:class="isNextDisabled">
                            <a class="page-link" href="#" @click.prevent="goToLastPage">Last</a>
                        </li>
                        <li class="page-item" v-bind:class="isNextDisabled">
                            <a class="page-link" href="#" @click.prevent="goToNextPage">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="float-right">
                <form class="form-inline">
                    <label class="sr-only" for="Number of Items">Number of Items</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Items per page</div>
                        </div>
                        <select class="custom-select" id="number_of_items" v-model="meta.per_page" v-on:change="changePerPage">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
const getCategories = (page, per_page, callback) => {
    const params = { page, per_page };

    axios.get('/api/categories', { params }).then(res => {
        callback(null, res.data);
    }).catch(error => {
        if (error.response.status == 401) {
            location.reload();
        }

        if (error.response.status == 500) {
            alert('Kindly report this issue to the devs.');
        }
    });
};

export default {
    data() {
        return {
            categories: null,
            meta: {
                current_page: null,
                from: null,
                last_page: null,
                path: null,
                per_page: 10,
                to: null,
                total: null
            },
            links: {
                first: null,
                last: null,
                next: null,
                prev: null,
            },
            error: null,
            showProgress: false,
            pageNumbers: []
        };
    },

    beforeRouteEnter (to, from, next) {
        if (to.query.per_page == null) {
            getCategories(to.query.page, 10, (err, data) => {
                next(vm => vm.setData(err, data));
            });
        } else {
            getCategories(to.query.page, to.query.per_page, (err, data) => {
                next(vm => vm.setData(err, data));
            });
        }
    },

    beforeRouteUpdate (to, from, next) {
        getCategories(to.query.page, this.meta.per_page, (err, data) => {
            this.setData(err, data);
            next();
        });
    },
    
    computed: {
        nextPage() {
            return this.meta.current_page + 1;
        },
        prevPage() {
            return this.meta.current_page - 1;
        },
        paginatonCount() {
            if (! this.meta) {
                return;
            }

            const { current_page, last_page } = this.meta;

            return `${current_page} of ${last_page}`;
        },
        pageCount() {
            if (this.meta.last_page > 10) {
                return false;
            }

            return true;
        },
        isPrevDisabled() {
            if (this.links.prev == null) {
                return 'disabled';
            }

            return;
        },
        isNextDisabled() {
            if (this.links.next == null) {
                return 'disabled';
            }

            return;
        }
    },

    methods: {
        goToFirstPage() {
            this.showProgress = true;
            this.$router.push({
                name: 'categories.index',
                query: {
                    page: 1,
                    per_page: this.meta.per_page
                },
            });
        },
        goToPage(page = null) {
            this.showProgress = true;
            this.$router.push({
                name: 'categories.index',
                query: {
                    page,
                    per_page: this.meta.per_page
                },
            });
        },
        goToLastPage() {
            this.showProgress = true;
            this.$router.push({
                name: 'categories.index',
                query: {
                    page: this.meta.last_page,
                    per_page: this.meta.per_page
                },
            });
        },
        goToNextPage() {
            this.showProgress = true;
            this.$router.push({
                name: 'categories.index',
                query: {
                    page: this.nextPage,
                    per_page: this.meta.per_page
                },
            });
        },
        goToPreviousPage() {
            this.showProgress = true;
            this.$router.push({
                name: 'categories.index',
                query: {
                    page: this.prevPage,
                    per_page: this.meta.per_page
                }
            });
        },
        setData(err, { data: categories, links, meta }) {
            this.pageNumbers = [];

            if (err) {
                this.error = err.toString();
            } else {
                this.categories = categories;
                this.links = links;
                this.meta = meta;
            }

            this.showProgress = false;
            this.populatePages();
        },
        populatePages() {
            if (this.pageCount) {
                for (let i = 1; i <= this.meta.last_page; i++) {
                    this.pageNumbers.push(i);
                }
            } else if (this.meta.current_page <= 6) {
                let page = 1;
                this.pageNumbers.push(page);
                this.pageNumbers.push(page + 1);
                this.pageNumbers.push(page + 2);
                this.pageNumbers.push(page + 3);
                this.pageNumbers.push(page + 4);
                this.pageNumbers.push(page + 5);
                this.pageNumbers.push(page + 6);
                this.pageNumbers.push('...');
                this.pageNumbers.push(this.meta.last_page - 1);
                this.pageNumbers.push(this.meta.last_page);
            } else if ((this.meta.current_page + 6) >= this.meta.last_page) {
                this.pageNumbers.push(1);
                this.pageNumbers.push(2);
                this.pageNumbers.push('...');
                this.pageNumbers.push(this.meta.last_page - 7);
                this.pageNumbers.push(this.meta.last_page - 6);
                this.pageNumbers.push(this.meta.last_page - 5);
                this.pageNumbers.push(this.meta.last_page - 4);
                this.pageNumbers.push(this.meta.last_page - 3);
                this.pageNumbers.push(this.meta.last_page - 2);
                this.pageNumbers.push(this.meta.last_page - 1);
                this.pageNumbers.push(this.meta.last_page);
            } else {
                this.pageNumbers.push(1);
                this.pageNumbers.push(2);
                this.pageNumbers.push('...');
                this.pageNumbers.push(this.meta.current_page - 2);
                this.pageNumbers.push(this.meta.current_page - 1);
                this.pageNumbers.push(this.meta.current_page);
                this.pageNumbers.push(this.meta.current_page + 1);
                this.pageNumbers.push(this.meta.current_page + 2);
                this.pageNumbers.push('...');
                this.pageNumbers.push(this.meta.last_page - 1);
                this.pageNumbers.push(this.meta.last_page);
            }
        },
        isPageActive(page) {
            if (page == this.$route.query.page || (page == 1 && this.$route.query.page == null)) {
                return 'active';
            }

            return;
        },
        changePerPage() {
            this.showProgress = true;
            this.$router.push({
                name: 'categories.index',
                query: {
                    page: 1,
                    per_page: this.meta.per_page
                }
            });
        }
    }
}
</script>
