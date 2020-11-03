<?php
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Aktualizacja właściciela</h3>
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
                          <label for="phone">Telefon</label>
                          <input type="text" class="form-control" id="postalcode" placeholder="555-555-555 lub (86)218-99-99">
                        </div>
                        <div class="form-group">
                          <label for="email">E-mail</label>
                          <input type="text" class="form-control" id="email" placeholder="landlord@flatman.pl">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="UpdateLandlord()" value="Zapisz"></input>
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
            url: "../api/landlord/read_single.php?id=<?php echo $_GET['id']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#name').val(data['name']);
                $('#surname').val(data['surname']);
                $('#phone').val(data['phone']);
                $('#email').val(data['email;']);
            },
            error: function (result) {
                console.log(result);
            },
        });
    });
    function UpdateLandlord(){
        $.ajax(
        {
            type: "POST",
            url: '../api/landlord/update.php',
            dataType: 'json',
            data: {
                id: <?php echo $_GET['id']; ?>,
                name: $("#name").val(),
                surname: $('#surname').val(),
                phone: $("#phone").val(),
                email;: $("#email").val(),
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Zaktualizowano dane właściciela");
                    window.location.href = '/sb/flatman/landlords';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>
