$(document).ready(function () {
  $.ajax({
    type: "GET",
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
});
