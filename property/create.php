<?php
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Dodaj nieruchomość</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="name">Nazwa</label>
                          <input type="text" class="form-control" id="name" placeholder="Wprowadź nazwę">
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
                          <input type="text" class="form-control" id="city" placeholder="Miejscowość">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="AddProperty()" value="Zapisz"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
  include('../master.php');
?>
<script>
  function AddProperty(){
        $.ajax(
        {
            type: "POST",
            url: '../api/property/create.php',
            dataType: 'json',
            data: {
                name: $("#name").val(),
                address: $("#address").val(),
                postalcode: $("#postalcode").val(),
                city: $("#city").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Nieruchomość dodana");
                    window.location.href = '/sb/flatman/property';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>
