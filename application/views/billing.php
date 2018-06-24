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
            <h1>ใบวางบิล</h1>
            <?= $date; ?>
            <br>
            <?= $bill_id; ?>
          </div>

          <div class="col-md-12">
            <form action="billing/bill_detail" method="post">
              <input type="hidden" name="bill_id" value="<?= $bill_id; ?>">
              <input type="hidden" name="date" value="<?= date('d/m/Y'); ?>">
              <div class="col-md-3">
                <label>นามลูกค้า</label>
              </div>
              <div class="col-md-9">
                <select class="form-control js-example-basic-single" id="customer" name="cus_id">
                  <?php 
                  foreach($customer as $cus){
                    echo '<option value="' . $cus->id . '">' . $cus->name . '</option>';
                  }
                  ?>
                </select>
              </div>

              <div class="col-md-3">
                <label>ตั้งแต่วันที่</label>
              </div>
              <div class="col-md-9">
                <input type="text" class="form-control date" name="start_date" required autocomplete="off">
              </div>

              <div class="col-md-3">
                <label>ถึงวันที่</label>
              </div>
              <div class="col-md-9">
                <input type="text" class="form-control date" name="end_date" required autocomplete="off">
              </div>
            </form>
          </div>

        </div>

      </section>

    </section>
    <!--main content end-->
    <button id="save" class="btn btn-success" style="width: 100%;">แสดงบิล</button>
  </section>
  <!-- container section start -->

  <?php include('include/jsfooter.php') ?>

  <script>
    $(document).ready(function(){
      $('#customer').select2();

      $('.date').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        todayHighlight: true
      });

      $('#save').click(function(){
        $('form').submit();
      });
    });
  </script>

</body>

</html>
