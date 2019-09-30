/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


$('#promote').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget)
    var name = button.data('myname')
    var id = button.data('myid')
    var status = button.data('mystatus')
    var show = "";

    if (status == 'TRAINEE'){
        show = 'PROBATIONARY'
    }else{
        show = 'REGULAR'
    }
    var modal = $(this)
    console.log(id);
    modal.find('.modal-body #myname').val(name);
    modal.find('.modal-body #myid').val(id);
    document.getElementById('myname').textContent = "  "+name;
    document.getElementById('mystatus').textContent = "  "+show;

})  

