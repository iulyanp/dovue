<template id="alert-template">
    <div :class="alertClasses" v-show="show">

        <slot></slot>
        <span class="alert__close" v-on:click="show = false">x</span>
    </div>
</template>
