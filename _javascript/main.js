document.addEventListener('DOMContentLoaded', () => {
  console.log('What u doing looking here');
  $("#main-marquee").marquee({
    duration: 15000,
    gap: 12,
    delayBeforeStart: 0,
    direction: 'left',
    duplicated: true,
    startVisible: true
  });
  $([document.documentElement, document.body]).animate({
    scrollTop: $('#list-item:not(.archive):first').offset().top
  }, 100);
  // Honeypot
  $('.text-field').hide();
});

var formOpen = false;
var searchOpen = false;
var infoOpen = false;
var isMobile = false;
var lastScroll = 0;
var nextPage = 2;
var isRan = false;
var isSearch = false;

// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
    isMobile = true;
}

// location handling
var input = document.getElementById('gLoc');
var options = {
  types: ['(cities)']
};

var autocomplete = new google.maps.places.Autocomplete(input, options);

var componentForm = {
  route: 'long_name',
  locality: 'long_name',
  city: 'long_name',
  country: 'short_name'
};

var locArray = [];

google.maps.event.addListener(autocomplete, 'place_changed', function () {
  locArray = [];
  var place = autocomplete.getPlace();
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      locArray[componentForm[addressType]] = [];
      locArray[componentForm[addressType]].push(val);
    }
  }
  locArray["utc_offset"] = [];
  locArray["utc_offset"].push(place.utc_offset_minutes);
});

// Infinite Scroll
function loadMoreStreams(today, ajaxurl) {
  if(isSearch === false && isRan === false) {
    isRan = true;
    $.ajax({
      url : ajaxurl,
      type : 'post',
      data : {
        page : nextPage,
        today : today,
        action : 'load_more_streams'
      },
      error : function(response) {
        console.warn(response);
      },
      success : function(response) {
        nextPage++;
        $('#upcoming-posts').append(response);
        revealPosts(250);
      }
    });
  }
}

function revealPosts(time) {
  var posts = $("#list-item:not(.reveal)");
  var i = 0;
  setInterval(function() {
    if (i >= posts.length) return false;
    var el = posts[i];
    $(el).addClass("reveal");
    i++;
  }, time);
  isRan = false;
}

$.validator.addMethod('validUrl', function(value, element) {
  var url = $.validator.methods.url.bind(this);
  return url(value, element) || url('https://' + value, element);
}, 'Stream URL');

$("form[name='listing-form']").validate({
  rules: {
    event_host: "required",
    event_email: {
      required: true,
      email: true
    },
    event_loc_c: "required",
    event_name: "required",
    frontend_time: "required",
    frontend_date: "required",
    event_type: "required",
    event_url: { required: true, validUrl: true },
    event_language: "required",
    event_description: "required"
  },
  messages: {
    event_host: "Host",
    event_email: "Your Email",
    event_loc_c: "Enter a location",
    event_name: "Event Name",
    frontend_time: "12:00",
    frontend_date: moment().format("DD/MM/YYYY"),
    event_type: "Event Type",
    event_url: "Stream URL",
    event_language: "Event Language",
    event_description: "Tell us about your event"
  },
  errorPlacement: function(error, element) {
    element.attr("placeholder", error[0].outerText);
  }
});

$("form[name='listing-form']").submit(function(event) {
  var isvalid = $(this).valid();
  var form = $(this);
  var url = form.attr('action');

  if (isvalid) {
    event.preventDefault();
    var date;
    var from = $('.datepicker').val().split("/");
    var date = [from[2], from[1], from[0]].join('-');
    var time = $('.timepicker').val();
    if (locArray["long_name"] && locArray["long_name"] && locArray["long_name"] && locArray["utc_offset"]) {
      date = moment(date + " " + time, "YYYY-MM-DD HH:mm").utc().utcOffset(locArray["utc_offset"]);
      $("#timestamp-h").val(date.format("YYYY-MM-DD HH:mm"));
      $("input[name='event_date']").val(date.format("YYYY-MM-DD"));
      $("input[name='event_time']").val(date.format("HH:mm"));
      $("input[name='event_city']").val(locArray["long_name"]);
      if (locArray["short_name"].toString() === "GB") {
        $("input[name='event_country']").val("UK");
      } else {
        $("input[name='event_country']").val(locArray["short_name"]);
      }
    }

    $.ajax({
       type: "POST",
       url: url,
       data: form.serialize(),
       success: function(data) {
         $("form[name='listing-form']").trigger("reset");
         $('.marquee.navigation').html('<p class="success">GREAT! ~ We will approve your listing soon. To edit, email: <a href="mailto:team@todays.supply">team@todays.supply</a></p>');
         $(".marquee.navigation").marquee({
           duration: 15000,
           gap: 0,
           delayBeforeStart: 0,
           direction: 'left',
           duplicated: true
         });
       },
       error:function(data) {
         console.warn("You have been detected as a spammer, please kindly fuck off.");
       }
     });
   }
});

// CREATE
$("#js-open-create-listing").click(function(e) {
  e.preventDefault();
  if (formOpen === false) {
    toggleCreateListing("open");
  } else {
    toggleCreateListing("close");
  }
  if (infoOpen === true) {
    toggleInfo("close");
  }
  if (searchOpen === true) {
    toggleSearch("close");
  }
});

