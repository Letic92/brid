window.$ = require('jquery');

$(document).ready(function() {
    $('#list-select').on('change', function (e) {
        window.livewire.emit('changeOrder', e.target.value)
    });
});
