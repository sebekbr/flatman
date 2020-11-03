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
                      <div class="form-group">
                        <label for="phone">Telefon</label>
                        <input type="text" class="form-control" id="postalcode" placeholder="555-555-555 lub (86)218-99-99">
                      </div>
                      <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" class="form-control" id="email" placeholder="landlord@flatman.pl">
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
                        <input type="button" class="btn btn-primary" onClick="UpdateHouseAssociation()" value="Aktualizuj"></input>
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
            url: "../api/houseassociation/read_single.php?id=<?php echo $_GET['id']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#name').val(data['name']);
                $('#address').val(data['address']);
                $('#postalcode').val(data['postalcode']);
                $('#city').val(data['city']);
                $("#comments").val(data['comments']);
            },
            error: function (result) {
                console.log(result);
            },
        });
    });
    function UpdateHouseAssociation(){
        $.ajax(
        {
            type: "POST",
            url: '../api/houseassociation/update.php',
            dataType: 'json',
            data: {
                id: <?php echo $_GET['id']; ?>,
                name: $("#name").val(),
                address: $('#address').val(),
                postalcode: $("#postalcode").val(),
                city: $("#city").val(),
                comments: $("#comments").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Zaktualizowano dane instytucji");
                    window.location.href = '/sb/flatman/houseassociations';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>
