window.$ = require('jquery');
window.Swal = require('sweetalert2');
window.VideoJs = require('video.js');

$(document).ready(function() {
    $('#list-select').on('change', function (e) {
        window.livewire.emit('changeOrder', e.target.value)
    });
});
