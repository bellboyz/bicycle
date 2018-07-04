<!DOCTYPE html>
<html lang="en">

<style type="text/css">
  #picture{
    background-image: url("common/img/customer.png");
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
            <button id="add-button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modalAdd" style="margin-right: 15px;">เพิ่มลูกค้า</button>
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
            <div class="form-group">
              <input class="form-control" type="text" name="name" placeholder="ชื่อลูกค้า" style="margin: 0 0 10px 0;" required>
            </div>
            <div class="form-group">
              <input class="form-control" type="text" name="address" placeholder="ที่อยู่" style="margin: 0 0 10px 0;" required>
            </div>
            <div class="form-group">
              <input class="form-control" type="text" name="tel" placeholder="เบอร์โทรศัพท์" style="margin: 0 0 10px 0;" required>
            </div>
          </div>
          <div class="modal-footer">
            <button id="add-customer" type="submit" class="btn btn-info">เพิ่มสินค้า</button>
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
            <div class="form-group">
              <input id="edit-name" class="form-control" type="text" name="name" placeholder="ชื่อลูกค้า" style="margin: 0 0 10px 0;" required>
            </div>
            <div class="form-group">
              <input id="edit-address" class="form-control" type="text" name="address" placeholder="ที่อยู่" style="margin: 0 0 10px 0;" required>
            </div>
            <div class="form-group">
              <input id="edit-tel" class="form-control" type="text" name="tel" placeholder="เบอร์โทรศัพท์" style="margin: 0 0 10px 0;" required>
            </div>
          </div>
          <div class="modal-footer">
            <button id="edit-customer" type="submit" class="btn btn-info">แก้ไขสินค้า</button>
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
            <button id="delete-stock" class="btn btn-danger">ลบ</button>
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
            <center><h4 class="modal-title" id="title"></h4></center>
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
      $('#modalAdd').on('hidden.bs.modal', function(){
        $('#modalAdd').bootstrapValidator('resetForm', true);
      });
      $('#modalEdit').on('hidden.bs.modal', function(){
        $('#modalEdit').bootstrapValidator('resetForm', true);
      });

      $('[name="tel"]').keyup(function () {
        var $elem = $(this);
        $elem.val($elem.val().replace(/[^\d]+/g, ''));
      });

      $('#add-form').bootstrapValidator({
        fields: {
          name:{
            validators:{
              notEmpty:{
                message: 'โปรดกรอกข้อมูล'
              }
            }
          },
          address:{
            validators:{
              notEmpty:{
                message: 'โปรดกรอกข้อมูล'
              }
            }
          },
          tel:{
            validators:{
              notEmpty:{
                message: 'โปรดกรอกข้อมูล'
              }
            }
          }
        }
      })
      .on('success.form.bv', function(e){
        e.preventDefault();
        $.ajax({
          url: 'customer/add',
          type: 'post',
          data: $(e.target).serialize(),
          success: function(result){
            if(result == 1){
              $tbldata.ajax.reload();
              $('#title').text('เพิ่มข้อมูลลูกค้าเรียบร้อย');
              $('#modalSuccess').modal('show');
              $('#add-form').bootstrapValidator('resetForm', true);
              $('#modalAdd').modal('hide');
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
          url: 'customer/delete',
          type: 'post',
          data: {id: delete_id},
          success: function(result){
            if(result == 1){
              $tbldata.ajax.reload();
              // alert('ลบข้อมูลลูกค้าเรียบร้อย');
              $('#title').text('ลบข้อมูลลูกค้าเรียบร้อย');
              $('#modalSuccess').modal('show');
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

      $('#edit-form').bootstrapValidator({
        fields: {
          name:{
            validators:{
              notEmpty:{
                message: 'โปรดกรอกข้อมูล'
              }
            }
          },
          address:{
            validators:{
              notEmpty:{
                message: 'โปรดกรอกข้อมูล'
              }
            }
          },
          tel:{
            validators:{
              notEmpty:{
                message: 'โปรดกรอกข้อมูล'
              }
            }
          }
        }
      })
      .on('success.form.bv', function(e){
        e.preventDefault();
        $.ajax({
          url: 'customer/update',
          type: 'post',
          data: $(e.target).serialize(),
          success: function(result){
              $tbldata.ajax.reload();
              $('#title').text('แก้ไขข้อมูลลูกค้าเรียบร้อย');
              $('#modalSuccess').modal('show');
              $('#edit-form').bootstrapValidator('resetForm', true);
              $('#modalEdit').modal('hide');
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
