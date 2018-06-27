<!DOCTYPE html>
<html lang="en">

<style type="text/css">
  #picture{
    background-image: url("common/img/report.png");
    background-repeat: no-repeat;
    background-position: 1100px 430px;
      background-size: 200px 200px;
  } 
</style>

<?php include('include/jscss.php') ?>

<body class="w3-container w3-animate-opacity" id="picture">
  <!-- container section start -->
  <section id="container" class="">

    <?php include('include/header.php') ?>
    <?php include('include/sidebar.php') ?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">

        <div class="row">
          <div class="text-center">
            <h1>รายงาน</h1>
          </div>
        </div>
        <form action="report/get" method="post">
          <div class="col-md-12">
            <div class="col-md-3">
              <label>ค้นหารายงาน</label>
            </div>
            <div class="col-md-9">
              <label style="margin-right: 20px;">
                <input type="radio" name="check" value="report_stock" checked>
                ยอดการผลิต
              </label>
              <label>
                <input type="radio" name="check" value="report_deposit">
                ยอดการจำหน่าย
              </label>
              <label>
                <input type="radio" name="check" value="report_customer">
                ยอดการสั่งซื้อของลูกค้า
              </label>
            </div>

            <div id="customer_div" style="display: none;">
              <div class="col-md-3">
                <label>นามลูกค้า</label>
              </div>
              <div class="col-md-9">
                <select class="form-control js-example-basic-single" id="customer" name="customer">
                  <option value=""></option>
                  <?php 
                  foreach($customer as $cus){
                    echo '<option value="' . $cus->id . '">' . $cus->name . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <label>สินค้า</label>
            </div>
            <div class="col-md-9">
              <select class="form-control js-example-basic-single" id="stock" name="stock">
                <option value=""></option>
                <?php 
                foreach($stock as $st){
                  echo '<option product="' . $st->product . '" color="' . $st->color . '" value="' . $st->id . '" unit="' . $st->unit . '" number="' . $st->number . '">' . $st->product . ' สี' . $st->color . '  (มีสต๊อก ' . $st->number . ' ' . $st->unit . ')' . '</option>';
                }
                ?>
              </select>
            </div>

            <div class="col-md-3">
              <label>ตั้งแต่วันที่</label>
            </div>
            <div class="col-md-9">
              <input type="text" class="form-control date" name="start_date" autocomplete="off">
            </div>

            <div class="col-md-3">
              <label>ถึงวันที่</label>
            </div>
            <div class="col-md-9">
              <input type="text" class="form-control date" name="end_date" autocomplete="off">
            </div>
            <button id="search" type="submit" class="btn btn-success" style="width: 100%; margin-top: 20px;">รายงาน</button>
          </div>
          
        </form>

      </section>

    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

  <?php include('include/jsfooter.php') ?>
  
  <script>
    $(document).ready(function(){
      $('.date').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        todayHighlight: true
      });

      $('[name="check"]').change(function(){
        if($(this).val() == 'report_customer'){
          $('#customer_div').show();
        }
        else{
          $('#customer_div').hide();
        }
      });
      
      if($('[name="check"]').val() == 'report_customer'){
        $('#customer_div').show();
      }
      else{
        $('#customer_div').hide();
      }

      // $('#search').click(function(){
      //   $.ajax({
      //     url: 'search/get',
      //     type: 'post',
      //     data: $('form').serialize(),
      //     success: function(result){}
      //   });
      // });
    });
  </script>

</body>

</html>
