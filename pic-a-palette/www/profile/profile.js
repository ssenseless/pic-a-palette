$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "../../secure/functions/retrieve_palette_rows.php",
    dataType: "json",
    success: function (retval) {
      if (retval != 0) {
        for (const key of retval) {
          $("#bigbox").append(`
                              <!-- This is the row -->
                              <div class="Grid" id="box${key.paletteid}">
                                <div class="C1">
                                  <div class="Name">Name:</div>
                                  <div id="name">${key.name}</div>
                                </div>
                                <div class="CC">
                                  <div class="dot" style="background-color:${key.a}"></div>
                                  <div class="HexN" id="hex1">${key.a}</div>
                                </div>
                                <div class="CC">
                                  <div class="dot" style="background-color:${key.b}"></div>
                                  <div class="HexN" id="hex2">${key.b}</div>
                                </div>
                                <div class="CC" id="dot3">
                                  <div class="dot" style="background-color:${key.c}"></div>
                                  <div class="HexN" id="hex3">${key.c}</div>
                                </div>
                                <div class="CC" id="dot4">
                                  <div class="dot" style="background-color:${key.d}"></div>
                                  <div class="HexN" id="hex4">${key.d}</div>
                                </div>
                                <div class="CC" id="dot5">
                                  <div class="dot" style="background-color:${key.e}"></div>
                                  <div class="HexN" id="hex5">${key.e}</div>
                                </div>
                                <div class="CC" id="dot6">
                                  <div class="dot" style="background-color:${key.f}"></div>
                                  <div>
                                    <div class="HexN" id="hex6">${key.f}</div>
                                  </div>
                                </div>
                                <div class="C7">
                                  <button class="gridButtonEdit" id="${key.paletteid}" type="button">Edit</button>
                                  <button class="gridButtonsDelete" id="${key.paletteid}" type="button">Delete</button>
                                </div>
                              </div>
                              <!-- End of roow -->`);
        }
      }
    },
  });

  $.ajax({
    type: "GET",
    url: "../../secure/functions/retrieve_username.php",
    success: function (retval) {
      $("#userhere").html(`Welcome ${retval}`);
    },
  });

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

  $("#create_palette").click(function (event) {
    event.preventDefault();

    $.ajax({
      type: "POST",
      url: "../../secure/functions/retrieve_palette_id.php",
      success: function (retval) {
        if (retval == -1) {
          alert("Too many palettes! Delete a palette before continuing.");
        } else {
          window.location.href = "../palette/index.html";
        }
      },
    });
  });

  $("#bigbox").on("click", ".gridButtonEdit", function (event) {
    event.preventDefault();

    $.ajax({
      type: "POST",
      data: {
        paletteid: event.target.id,
      },
      url: "../../secure/functions/set_palette_id.php",
      success: function () {
        window.location.href = "../palette/index.html";
      },
    });
  });

  $("#bigbox").on("click", ".gridButtonsDelete", function (event) {
    event.preventDefault();

    $.ajax({
      type: "POST",
      data: {
        paletteid: event.target.id,
      },
      url: "../../secure/functions/delete_row.php",
      success: function () {
        $(`#box${event.target.id}`).remove();
      },
    });
  });
});