// INFO
$("#js-open-info").click(function(e) {
  if (infoOpen === false) {
    toggleInfo("open");
  } else {
    toggleInfo("close");
  }
  if (formOpen === true) {
    toggleCreateListing("close");
  }
  if (searchOpen === true) {
    toggleSearch("close");
  }
});

// SEARCH
$("#js-open-search").click(function(e) {
  if (searchOpen === false) {
    toggleSearch("open");
  } else {
    toggleSearch("close");
  }
  if (formOpen === true) {
    toggleCreateListing("close");
  }
  if (infoOpen === true) {
    toggleInfo("close");
  }
});

$("#searchform").submit(function(e) {
  e.preventDefault();
});

$('#searchfield').on("change paste keyup", function(e) {
  if ($(this).val().length >= 3) {
    var term = $(this).val();
    $.get('/', {
      s: term
    }, function(data) {
      $('#upcoming-posts').html(data);
      isSearch = true;
    });
  } else {
    $.get('/', {
      s: ""
    }, function(data) {
      $('#upcoming-posts').html(data);
      isSearch = false;
    });
  }
});

$("#searchform span").click(function(){
  $("#searchfield").val('');
  $(".cat-filter").removeClass("active");
  $.get('/', {
    s: ""
  }, function(data) {
    $('#upcoming-posts').html(data);
    isSearch = false;
  });
});

$('.cat-filter').on("click", function(e) {
  e.preventDefault();
  $(this).toggleClass("active");
  $(".cat-filter").not($(this)).removeClass('active');
  if ($(this).hasClass("active")) {
    var category = $(this).attr("href");
    $.get('/', {
      s: category
    }, function(data) {
      $('#upcoming-posts').html(data);
      isSearch = true;
    });
  } else {
    $.get('/', {
      s: ""
    }, function(data) {
      $('#upcoming-posts').html(data);
      isSearch = true;
    });
  }
});

// Keyboard shortcuts
$(document).keydown(function(e) {
  if (e.keyCode === 27) {
    if (searchOpen === true) {
      toggleSearch("close");
    }
    if (formOpen === true) {
      toggleCreateListing("close");
    }
    if (infoOpen === true) {
      toggleInfo("close");
    }
  }
  if (e.keyCode === 13) {
    if (searchOpen === true) {
      toggleSearch("close");
    }
  }
});

// --- FUNCTIONS ---
// function listItemUrlBanner(event, that, uid, url, source) {
//   var banner = $(that).find(".url-banner");
//   var marqueeId = "list-marquee" + uid;
//   var marqueeEl;
//   if(event.type == "mouseenter") {
//     banner.html('<div id="list-marquee' + uid + ' class="marquee listing active"><span>*** Watch Now On ' + source + '&nbsp;</span></div>');
//     banner.slideDown(200);
//     marqueeEl = new Marquee(marqueeId, { direction: 'ltr', speed: 0.2, offset: '400px' });
//   } else {
//     banner.slideUp(200, function() {
//       banner.html("");
//     });
//     marqueeEl = null;
//   }
// }

function toggleCreateListing(state) {
  formOpen = !formOpen;
  var scroll = window.pageYOffset;
  if (state === "open") {
    if (isMobile === false) {
      $(document).bind('scroll', function() {
        window.scrollTo(0, scroll);
      });
    }
    $("#js-open-create-listing").addClass("active");
    $("#js-open-create-listing").text("(-) Online Event");
    $(".js-listing-form").slideDown();
    $(".marquee.main").addClass("invert");
    $('input.timepicker').timepicker({
      timeFormat: "HH:mm",
      zindex: 1001,
      startTime: new Date(0, 0, 0, 12, 0, 0)
    });
    $('input.datepicker').datepicker({
      inline: false,
      format: 'dd/MM/yyyy'
    });
    $('.marquee.navigation').html('<p>TODAYS SUPPLY is a directory for online events across the arts, design, creative world. Submit your event using the form above!</p>');
    $(".marquee.navigation").marquee({
      duration: 15000,
      gap: 0,
      delayBeforeStart: 0,
      direction: 'left',
      duplicated: true
    });
  } else {
    if (isMobile === false) {
      $(document).unbind('scroll');
    }
    $("#js-open-create-listing").removeClass("active");
    $("#js-open-create-listing").text("(+) Online Event");
    $(".js-listing-form").slideUp();
    $(".marquee.main").removeClass("invert");
    $('.marquee.navigation').html("");
    $(".marquee.navigation").marquee("DESTROY");
  }
}

function toggleSearch(state) {
  if (state === "open") {
    $("#js-open-search").addClass("active");
    $(".js-search").slideDown();
    $(".marquee.main").fadeOut();
  } else {
    $("#js-open-search").removeClass("active");
    $(".js-search").slideUp();
    $(".marquee.main").fadeIn();
  }
  searchOpen = !searchOpen;
}

function toggleInfo(state) {
  if (state === "open") {
    $("#js-open-info").addClass("active");
    $(".js-info").slideDown();
    $(".marquee.main").addClass("invert");
  } else {
    $("#js-open-info").removeClass("active");
    $(".js-info").slideUp();
    $(".marquee.main").removeClass("invert");
  }
  infoOpen = !infoOpen;
}
