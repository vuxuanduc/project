<div class="box">
    <?php
        require './views/admin/navAdmin.php' ;
    ?>
    <div>
        <table class="table">
            <thead class="table-success">
                <tr>
                    <th>Quản lí đánh giá</th>
                </tr>
            </thead>
        </table>
        <form action="" method="post">
            <table class="table table-hover">
                <thead class="table-success">
                    <tr>
                        <th>Mã thanh toán</th>
                        <th>Mã đặt phòng</th>
                        <th>Tổng tiền</th>
                        <th>Phương thức thanh toán</th>
                    </tr>
                </thead>

                <tbody> 
                    <?php foreach($listPays as $Pays => $Pay) : ?>
                        <tr>
                            <td><?php echo $Pay -> PayID ?></td>
                            <td><?php echo $Pay -> ReservationID ?></td>
                            <td><?php echo $Pay -> TotalAmount ?></td>
                            <td><?php echo $Pay -> PayInfo ?></td>
                        </tr>
                    <?php endforeach ; ?>
                </tbody>
                
            </table>
        </form>
    </div>
</div>
