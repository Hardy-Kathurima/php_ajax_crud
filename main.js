$(document).ready(function () {
  $("#form").submit(function (e) {
    e.preventDefault();

    var inputs = $(this).serialize();

    $.post("views/add.php", inputs, function (data) {
      alert(data);
      $(".content").load("views/refresh.php", function () {
        $(".total-contribution img").show(500);
      });
    });
  });
});
