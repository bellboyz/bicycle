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
            <h1>
            <?php 
            if($type == 'billing') echo 'ค้นหาใบวางบิล'; 
            else if($type == 'deposit') echo 'ค้นหาใบฝากสินค้า';
            ?>
            </h1>
            <?php
              if($start_date && $end_date) echo 'ตั้งแต่วันที่ ' . $start_date . ' ถึงวันที่ ' . $end_date;
              else if($start_date && !$end_date) echo 'ตั้งแต่วันที่ ' . $start_date;
              else if(!$start_date && $end_date) echo 'ถึงวันที่ ' . $end_date;
            ?>
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
            <?php if($type == 'billing'){ ?>
            <table width="100%">
              <thead>
                <tr>
                  <th><center>ลำดับ</center></th>
                  <th><center>หมายเลขใบวางบิล</center></th>
                  <th><center>ยอดรวม</center></th>
                  <th><center></center></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                foreach($billing as $bill){
                  echo '
                  <tr>
                    <td><center>' . $i . '</center></td>
                    <td><center>' . $bill->bill_id . '</center></td>
                    <td><center>' . $bill->total . '</center></td>
                    <td><center><a href="/' . $bill->location . '" target="_blank" class="btn btn-warning">ปริ้น</a></center></td>
                  </tr>
                  ';
                  $i++;
                }
                ?>
              </tbody>
            </table>
            <?php } else { ?>
            <table width="100%">
              <thead>
                <tr>
                  <th><center>ลำดับ</center></th>
                  <th><center>หมายเลขใบวางบิล</center></th>
                  <th><center>ยอดรวม</center></th>
                  <th><center></center></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                foreach($deposit as $dep){
                  echo '
                  <tr>
                    <td><center>' . $i . '</center></td>
                    <td><center>' . $dep->dep_id . '</center></td>
                    <td><center>' . $dep->total . '</center></td>
                    <td><center><a href="/' . $dep->location . '" target="_blank" class="btn btn-warning">ปริ้น</a></center></td>
                  </tr>
                  ';
                  $i++;
                }
                ?>
              </tbody>
            </table>
            <?php } ?>
          </div>

        </section>

      </section>
      <!--main content end-->
    </section>
    <!-- container section start -->

    <?php include('include/jsfooter.php') ?>

    <script>
    </script>

  </body>

  </html>
