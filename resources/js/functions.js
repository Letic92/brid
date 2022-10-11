window.$ = require('jquery');
window.Swal = require('sweetalert2');

$(document).ready(function() {
    $('#list-select').on('change', function (e) {
        window.livewire.emit('changeOrder', e.target.value)
    });
});
