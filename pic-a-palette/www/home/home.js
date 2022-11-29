<<<<<<< Updated upstream
=======
$(document).ready(function () {
  (function random_picture() {
    var rand = ("00" + Math.floor(Math.random() * 91 + 1)).slice(-3);
    var count = 1;

    $("#photo").attr("src", "../../secure/data/permanent/" + rand + ".jpg");

    (function home_color(count) {
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
        },
      });

      count++;

      if (count < 6) {
        var home_color_timeout = setTimeout(function () {
          home_color(count);
        }, 999);
      } else {
        clearTimeout(home_color_timeout);
      }
    })(count);

    setTimeout(random_picture, 15000);
  })();
});
>>>>>>> Stashed changes
