document.addEventListener('DOMContentLoaded', () => {
  console.log('What u doing looking here');
});

var formOpen = false;
var searchOpen = false;

$(document).keydown(function(e) {
  if (e.keyCode === 27) {

  }
});

$("#create-listing").click(function(e) {
  e.preventDefault();
  var scroll = window.pageYOffset
  if (formOpen === false) {
    $(document).bind('scroll',function () {
      window.scrollTo(0, scroll);
    });
    $(this).addClass("active");
    $(this).text("(-) Online Event");
    $(".js-listing-form").slideDown();
    $(".marquee").addClass("invert");
    $('input.timepicker').timepicker({
      timeFormat: "hh:mm p",
      zindex: 1001,
      startTime: new Date(0,0,0,19,0,0)
    });
    $('input.datepicker').datepicker({
      inline: false,
      format: 'dd/mm/yyyy'
    });
  } else {
    $(document).unbind('scroll');
    $(this).removeClass("active");
    $(this).text("(+) Online Event");
    $(".js-listing-form").slideUp();
    $(".marquee").removeClass("invert");
  }
  formOpen = !formOpen;
});

$("form[name='listing-form']").validate({   //#register-form is form id
     // Specify the validation rules
     rules: {
         event_host: "required", //firstname is corresponding input name
         event_email: {               //email is corresponding input name
             required: true,
             email: true
         },
         event_country: "required",
         event_name: "required",
         event_time: "required",
         event_date: "required",
         event_type: "required",
         event_url: "required",
         event_language: "required",
         event_description: "required"
     },
     // Specify the validation error messages
     messages: {
         event_host: "Host",
         event_email: "Your Email",
         event_country: "Country",
         event_name: "Event Name",
         event_time: "07:00 PM",
         event_date: dateFormat(new Date(), "dd/mm/yyyy"),
         event_type: "Event Type",
         event_url: "Stream URL",
         event_language: "Event Language",
         event_description: "Tell us about your event"
     },
     errorPlacement: function (error, element) {
    element.attr("placeholder", error[0].outerText);
},
     submitHandler: function(form) {
         form.submit();
     }
 });

// SEARCH AJAX BELOW

$('#searchfield').on("change paste keyup", function(e){
  if ($(this).val().length >= 3) {
    var term = $(this).val();
    $.get( '/', { s: term }, function( data ){
        $('#upcoming-posts').html(data);
    });
  } else {
    $.get( '/', { s: "" }, function( data ){
        $('#upcoming-posts').html(data);
    });
  }
});

$(".menu-tags a").on("click", function(e) {
  e.preventDefault();
  $(".menu-tags a").not($(this)).removeClass('active');
  console.log($(this).attr("href"));
  if (!$(this).hasClass("active")) {
    $(this).addClass("active");
    $.get( $(this).attr("href"), function( data ){
        $('#upcoming-posts').html(data);
    });
  } else {
    $(this).removeClass("active");
    $.get( '/', { s: "" }, function( data ){
        $('#upcoming-posts').html(data);
    });
  }
});
