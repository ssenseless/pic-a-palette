$(document).ready(function () {
  var home_color_timeout;
  var home_picture_timeout;

  (function random_picture() {
    clearTimeout(home_color_timeout);
    var rand = ("00" + Math.floor(Math.random() * 91 + 1)).slice(-3);

    $("#photo").attr("src", "../../secure/data/permanent/" + rand + ".jpg");

    (function home_color() {
      $.ajax({
        type: "POST",
        data: {
          src: $("#photo").attr("src"),
        },
        url: "../../secure/functions/get_home_color.php",
        dataType: "json",
        success: function (retval) {
          $("#dot1").css({ "background-color": retval.a });
          $("#dot2").css({ "background-color": retval.b });
          $("#dot3").css({ "background-color": retval.c });
          $("#dot4").css({ "background-color": retval.d });
          $("#dot5").css({ "background-color": retval.e });
          $("#dot6").css({ "background-color": retval.f });

          $("#hex1").html(`${retval.a}`);
          $("#hex2").html(`${retval.b}`);
          $("#hex3").html(`${retval.c}`);
          $("#hex4").html(`${retval.d}`);
          $("#hex5").html(`${retval.e}`);
          $("#hex6").html(`${retval.f}`);
        },
      });

      home_color_timeout = setTimeout(function () {
        home_color();
      }, 1999);
    })();

    home_picture_timeout = setTimeout(random_picture, 10000);
  })();

  $("#login").click(function (event) {
    event.preventDefault();

    $.ajax({
      type: "POST",
      data: {
        username: $("#username").val(),
        password: $("#password").val(),
      },
      url: "../../secure/functions/login.php",
      success: function (retval) {
        if (retval == 1) {
          window.location.href = "../profile/index.html";
        } else {
          alert("Login credentials invalid!");
          $("#username").val("");
          $("#password").val("");
        }
      },
    });
  });

  $("#register").click(function (event) {
    event.preventDefault();

    $.ajax({
      type: "POST",
      data: {
        username: $("#username").val(),
        password: $("#password").val(),
      },
      url: "../../secure/functions/register.php",
      success: function (retval) {
        switch (parseInt(retval)) {
          case 0:
            alert("Something went wrong. Try again.");
            $("#username").val("");
            $("#password").val("");
            break;
          case 1:
            window.location.href = "../profile/index.html";
            break;
          case 2:
            alert("Username already exists! Please choose a new username.");
            $("#username").val("");
            $("#password").val("");
        }
      },
    });
  });

  $("#about").click(function (event) {
    event.preventDefault();

    window.location.href = "../about/index.html";
  });
});
