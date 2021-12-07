var paqueterias = js_array;
$( document ).ready(function () {
  var x = 1;
  var maxField = 10;
  var addButton = $(".add_button");
  var wrapper = $(".field_wrapper");
  var fieldHTML =
      '<div class="row"><div class="col-3 w-100"><select name="paqueteria_id[]" class="w-100 myOwnSelect form-control mb-1" required></select></div><div class="col-4 w-100"><input type="text" class="w-100 form-control" name="tiempo_name[]" required></div><div class="col-4 w-100"><input type="text" class="w-100 form-control" name="precio_name[]" required></div><div class="col-1 w-100"><a href="javascript:void(0);" class="remove_button"><i class="fas fa-minus text-body"></i></a></div></div>';
  $(addButton).click(function () {
    console.log(paqueterias);
    if (x < maxField) {
      x++;
      $(wrapper).append(fieldHTML);
    }
    var select = $('.myOwnSelect').last();
    select.empty();
    for (let i = 0; i < paqueterias.length; i++) {
      var el = document.createElement("option");
      el.text = paqueterias[i].paqueteria;
      el.value = paqueterias[i].id;
      select.append(el);
    }


  });

  $(wrapper).on("click", ".remove_button", function (e) {
    e.preventDefault();
    $(this).parent().parent().remove();
    x--;
  });
});

