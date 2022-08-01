require('./bootstrap');

window.Vue = require('vue').default;

// import { ModelListSelect } from "vue-search-select";
// import { ModelSelect } from "vue-search-select";
// import "vue-search-select/dist/VueSearchSelect.css"
import {Form, HasError, AlertError} from 'vform';
window.Form  = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

let Fire =new Vue();
window.Fire = Fire;
//Import Alert
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.Toast = Toast;

// Progress Bar
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '20px'
})

import Vue from 'vue';
import VueRouter from 'vue-router'
Vue.use(VueRouter)

let routes =[
    { path: '/data-user', component:require('./components/Pengguna/Data-pengguna.vue').default },
    { path: '/data-level', component:require('./components/Pengguna/Data-level.vue').default },
    { path: '/kategori', component:require('./components/Inventory/Kategori.vue').default },
    { path: '/inventory', component:require('./components/Inventory/Inventory.vue').default },
    { path: '/lokasi', component:require('./components/Inventory/Lokasi.vue').default },
    { path: '/barang-keluar', component:require('./components/Manifest/BarangKeluar.vue').default },
    { path: '/modelselect', component:require('./components/Manifest/ModelSelect.vue').default },
    { path: '/qrstream', component:require('./components/Qr/QrStream.vue').default },
    { path: '/manifest', component:require('./components/Manifest/DataManifest.vue').default },
    // { path: '/detail-manifest/:itemId/details', props:true, component:require('./components/Manifest/CreateManifest.vue').default },
    // { path: '/detail-manifest', component:require('./components/Manifest/CreateManifest.vue').default },
    { path: '/detail-manifest/:itemId',name:'detail', props:true, component:require('./components/Manifest/DetailManifest.vue').default }
]

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    el: '#app',
    router
});
