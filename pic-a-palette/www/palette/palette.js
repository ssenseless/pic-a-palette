var flag = false;

$("#document").ready(function () {
  var rand;
  load_palette();

  $("#yes_button").click(function (event) {
    event.preventDefault();

    $.ajax({
      type: "POST",
      url: "../../secure/functions/pic_a_palette.php",
      data: {
        src: rand,
      },
      dataType: "json",
      success: function (retval) {
        cycle_picture();
        attach_color(retval);
      },
    });
  });

  $("#no_button").click(function (event) {
    event.preventDefault();

    cycle_picture();
  });

  $("#save").click(function (event) {
    event.preventDefault();

    $.ajax({
      type: "POST",
      url: "../../secure/functions/save_name.php",
      data: {
        name: $(".paletteName").val(),
      },
      success: function () {
        flag = true;
      },
    });
  });

  $("#back").click(function (event) {
    event.preventDefault();

    $.ajax({
      type: "POST",
      data: {
        type: 1,
      },
      url: "../../secure/functions/unset.php",
      success: function (retval) {
        window.location.href = "../profile/index.html";
        console.log(retval);
      },
    });
  });

  $("#cancel").click(function (event) {
    event.preventDefault();

    if (flag) {
      $.ajax({
        type: "POST",
        data: {
          type: 1,
        },
        url: "../../secure/functions/unset.php",
        success: function (retval) {
          window.location.href = "../profile/index.html";
        },
      });
    } else {
      $.ajax({
        type: "POST",
        url: "../../secure/functions/delete_row.php",
        success: function () {
          window.location.href = "../profile/index.html";
        },
      });
    }
  });

  function cycle_picture() {
    rand = ("00" + Math.floor(Math.random() * 91 + 1)).slice(-3);
    $("#photobucket").attr(
      "src",
      "../../secure/data/permanent/" + rand + ".jpg"
    );
  }

  function load_palette() {
    console.log("yes");
    $.ajax({
      type: "GET",
      url: "../../secure/functions/load_palette.php",
      dataType: "json",
      success: function (retval) {
        cycle_picture();
        if (retval != 0) {
          attach_color(retval);
        }
      },
    });
  }

  function attach_color(retval) {
    $("#dot1").css({ "background-color": retval.a });
    $("#dot2").css({ "background-color": retval.b });
    $("#dot3").css({ "background-color": retval.c });
    $("#dot4").css({ "background-color": retval.d });
    $("#dot5").css({ "background-color": retval.e });
    $("#dot6").css({ "background-color": retval.f });

    $("#hex1").html(retval.a);
    $("#hex2").html(retval.b);
    $("#hex3").html(retval.c);
    $("#hex4").html(retval.d);
    $("#hex5").html(retval.e);
    $("#hex6").html(retval.f);
  }
});
