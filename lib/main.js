'use strict';

document.addEventListener('DOMContentLoaded', function () {
  console.log('What u doing looking here');
});

var searchOpen = false;
var formOpen = false;

$(".search-btn").on('click', function () {
  $(this).html($(this).html() == 'close' ? 'search' : 'close');
  if (!$(".form-bar").hasClass("hidden")) {
    $(".form-bar").addClass("hidden");
  } else {
    $(".form-bar").removeClass("hidden");
  }
  searchOpen = !searchOpen;
});

$(document).keydown(function (e) {
  if (e.keyCode === 27) {
    if (searchOpen === true) {
      $(".search-btn").html("search");
      $(".form-bar").removeClass("hidden");
      searchOpen = !searchOpen;
    }
  }
});

$("#create-listing").click(function (e) {
  e.preventDefault();
  if (formOpen === false) {
    $(this).addClass("active");
    $(".js-listing-form").slideDown();
    $(".marquee").addClass("invert");
  } else {
    $(this).removeClass("active");
    $(".js-listing-form").slideUp();
    $(".marquee").removeClass("invert");
  }
  formOpen = !formOpen;
});

$(".form-bar input").focus(function (e) {
  $(".js-hidden-form").slideDown();
  $("#js-expand").html("-");
});

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

$(".menu-tags a").on("click", function (e) {
  e.preventDefault();
  $(".menu-tags a").not($(this)).removeClass('active');
  console.log($(this).attr("href"));
  if (!$(this).hasClass("active")) {
    $(this).addClass("active");
    $.get($(this).attr("href"), function (data) {
      $('#upcoming-posts').html(data);
    });
  } else {
    $(this).removeClass("active");
    $.get('/', { s: "" }, function (data) {
      $('#upcoming-posts').html(data);
    });
  }
});