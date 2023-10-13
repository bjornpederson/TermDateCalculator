$(document).ready(function () {
var $formData;

function validateContact() {
  var valid = true;	
  if(!$("#term").val()) {
      $("#term").html("(required)");
      $("#term").css('background-color','#FFFFDF');
      valid = false;
  }
  if(!$("#firstDay").val()) {
      $("#firstDay").html("(required)");
      $("#firstDay").css('background-color','#FFFFDF');
      valid = false;
  }
  
  return valid;
}

$("#submitButton", 'form').on('click.submit', function(event){
  event.preventDefault();
  var $goodData = validateContact();
  if ($goodData){
      $formData = $('#inputFormData').serialize();
      $.ajax({
        type: 'POST',
        url: "post_cal.php",
        data: $formData
      }).done(function (data) {
        $('#result').html(data);
        $('#datesAndInfo').modal('show');
      });
  }
  ;
})

$('#datesAndInfo').on('hidden.bs.modal', function (event) {
  $('#result').empty();
})
function toggleHolidayFields() {
  var holidayFields = $("#holiday-fields");
  var isHidden = holidayFields.hasClass("hidden");

  if (isHidden) {
    holidayFields.removeClass("hidden");
  } else {
    holidayFields.addClass("hidden");
    $("#holidayName").val('');
    $("#holidayStart").val('');
  }
}

$('input[type="checkbox"]').change(function () {
  
  toggleHolidayFields();
});

$('#resetButton', '.button-container').on('click.close', function(e){
  $("#term").val('')
  $("#firstDay").val('');
  $("#numWeeks").val('14');
  $('#appt').val('23:55');
  $("#holidayToggle").prop('checked', false);
  if (!$("#holiday-fields").hasClass('hidden')){
    $("#holiday-fields").addClass("hidden");
    $("#holidayName").val('');
    $("#holidayStart").val('');
  }
  $("#result").empty();
})

});