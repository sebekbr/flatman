<?php
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Aktualizacja danych nieruchomości</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="name">Nazwa</label>
                          <input type="text" class="form-control" id="name" placeholder="Wpowadź nazwę">
                        </div>
                        <div class="form-group">
                          <label for="address">Adres</label>
                          <input type="text" class="form-control" id="address" placeholder="Ulica">
                        </div>
                        <div class="form-group">
                          <label for="postalcode">Kod pocztowy</label>
                          <input type="text" class="form-control" id="postalcode" placeholder="_ _ - _ _ _">
                        </div>
                        <div class="form-group">
                          <label for="city">Miejscowość</label>
                          <input type="text" class="form-control" id="city" placeholder="np. Warszawa">
                        </div>
                        <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="UpdateProperty()" value="Aktualizuj"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';

  include('../master.php');
?>
<script>
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "../api/property/read_single.php?id=<?php echo $_GET['id']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#name').val(data['name']);
                $('#address').val(data['address']);
                $('#postalcode').val(data['postalcode']);
                $('#city').val(data['city']);
            },
            error: function (result) {
                console.log(result);
            },
        });
    });
    function UpdateProperty(){
        $.ajax(
        {
            type: "POST",
            url: '../api/property/update.php',
            dataType: 'json',
            data: {
                id: <?php echo $_GET['id']; ?>,
                name: $("#name").val(),
                address: $('#address').val(),
                postalcode: $("#postalcode").val(),
                city: $("#city").val(),
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Zaktualizowano dane nieruchomości");
                    window.location.href = '/sb/flatman/property';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>
