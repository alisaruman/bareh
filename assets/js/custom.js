// ShareIcon show share ways (posts)
$(document).ready(function () {
  $(".post-item .shareIcon").click(function () {
    if ($(this).hasClass("active")) {
      $(this).children("ul").css("opacity", "0");
      $(this).children("ul").css("visibility", "hidden");
      $(this).removeClass("active");
    } else {
      $(this).children("ul").css("opacity", "1");
      $(this).children("ul").css("visibility", "visible");
      $(this).addClass("active");
    }
  });
});
// ShareIcon show share ways (posts)

// Show post preview on hover (desktop)
$(document).ready(hovController);

function hovController() {
  if (window.innerWidth > 959) {
    $(".post-item .pic").mousemove(function (e) {
      $(this)
        .find("#hov")
        .css({ left: e.pageX - e.pageX / 3 + "px", top: 25 + "%" });
      $(this).find("#hov").show();
    });
    $(".post-item")
      .last()
      .find(".pic")
      .mousemove(function (e) {
        $(this)
          .find("#hov")
          .css({ left: e.pageX - e.pageX / 3 + "px", top: -50 + "%" });
        $(this).find("#hov").show();
      });
    $(".post-item .pic").mouseleave(function () {
      $(this).find("#hov").hide();
    });
  }
};
// Show post preview on hover (desktop)

// filterSec Opener
$("#searchbox #filters").click(function () {
  if ($(this).hasClass("active")) {
    $("#filterSec").removeClass("top-100 py-4");
    $("#filterSec").addClass("top-50 opacity-0 overflow-hidden");
    $("#filterSec").addClass("opacity-0");
    $("#filterSec").addClass("overflow-hidden");
    $("#filterSec").css("visibility", "hidden");
    $("#filterSec").css("height", "0");
    $(this).removeClass("active");
  } else {
    $("#filterSec").addClass("top-100");
    $("#filterSec").removeClass("top-50");
    $("#filterSec").removeClass("opacity-0");
    $("#filterSec").removeClass("overflow-hidden");
    $("#filterSec").addClass("py-4");
    $("#filterSec").css("height", "auto");
    $("#filterSec").css("visibility", "visible");
    $(this).addClass("active");
  }
});
// filterSec Opener

// filterSec filterTitle click event
$(document).ready(function () {
  $("#filterSec .filterTitle").click(function () {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $(this).parent().find(".selectItems").css("max-height", "0px");
      $(this).parent().find(".selectItems").removeClass("p-2");
    } else {
      $(this).addClass("active");
      $(this).parent().find(".selectItems").css("max-height", "300px");
      $(this).parent().find(".selectItems").addClass("p-2");
    }
  });
});
// filterSec filterTitle click event

// FilterSec selectedArea input + item remove itself
$(document).ready(function () {
  $("#filterSec .selectItems .item").click(function () {
    if ($(this).hasClass("clickable")) {
      var itemVal = $(this).html();
      $(this).removeClass("clickable");
      $(this)
        .parent()
        .parent()
        .parent()
        .find(".selectedArea")
        .append(
          "<span class='selectedTag f12 py-1 pe-2 text-gray2 my-1 rounded cursor-pointer d-flex align-items-center'><span>" +
            itemVal +
            "</span><i class='fa-light fa-xmark ms-2 me-3 f16'></i></span>"
        );
    }

    $("#filterSec .selectedArea .selectedTag").click(function () {
      var tagVal = $(this).find("span").html();
      $(this)
        .parent()
        .parent()
        .find(".filterSelect .selectItems .item")
        .each(function () {
          if ($(this).html() == tagVal) {
            $(this).addClass("clickable");
          }
        });
      $(this).remove();
    });
  });
});
// FilterSec selectedArea input + item remove itself

// filterHandler creates hidden inputs for chosen tags + Tag Remover
$(document).ready(function () {
  $("#filterSec #filterRemover").click(function () {
    $("#filterSec .selectedArea .selectedTag").remove();
    $("#filterSec .selectItems .item").addClass("clickable");
  });

  $("#filterSec #filterHandler").click(function () {
    if ($("#filterSec .selectedArea").find(".selectedTag").length > 0) {
      if ($("#filterSec #locationArea .selectedTag").length > 0) {
        $("#searchbox form").append(
          "<select name='locationItems[]' id='locationItems' class='d-none' multiple>"
        );
        $("#filterSec #locationArea .selectedTag").each(function () {
          $("#searchbox form #locationItems").append(
            $('<option selected value="'+$(this).find("span").html()+'"></option>')
          );
        });
      }
      if ($("#filterSec #yearsArea .selectedTag").length > 0) {
        $("#searchbox form").append(
          "<select name='yearsItems[]' id='yearsItems' class='d-none' multiple>"
        );
        $("#filterSec #yearsArea .selectedTag").each(function () {
          $("#searchbox form #yearsItems").append(
            $('<option selected value="'+$(this).find("span").html()+'"></option>')
          );
        });
      }
      if ($("#filterSec #timeArea .selectedTag").length > 0) {
        $("#searchbox form").append(
          "<select name='timeItems[]' id='timeItems' class='d-none' multiple>"
        );
        $("#filterSec #timeArea .selectedTag").each(function () {
          $("#searchbox form #timeItems").append(
            $('<option selected value="'+$(this).find("span").html()+'"></option>')
          );
        });
      }
      $("#filterSec #filterHandler").remove();
      $("#filterSec #filterRemover").remove();
      $("#filterSec #filterButtons").append(
        '<span class="fw-bold text-gray2 text-center">فیلترهای انتخاب شده روی جستجوی شما اعمال شد.</span>'
      );
    }
  });
});
// filterHandler creates hidden inputs for chosen tags + Tag Remover

// category page, cat list boxes click event details
$(document).ready(function () {
  let i = 0;
  $("#categories .box").click(function () {
    $("#categories .box").addClass("choose");
    // if (i <= 3) {
      if ($(this).hasClass("active")) {
        $(this).removeClass("fw-bold bg-white active");
        i--;
      } else {
        $(this).addClass("fw-bold bg-white active");
        i++;
      }
    // }
    // if (i > 3) {
    //   if ($(this).hasClass("active")) {
    //     $(this).removeClass("fw-bold bg-white active");
    //     i--;
    //   }
    // }
    if (i == 0) {
      $("#categories .box").removeClass("choose");
      $("#catHandler #catSend").attr("disabled", "disabled");
      $("#catHandler #catSend").addClass("disablebtn");
      $("#catHandler #catSend").removeClass("strokebtn");
    } else {
      $("#catHandler #catSend").removeAttr("disabled");
      $("#catHandler #catSend").addClass("strokebtn");
      $("#catHandler #catSend").removeClass("disablebtn");
    }
    if($(this).hasClass("active")) {
      $("#catHandler form #cats").append(
        $('<option selected value="'+$(this).find("span").html()+'"></option>')
      );
    }
    else {
      $("#catHandler form #cats option[value='"+$(this).find("span").html()+"']").remove();
    }
  });
});
// category page, cat list boxes click event details

// Copy post link button 
$("#linkCopier").click(function() {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(this).attr("data-val")).select();
  document.execCommand("copy");
  $temp.remove();
  alert("لینک پست در حافظه شما ذخیره شد.");
});
// Copy post link button 

// Report  bug click event (Show report form)
$("#reportBug").click(function() {
  if($(this).hasClass("active")) {
    $("#reportForm").fadeOut();
    $(this).removeClass("active");
  }
  else {
    $("#reportForm").fadeIn();
    $(this).addClass("active");
  }
})
// Report  bug click event (Show report form)
