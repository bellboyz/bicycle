<!DOCTYPE html>
<html lang="en">

<style type="text/css">
  #picture{
      background-image: url("common/img/stock.png");
      background-repeat: no-repeat;
      background-position: 1300px 500px;
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
            <button id="add-button" class="btn btn-info pull-right" style="margin-right: 15px;">เพิ่มสินค้า</button>
            <h1>สต๊อกสินค้า</h1>
          </div>

          
          <div class="grid simple">
            <div class="grid-title grid-body">
              <table id="tbldata" class="display" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>สินค้า</th>
                    <th>สี</th>
                    <th>จำนวน</th>
                    <th>หน่วย</th>
                    <th>หมายเหตุ</th>
                    <th>การจัดการ</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>

        </div>

      </section>

    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- Modal add -->
  <div class="modal fade" id="modalAdd" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <form method="post" action="stock/add" id="add-form">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">เพิ่มรายการสินค้า</h4>
          </div>
          <div class="modal-body">
            <input class="form-control" type="text" name="product" placeholder="ชื่อสินค้า" style="margin: 0 0 10px 0;" required>
            <input class="form-control" type="text" name="color" placeholder="สี" style="margin: 0 0 10px 0;" required>
            <!-- <input class="form-control" type="text" name="number" placeholder="จำนวน" style="margin: 0 0 10px 0;" required> -->
            <input class="form-control" type="text" name="unit" placeholder="หน่วย" style="margin: 0 0 10px 0;" required>
            <input class="form-control" type="text" name="note" placeholder="หมายเหตุ" style="margin: 0 0 10px 0;" required>
          </div>
          <div class="modal-footer">
            <button id="add-stock" type="submit" class="btn btn-info" data-dismiss="modal">เพิ่มสินค้า</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
          </div>
        </form>
      </div>

    </div>
  </div>

  <!-- Modal edit -->
  <div class="modal fade" id="modalEdit" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <form method="post" action="stock/update" id="edit-form">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">แก้ไขรายการสินค้า</h4>
          </div>
          <div class="modal-body">
            <input type="hidden" id="edit-id" name="id">
            <input id="edit-product" class="form-control" type="text" name="product" placeholder="ชื่อสินค้า" style="margin: 0 0 10px 0;" required>
            <input id="edit-color" class="form-control" type="text" name="color" placeholder="สี" style="margin: 0 0 10px 0;" required>
            <input id="edit-number" class="form-control" type="text" placeholder="จำนวน" style="margin: 0 0 10px 0;" readonly>
            <input id="edit-unit" class="form-control" type="text" name="unit" placeholder="หน่วย" style="margin: 0 0 10px 0;" required>
            <input id="edit-note" class="form-control" type="text" name="note" placeholder="หมายเหตุ" style="margin: 0 0 10px 0;" required>
          </div>
          <div class="modal-footer">
            <button id="edit-stock" type="submit" class="btn btn-info" data-dismiss="modal">แก้ไขสินค้า</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
          </div>
        </form>
      </div>

    </div>
  </div>

  <!-- Modal edit -->
  <div class="modal fade" id="modalAddNumber" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <form method="post" action="stock/add-number" id="add-stock-form">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">เพิ่มจำนวนสินค้า</h4>
          </div>
          <div class="modal-body">
            <input type="hidden" id="add-stock-id" name="id">
            <input id="add-stock-product" class="form-control" type="text" placeholder="ชื่อสินค้า" style="margin: 0 0 10px 0;" readonly>
            <input id="add-stock-number" class="form-control" type="number" step="any" min="0" name="number" placeholder="จำนวน" style="margin: 0 0 10px 0;" required>
          </div>
          <div class="modal-footer">
            <button id="add-number-stock" type="submit" class="btn btn-info" data-dismiss="modal">แก้ไขสินค้า</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
          </div>
        </form>
      </div>

    </div>
  </div>

  <!-- Modal delete -->
  <div class="modal fade" id="modalDelete" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <form method="post" action="stock/add-number" id="add-stock-form">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><center>ต้องการลบสินค้าหรือไม่ ?</center></h4>
          </div>
          <div class="modal-body">
            <center><img src="/common/img/delete.png" style="width: 20%; height: 20%;"></center>
            <input type="hidden" id="delete-id">
          </div>
          <div class="modal-footer">
            <button id="delete-stock" class="btn btn-danger" data-dismiss="modal">ลบ</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
          </div>
        </form>
      </div>

    </div>
  </div>

  <!-- Modal success -->
  <div class="modal fade" id="modalSuccess" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <form method="post" action="stock/add-number" id="add-stock-form">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <center><h4 class="modal-title" id="title">สินค้าถูกลบแล้ว</h4></center>
          </div>
          <div class="modal-body">
            <center><img src="/common/img/success.png" style="width: 20%; height: 20%;"></center>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
          </div>
        </form>
      </div>

    </div>
  </div>

  <?php include('include/jsfooter.php') ?>
  
  <script type="text/javascript">
    var $tbldata = null;

    $(document).ready(function(){
      $('#add-button').click(function(){
        $('#modalAdd').modal('show');
      });

      $('#add-stock').click(function(){
        $.ajax({
          url: 'stock/add',
          type: 'post',
          data: $('#add-form').serialize(),
          success: function(result){
            if(result == 1){
              $tbldata.ajax.reload();
              alert('เพิ่มสินค้าเรียบร้อย');
              document.getElementById("add-form").reset();
            }
          }
        });
      });

      $('body').on('click', '.deleteAction', function(){
        var delete_id = $(this).attr('delete-id');
          $('#delete-id').val(delete_id);
          $('#modalDelete').modal('show');
      });

      $('body').on('click', '#delete-stock', function(){
        var delete_id = $('#delete-id').val();
        $.ajax({
          url: 'stock/delete',
          type: 'post',
          data: {id: delete_id},
          success: function(result){
            if(result == 1){
              $tbldata.ajax.reload();
              // alert('ลบสินค้าเรียบร้อย');
              $('#title').text('ลบสินค้าเรียบร้อย');
              $('#modalSuccess').modal('show');
            }
          }
        });
      });

        // get data from id for edit
        $('body').on('click', '.editAction', function(){
          var edit_id = $(this).attr('edit-id');
          $.ajax({
            url: 'stock/edit',
            type: 'post',
            data: {id: edit_id},
            success: function(result){
              if(result){
                var data = JSON.parse(result);
                $('#edit-id').val(data[0].id);
                $('#edit-product').val(data[0].product);
                $('#edit-color').val(data[0].color);
                $('#edit-number').val(data[0].number);
                $('#edit-unit').val(data[0].unit);
                $('#edit-note').val(data[0].note);
                $('#modalEdit').modal('show');
              }
            }
          });
        });

        $('#edit-stock').click(function(){
          $.ajax({
            url: 'stock/update',
            type: 'post',
            data: $('#edit-form').serialize(),
            success: function(result){
              // if(result == 1){
                $tbldata.ajax.reload();
                // alert('แก้ไขสินค้าเรียบร้อย');
                $('#title').text('แก้ไขสินค้าเรียบร้อย');
                $('#modalSuccess').modal('show');
                document.getElementById("edit-form").reset();
              // }
            }
          });
        });

        $('body').on('click', '.addStockAction', function(){
          var add_stock_id = $(this).attr('add-stock-id');
          $.ajax({
            url: 'stock/edit',
            type: 'post',
            data: {id: add_stock_id},
            success: function(result){
              if(result){
                var data = JSON.parse(result);
                $('#add-stock-id').val(data[0].id);
                $('#add-stock-product').val(data[0].product);
                $('#modalAddNumber').modal('show');
              }
            }
          });
        });

        $('#add-number-stock').click(function(){
          $.ajax({
            url: 'stock/add_number',
            type: 'post',
            data: $('#add-stock-form').serialize(),
            success: function(result){
              // if(result == 1){
                $tbldata.ajax.reload();
                // alert('เพิ่มจำนวนสินค้าเรียบร้อย');
                $('#title').text('เพิ่มจำนวนสินค้าเรียบร้อย');
                $('#modalSuccess').modal('show');
                document.getElementById("add-stock-form").reset();
              // }
            }
          });
        }); 

        $tbldata = $('#tbldata').DataTable({
          'autoWidth': true,
          'orderClasses': true,

          'pagingType': 'full_numbers',
          'serviceSide': true,
          'ajax': {
            'url': 'stock/table',
            'type': 'POST'
          },
          'paging': true,
          'pageLength': 30,
          'aaSorting': [],
          "columns": [
          {"class": "text-center", 'data': 'product'},
          {"class": "text-center", 'data': 'color'},
          {"class": "text-center", 'data': 'number'},
          {"class": "text-center", 'data': 'unit'},
          {"class": "text-center", 'data': 'note'},
          {"class": "text-center", 'data': 'action', "orderable": false, 'searchable': false}
          ],

          'drawCallback': function () {
            initiate();
          }
        });

        function initiate(){}
      });
    </script>

  </body>

  </html>
