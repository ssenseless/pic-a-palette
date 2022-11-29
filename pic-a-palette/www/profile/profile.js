$(document).ready(function () {
  $("#signout").click(function (event) {
    event.preventDefault();

    $.ajax({
      type: "GET",
      url: "../../secure/functions/session_breakdown.php",
      success: function () {
        window.location.href = "../home/index.html";
        console.log("successfully signed out");
      },
    });
  });
});
