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
            <h1>ค้นหา</h1>
          </div>
        </div>
        <form action="search/get" method="post">
          <div class="col-md-12">
            <div class="col-md-3">
              <label>ค้นหารายงาน</label>
            </div>
            <div class="col-md-9">
              <label style="margin-right: 20px;">
              <input type="radio" name="check" value="bill" checked>
                ใบวางบิล
              </label>
              <label>
                <input type="radio" name="check" value="deposit">
                ใบฝากสินค้า
              </label>
            </div>

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
              <label>เลขที่ใบวางบิล / ใบฝากสินค้า</label>
            </div>
            <div class="col-md-9">
              <input type="text" id="id" name="id" class="form-control">
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
            <button id="search" type="submit" class="btn btn-success" style="width: 100%; margin-top: 20px;">ค้นหา</button>
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
        $('[name="id"]').val('');
      });

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
