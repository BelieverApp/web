import $ from 'jquery';
window.$ = window.jQuery = $;

//libraries...
require('bootstrap');
require('popper.js');
require('tooltip.js');
//require('icheck');
require('jquery.nicescroll');
require('moment');
require('datatables.net');
require('sweetalert');
require('daterangepicker');
require('medium-editor');
require('chart.js');
require('./stisla.js');
require('./scripts.js');

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

// Daterangepicker


  $('#mission_create_daterange').daterangepicker({
    drops: 'down',
    opens: 'right'
  }, function(start, end, label) {
    $('#start').val( start.format('YYYY-MM-DD') + ' 00:00:00');
    $('#end').val( end.format('YYYY-MM-DD') + ' 23:59:59');
  });

  $('#message_create_daterange').daterangepicker({
    drops: 'down',
    opens: 'right'
  }, function(start, end, label) {
    $('#start').val( start.format('YYYY-MM-DD') + ' 00:00:00');
    $('#end').val( end.format('YYYY-MM-DD') + ' 23:59:59');
  });


var editorExists = document.getElementsByClassName('editable');

if(editorExists.length > 0 ){
    var editor = new MediumEditor('.editable', {
        placeholder: {
            text: '',
            hideOnClick: true
        },
        toolbar: {
            /* These are the default options for the toolbar,
               if nothing is passed this is what is used */
            allowMultiParagraphSelection: true,
            buttons: ['bold', 'italic', 'underline', 'anchor', 'h2', 'h3', 'quote'],
            diffLeft: 0,
            diffTop: -10,
            elementsContainer: '.editable',
            firstButtonClass: 'medium-editor-button-first',
            lastButtonClass: 'medium-editor-button-last',
            // relativeContainer: false,
            standardizeSelectionStart: false,
            static: false,
            /* options which only apply when static is true */
            // align: 'center',
            sticky: false,
            updateOnEmptySelection: false
        }
    });
}

$( "#message-form" ).submit(function( event ) {
    var value = $('.editable').html();
    console.log(value);
    $("#body").val(value);
});



//implementiations...
//require('./believer/iCheck.js');
require('./believer/dataTables.bs4.js');
require('./believer/dataTables.js');
// clients
require('./believer/indexClient.js');
require('./believer/deleteClient.js');
require('./believer/editClient.js');
require('./believer/editMission.js');
// rewards
require('./believer/deleteReward.js');
require('./believer/editReward.js');
require('./believer/rewardPublishing.js');
//missions
require('./believer/deleteMission.js');
require('./believer/deleteMissionType.js');
//redemptions
require('./believer/recordRedemption.js');
//invites
require('./believer/uploadInvites.js');
//registration
require('./believer/validateRegistration.js');
//messages
require('./believer/deleteMessage.js');
//manager accounts
require('./believer/createManagerAccount.js');
require('./believer/deleteManagerAccount.js');
// referrals
require('./believer/referrals.js');
