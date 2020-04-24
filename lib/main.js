'use strict';

document.addEventListener('DOMContentLoaded', function () {
  console.log('What u doing looking here');
});

var formOpen = false;
var searchOpen = false;

$(document).keydown(function (e) {
  if (e.keyCode === 27) {}
});

$('#list-item').on("mouseenter mouseleave", function (e) {
  if (e.type == "mouseenter") {
    console.log(e.type);
    $(this).find(".marquee.listing").slideDown();
  } else {
    console.log(e.type);
    $(this).find(".marquee.listing").slideUp();
  }
});

$("#create-listing").click(function (e) {
  e.preventDefault();
  var scroll = window.pageYOffset;
  if (formOpen === false) {
    $(document).bind('scroll', function () {
      window.scrollTo(0, scroll);
    });
    $(this).addClass("active");
    $(this).text("(-) Online Event");
    $(".js-listing-form").slideDown();
    $(".marquee.main").addClass("invert");
    $('input.timepicker').timepicker({
      timeFormat: "hh:mm p",
      zindex: 1001,
      startTime: new Date(0, 0, 0, 19, 0, 0)
    });
    $('input.datepicker').datepicker({
      inline: false,
      format: 'dd/mm/yyyy'
    });
    $('.marquee.navigation').html('<div class="left"><p> TODAYS SUPPLY is a directory for online events across the arts, design, creative world. Submit your event using the form above!</p></div><div class="right"><p> TODAYS SUPPLY is a directory for online events across the arts, design, creative world. Submit your event using the form above!</p></div>');
  } else {
    $(document).unbind('scroll');
    $(this).removeClass("active");
    $(this).text("(+) Online Event");
    $(".js-listing-form").slideUp();
    $(".marquee.main").removeClass("invert");
    $('.marquee.navigation').html("");
  }
  formOpen = !formOpen;
});

$(".datepicker").on("change", function () {
  console.log($(".timepicker").val());
  var from = $(this).val().split("/");
  var date = [from[2], from[1], from[0]].join('-');
  $(".timestamp-h").val(date);
});

$("form[name='listing-form']").validate({ //#register-form is form id
  // Specify the validation rules
  rules: {
    event_host: "required", //firstname is corresponding input name
    event_email: { //email is corresponding input name
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
  errorPlacement: function errorPlacement(error, element) {
    element.attr("placeholder", error[0].outerText);
  },
  submitHandler: function submitHandler(form) {
    form.submit();
  }
});

// SEARCH AJAX BELOW

$('#searchfield').on("change paste keyup", function (e) {
  if ($(this).val().length >= 3) {
    var term = $(this).val();
    $.get('/', { s: term }, function (data) {
      $('#upcoming-posts').html(data);
    });
  } else {
    $.get('/', { s: "" }, function (data) {
      $('#upcoming-posts').html(data);
    });
  }
});