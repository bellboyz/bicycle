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
            <button id="add-button" class="btn btn-info pull-right" style="margin-right: 15px;">เพิ่มลูกค้า</button>
            <h1>รายชื่อลูกค้า</h1>
          </div>

          <div class="grid simple">
            <div class="grid-title grid-body">
              <table id="tbldata" class="display" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>ชื่อลูกค้า</th>
                    <th>ที่อยู่</th>
                    <th>เบอร์โทรศัพท์</th>
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
        <form method="post" action="customer/add" id="add-form">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">เพิ่มรายการสินค้า</h4>
          </div>
          <div class="modal-body">
            <input class="form-control" type="text" name="name" placeholder="ชื่อลูกค้า" style="margin: 0 0 10px 0;" required>
            <input class="form-control" type="text" name="address" placeholder="ที่อยู่" style="margin: 0 0 10px 0;" required>
            <input class="form-control" type="text" name="tel" placeholder="เบอร์โทรศัพท์" style="margin: 0 0 10px 0;" required>
          </div>
          <div class="modal-footer">
            <button id="add-customer" type="submit" class="btn btn-info" data-dismiss="modal">เพิ่มสินค้า</button>
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
        <form method="post" action="customer/update" id="edit-form">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">แก้ไขรายการสินค้า</h4>
          </div>
          <div class="modal-body">
            <input type="hidden" id="edit-id" name="id">
            <input id="edit-name" class="form-control" type="text" name="name" placeholder="ชื่อลูกค้า" style="margin: 0 0 10px 0;" required>
            <input id="edit-address" class="form-control" type="text" name="address" placeholder="ที่อยู่" style="margin: 0 0 10px 0;" required>
            <input id="edit-tel" class="form-control" type="text" name="tel" placeholder="เบอร์โทรศัพท์" style="margin: 0 0 10px 0;" required>
          </div>
          <div class="modal-footer">
            <button id="edit-customer" type="submit" class="btn btn-info" data-dismiss="modal">แก้ไขสินค้า</button>
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

      $('#add-customer').click(function(){
        $.ajax({
          url: 'customer/add',
          type: 'post',
          data: $('#add-form').serialize(),
          success: function(result){
            if(result == 1){
              $tbldata.ajax.reload();
              alert('เพิ่มข้อมูลลูกค้าเรียบร้อย');
              document.getElementById("add-form").reset();
            }
          }
        });
      });

      $('body').on('click', '.deleteAction', function(){
        var delete_id = $(this).attr('delete-id');
        $.ajax({
          url: 'customer/delete',
          type: 'post',
          data: {id: delete_id},
          success: function(result){
            if(result == 1){
              $tbldata.ajax.reload();
              alert('ลบข้อมูลลูกค้าเรียบร้อย');
            }
          }
        });
      });

        // get data from id for edit
        $('body').on('click', '.editAction', function(){
          var edit_id = $(this).attr('edit-id');
          $.ajax({
            url: 'customer/edit',
            type: 'post',
            data: {id: edit_id},
            success: function(result){
              if(result){
                var data = JSON.parse(result);
                $('#edit-id').val(data[0].id);
                $('#edit-name').val(data[0].name);
                $('#edit-address').val(data[0].address);
                $('#edit-tel').val(data[0].tel);
                $('#modalEdit').modal('show');
              }
            }
          });
        });

        $('#edit-customer').click(function(){
          $.ajax({
            url: 'customer/update',
            type: 'post',
            data: $('#edit-form').serialize(),
            success: function(result){
              // if(result == 1){
                $tbldata.ajax.reload();
                alert('แก้ไขข้อมูลลูกค้าเรียบร้อย');
                document.getElementById("edit-form").reset();
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
            'url': 'customer/table',
            'type': 'POST'
          },
          'paging': true,
          'pageLength': 30,
          'aaSorting': [],
          "columns": [
          {"class": "text-center", 'data': 'name'},
          {"class": "text-center", 'data': 'address'},
          {"class": "text-center", 'data': 'tel'},
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
