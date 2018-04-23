<template>
    <div>
        <navbar-component></navbar-component>
        <transition name="fade" mode="out-in">
            <router-view class="view"></router-view>
        </transition>
        <footer-component></footer-component>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    }
}
</script>

<style>
.fade-enter-active, .fade-leave-active {
    transition: opacity .2s;
}

.fade-enter, .fade-leave-to {
    opacity: 0;
}

.slide-fade-enter-active {
    transition: all .2s ease;
}

.slide-fade-leave-active {
    transition: all .2s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}

.slide-fade-enter, .slide-fade-leave-to {
    transform: translateX(10px);
    opacity: 0;
}

.v-select .dropdown-toggle .clear {
    font-size: 19px !important;
}

.v-select .selected-tag {
    position: absolute !important;
}
</style>
