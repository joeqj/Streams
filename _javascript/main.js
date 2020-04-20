document.addEventListener('DOMContentLoaded', () => {
  console.log('What u doing looking here');
});

var searchOpen = false;
var formOpen = false;

$(".search-btn").on('click', function() {
  $(this).html($(this).html() == 'close' ? 'search' : 'close');
  if (!$(".form-bar").hasClass("hidden")) {
    $(".form-bar").addClass("hidden");
  } else {
    $(".form-bar").removeClass("hidden");
  }
  searchOpen = !searchOpen;
});

$(document).keydown(function(e) {
  if (e.keyCode === 27) {
    if (searchOpen === true) {
      $(".search-btn").html("search");
      $(".form-bar").removeClass("hidden");
      searchOpen = !searchOpen;
    }
  }
});

$("#js-expand").click(function(e) {
  e.preventDefault();
  if (formOpen === false) {
    $(".js-hidden-form").slideDown();
    $("#js-expand").html("-");
  } else {
    $(".js-hidden-form").slideUp();
    $("#js-expand").html("+");
  }
  formOpen = !formOpen;
});

$(".form-bar input").focus(function(e) {
  $(".js-hidden-form").slideDown();
  $("#js-expand").html("-");
});

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
  console.log($(this).attr("href"));
  $.get( $(this).attr("href"), function( data ){
      $('#upcoming-posts').html(data);
  });
});
