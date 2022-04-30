import '../scss/app.scss';

const $ = require('jquery');
import 'perfect-scrollbar';
import 'bootstrap-datepicker';
import 'bootstrap/dist/js/bootstrap.bundle';
import './mazer';

$(document).ready(function() {
    $('.js-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        datesDisabled: $('#unavailable-dates').data('dates'),
        startDate: new Date()
    });
});

// start the Stimulus application
import '../bootstrap';
