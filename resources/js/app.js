window.Vue = require('vue');
window.Swal = require('sweetalert2');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});