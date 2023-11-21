<div class="box">
    <?php
        require './views/admin/navAdmin.php' ;
    ?>
    <div>
        <table class="table">
            <thead class="table-success">
                <tr>
                    <th>Quản lí trạng thái</th>
                </tr>
            </thead>
        </table>
        <form action="" method="post">
            <table class="table table-hover">
                <thead class="table-success">
                    <tr>
                        <th>Chọn</th>
                        <th>Mã trạng thái</th>
                        <th>Tên trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>

                <tbody> 
                    <?php foreach($listStatus as $Status => $status) : ?>
                        <tr>
                            <td><input type="checkbox" name="check[]" value="<?php echo $status -> StatusID ?>" id="checkList"></td>
                            <td><?php echo $status -> StatusID ?></td>
                            <td><?php echo $status -> NameStatus ?></td>
                            <td>
                              <a href="?action=managerStatus&&DeleteStatusID=<?php echo $status -> StatusID ?>" onclick="return confirm('Bạn chắc chắn xóa chứ ?');" class="btn btn-danger">Xóa</a>
                              <a href="?action=updateStatus&&UpdateStatusID=<?php echo $status -> StatusID ?>" class="btn btn-primary my-1">Sửa</a>
                            </td>
                        </tr>
                    <?php endforeach ; ?>
                </tbody>
                
            </table>
            <tr>
                <a class="btn open_checked button-admin">Chọn tất cả</a>
                <a class="btn close_checked mx-2 button-admin">Bỏ chọn tất cả</a>
                <button type="submit" class="btn delete_checked button-admin" onclick="return confirm('Bạn chắc chắn xóa chứ ?');" name="delete_checked">Xóa mục đã chọn</button>
                <a class="btn mx-2 button-admin" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm mới</a>
            </tr>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm trạng thái</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" enctype="multipart/form-data" onsubmit="return ">
        <div class="modal-body">
          <div class="form-group">
            <label for="" style="font-weight:500;">Tên trạng thái</label> <span id="status_name_err" style="color:red;font-size:14px;"></span>