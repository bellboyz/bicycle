<!DOCTYPE html>
<html lang="en">

<?php include('include/jscss.php') ?>
<style type="text/css">
  table tr th, table tr td{
    border: solid 1px;
  }
</style>

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
            <h1>Billing</h1>
            <?php
              if($search == false) echo $date;
              else{
                if($start_date && $end_date) echo 'ตั้งแต่วันที่ ' . $start_date . ' ถึงวันที่ ' . $end_date;
                else if($start_date && !$end_date) echo 'ตั้งแต่วันที่ ' . $start_date;
                else if(!$start_date && $end_date) echo 'ถึงวันที่ ' . $end_date;
              }
            ?>
            <br>
            <?= $bill_id; ?>
          </div>
          <br>
          <div class="col-md-12">
            <div class="col-md-2">
              <label style="margin-top: 5px;">นามลูกค้า</label>
            </div>
            <div class="col-md-10">
              <input type="text" class="form-control" name="cus_name" value="<?= $customer[0]->name; ?>" readonly>
            </div>
            <br>
            <br>
            <table width="100%">
              <thead>
                <tr>
                  <th><center>ลำดับ</center></th>
                  <th><center>เลขที่ใบรับฝากสินค้า</center></th>
                  <th><center>วันที่ใบรับฝากสินค้า</center></th>
                  <th><center>ราคา</center></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                $total = 0;
                foreach($deposit as $dep){
                  echo '
                  <tr>
                    <td><center>' . $i . '</center></td>
                    <td><center><a href="/' . $dep->location . '" target="_blank">' . $dep->dep_id . '</a></center></td>
                    <td><center>' . $dep->created_date . '</center></td>
                    <td><center>' . number_format($dep->price) . '</center></td>
                  </tr>
                  ';
                  $total += $dep->price;
                  $i++;
                }
                ?>
              </tbody>
            </table>
            <br>
            <div class="pull-right">
              <label>รวม</label>
              <input type="text" id="total" value="<?= number_format($total); ?>" readonly>
              <input type="hidden" name="total" value="<?= $total; ?>">
            </div>

          </div>

        </section>

      </section>
      <!--main content end-->
    </section>
    <!-- container section start -->

    <form action="/billing/print_bill" method="post">
      <input type="hidden" name="cus_id" value="<?= $customer[0]->id; ?>">
      <input type="hidden" name="start_date" value="<?= $start_date; ?>">
      <input type="hidden" name="end_date" value="<?= $end_date; ?>">
      <input type="hidden" name="bill_id" value="<?= $bill_id; ?>">
      <?php if($search == false){ ?>
      <input type="hidden" name="date" value="<?= $date; ?>">
      <?php } else { ?>
      <input type="hidden" name="start_date" value="<?= $start_date; ?>">
      <input type="hidden" name="end_date" value="<?= $end_date; ?>">
      <?php } ?>
      <input type="hidden" name="deposit">
    </form>

    <?php if($search == false){ ?>
    <button id="print" class="btn btn-primary" style="width: 100%">ปริ้นใวางบิล</button>
    <?php } else { ?>
    <button id="search_print" class="btn btn-primary" style="width: 100%">ปริ้นใวางบิล</button>      
    <?php } ?>

    <?php include('include/jsfooter.php') ?>

    <script>
      // $('#total').val().replace(/,/g, "").replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

      $('#print').click(function (){
        var deposit_array = <?php echo json_encode($deposit); ?>;
        var deposit = [];

        for(var i = 0; i < deposit_array.length; i++){
          deposit.push(deposit_array[i].dep_id);
        }

        $('[name="deposit"]').val(deposit);

        $.ajax({
          url: '/billing/print_bill',
          type: 'post',
          data: $('form').serialize(),
          success: function(result){
            window.location.href = '/billing';
          }
        });
      });
    </script>

  </body>

  </html>
