<!DOCTYPE html>
<html lang="en">

<?php include('include/jscss.php') ?>

<body class="w3-container w3-animate-opacity">
  <!-- container section start -->
  <section id="container" class="">

    <?php include('include/header.php') ?>
    <?php include('include/sidebar.php') ?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">

        <div class="row">
          <div class="text-center">
            <h1>ใบรับฝากสินค้า</h1>
            <?= $date; ?>
            <br>
            <?= $dep_id; ?>
          </div>
        </div>

        <div class="col-md-12">
          <div class="col-md-2">
            <label>นามลูกค้า</label>
          </div>
          <div class="col-md-10">
            <select class="form-control js-example-basic-single" id="customer">
              <?php 
              foreach($customer as $cus){
                echo '<option value="' . $cus->id . '">' . $cus->name . '</option>';
              }
              ?>
            </select>
          </div>

          <div class="col-md-2">
            <label>สินค้า</label>
          </div>
          <div class="col-md-10">
            <select class="form-control js-example-basic-single" id="stock">
              <?php 
              foreach($stock as $st){
                echo '<option product="' . $st->product . '" color="' . $st->color . '" value="' . $st->id . '" unit="' . $st->unit . '" number="' . $st->number . '">' . $st->product . ' สี' . $st->color . '  (มีสต๊อก ' . $st->number . ' ' . $st->unit . ')' . '</option>';
              }
              ?>
            </select>
          </div>

          <div class="col-md-2">
            <label>จำนวน</label>
          </div>
          <div class="col-md-10">
            <input type="number" id="number" class="form-control" required min="0">
          </div>

          <div class="col-md-2">
            <label>ราคาต่อหน่วย</label>
          </div>
          <div class="col-md-10">
            <input type="number" step="any" id="price_per_unit" class="form-control" required>
          </div>
        </div>

        <button class="btn btn-info" id="add_list">เพิ่ม</button>

        <div class="col-md-12">
          <div class="row">
            <div>
              <div class="pull-right">
                <label>รวม</label>
                <input type="text" name="total" readonly>
              </div>
            </div>
            <form id="fields" method="post" action="deposit/add">
              <input type="hidden" name="dep_id" value="<?= $dep_id; ?>">
            </form>
          </div>
        </div>



      </section>

    </section>
    <!--main content end-->
    <button id="save" class="btn btn-success" style="width: 100%;">บันทึก</button>
  </section>
  <!-- container section start -->

  <?php include('include/jsfooter.php') ?>
  
  <script>
    $(document).ready(function(){
      var i = 1;
      var total = 0;
      $('#customer, #stock').select2();

      var number_of_stock = $('#stock').find('option:selected').attr('number');
      $('#number').attr('max', number_of_stock);

      $('#stock').change(function(){
        var number = $('#stock').find('option:selected').attr('number');
        $('#number').attr('max', number);
      });

      $('#number').keyup(function(){
        var max = $(this).attr('max');
        var min = $(this).attr('min');
        if (parseInt($(this).val()) <= parseInt(max) && parseInt($(this).val()) >= parseInt(min));
        else $(this).val('');
      });

      if($('#stock').has('option').length == 0){
        $('#add_list').attr('disabled', '');
      }

      $('#add_list').click(function(){
        var cus_id = $('#customer').val();
        var stock_id = $('#stock').val();
        var product = $('#stock').find('option:selected').attr('product');
        var color = $('#stock').find('option:selected').attr('color');
        var unit = $('#stock').find('option:selected').attr('unit');
        var number_stock = $('#stock').find('option:selected').attr('number');
        var number = $('#number').val();
        $('#stock').find('option:selected').remove();

        if($('#stock').has('option').length == 0){
          $('#add_list').attr('disabled', '');
        }

        var price_per_unit = $('#price_per_unit').val();
        if(!number) number = 0;
        if(!price_per_unit) price_per_unit = 0;
        var price = number * price_per_unit;
        total += price;

        $('#fields').append(
          '<div class="col-md-4" id="list_' + i +'" style="border: solid 2px; margin: 5px; padding: 5px;" product="' + product + '" color="' + color + '" unit="' + unit + '" id="' + stock_id + '" number="' + number_stock + '"' + '>' +
          product + 'สี' + color + ' จำนวน ' + number + ' ' + unit + ' ราคาต่อหน่วย ' + price_per_unit + ' บาท <span style="color: red;">รวม ' + price + ' บาท</span><button id="delete-list" row="' + i + '" type="button" class="close" data-dismiss="modal">&times;</button>' + 
          '<input type="hidden" name="cus_id[]" value="' + cus_id + '">' +
          '<input type="hidden" name="stock_id[]" value="' + stock_id + '">' +
          '<input type="hidden" name="number[]" value="' + number + '">' +
          '<input type="hidden" name="price_per_number[]" value="' + price_per_unit + '">' +
          '<input type="hidden" name="price[]" value="' + price + '">' +
          '</div>'
          );

        $('[name="total"]').val(total);

        i++;
      });

      $('body').on('click', '#delete-list', function(){
        var row = $(this).attr('row');
        var stock_id = $('#list_' + row).attr('id');
        var product = $('#list_' + row).attr('product');
        var color = $('#list_' + row).attr('color');
        var unit = $('#list_' + row).attr('unit');
        var number = $('#list_' + row).attr('number');
        $('#list_' + row).remove();
        $('#stock').append('<option product="' + product + '" color="' + color + '" value="' + stock_id + '" unit="' + unit + '" number="' + number + '">' + product + ' สี' + color + ' (มีสต๊อก' + number + ' ' + unit + ')</option>');
      });

      $('#save').click(function(){
        $.ajax({
          url: 'deposit/add',
          type: 'post',
          data: $('form').serialize(),
          success: function(result){
            if(result == 1){
              window.location.reload();
            }
          }
        });
      });

    });
  </script>

</body>

</html>
