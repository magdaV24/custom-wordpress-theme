$(document).ready(function () {
    const themeButton = $("#theme-button");

    const currentScheme = themeData.color_scheme;
    const newScheme = currentScheme === "one" ? "two" : "one";
    
    const ajax_url = themeData.ajax_url;

    themeButton.click(function () {
      $.ajax({
        url: ajax_url,
        type: "post",
        data: {
          action: "update_color_scheme",
          color_scheme: newScheme,
        },
        success: function (response) {
          console.log("Theme updated successfully.");
          location.reload();
        },
        error: function (xhr, status, error) {
          console.error("Error updating theme: ", error);
        },
      });
    });
});
