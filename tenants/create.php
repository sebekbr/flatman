<?php
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Dodaj najemcę</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="name">Imię</label>
                          <input type="text" class="form-control" id="name" placeholder="Jan">
                        </div>
                        <div class="form-group">
                          <label for="surname">Nazwisko</label>
                          <input type="text" class="form-control" id="surname" placeholder="Nowak">
                        </div>
                        <div class="form-group">
                          <label for="surname">Ulica</label>
                          <input type="text" class="form-control" id="address" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="surname">Kod pocztowy</label>
                          <input type="text" class="form-control" id="postalcode" placeholder="_ _ - _ _ _">
                        </div>
                        <div class="form-group">
                          <label for="phone">Telefon</label>
                          <input type="text" class="form-control" id="postalcode" placeholder="555-555-555 lub (86)218-99-99">
                        </div>
                        <div class="form-group">
                          <label for="email">E-mail</label>
                          <input type="text" class="form-control" id="email" placeholder="landlord@flatman.pl">
                        </div>
                        <div class="form-group">
                          <label for="comments">Uwagi</label>
                          <input type="textarea" name="comments" class="form-control" id="comments" placeholder="">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="AddTenant()" value="Zapisz"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
  include('../master.php');
?>
<script>
  function AddTenant(){
        $.ajax(
        {
            type: "POST",
            url: '../api/tenant/create.php',
            dataType: 'json',
            data: {
                name: $("#name").val(),
                surname: $("#surname").val(),
                address: $("#address").val(),
                postalcode: $("#address").val(),
                city: $("#city").val(),
                phone: $("#phone").val(),
                email: $("#email").val(),
                comments: $("#surname").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Najemca dodany");
                    window.location.href = '/sb/flatman/tenants';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>
