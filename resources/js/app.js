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

});

$('#terminate').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget)
    var name = button.data('myname')
    var id = button.data('myid')

    console.log(name);
    var modal = $(this)
    modal.find('.modal-body #mynameterminate').val(name);
    modal.find('.modal-body #myidterminate').val(id);
    document.getElementById('mynameterminate').textContent = "  "+name;
});

$('#minus').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget)
    var name = button.data('myitemded')
    var quantity = button.data('myquantityded')
    var itemid = button.data('myitemidded')
    var userid = button.data('myuserid')
    console.log(name + " " + quantity + " " + itemid + " " + userid);
    var modal = $(this)
    modal.find('.modal-body #ded_item').val(name);
    modal.find('.modal-body #ded_item_id').val(itemid);
});

$('#add').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget)
    var name = button.data('myitemadd')
    var quantity = button.data('myquantityadd')
    var itemid = button.data('myitemidadd')
    var userid = button.data('myuserid')
    console.log(name + " " + quantity + " " + itemid + " " + userid);
    var modal = $(this)
    modal.find('.modal-body #add_item').val(name);
    modal.find('.modal-body #add_item_id').val(itemid);
});


$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

$(".btn-new-position").click(function(e){
    $(this).closest(".card").find('.new-position-input').show();
    $(this).closest('.card').find(".nex-pos-text").focus();
});

$(".btn-cancel").click(function(e){
    $(this).closest('.card').find(".new-position-input").hide();
});

function remove_disabled(){
    $("#profile-tab").removeClass('disabled');
     }
// new employee modal next button
$("#btnNext").click(function(e){
    var reqlength = $('.new-employee-input').length;
    console.log(reqlength);
    var value = $('.new-employee-input').filter(function () {
        return this.value != '';
    });
    if (value.length>=0 && (value.length !== reqlength)) {
        $("#error-empty").show();
    } else {
        remove_disabled();
        $("#profile-tab").click();
        $("#btnSave").show();
        $("#btnNext").hide();
        $("#error-empty").hide();
    }

});


$(document).ready(function() {
    var div = document.getElementById("edit");
    div.style.display = "none";

});

$('.table tbody').on('click','.btn',function(){
    var row = $(this).closest('tr');
    var name = row.find('td:eq(0)').text();
    var sss = row.find('td:eq(1)').text();
    var phic = row.find('td:eq(2)').text();
    var pi = row.find('td:eq(3)').text();
    var div = document.getElementById("edit");
    var editbtn = $("#editbtn").text();

    if (div.style.display === "none") {
        div.style.display = "block";
    }

    $("#sss").val(sss);
    $("#phic").val(phic);
    $("#pi").val(pi);
    document.getElementById('name').textContent = "DISPLAYING DEDUCTIONS OF:  "+name;
});


$("#close").click(function(e){
    var div = document.getElementById("edit");
    div.style.display = "none";    
});



