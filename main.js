$(document).ready(function () {
  $("#form").submit(function (e) {
    e.preventDefault();

    var inputs = $(this).serialize();

    $.post("views/add.php", inputs, function () {
      $(".content").load("views/refresh.php");
    });
  });
});
