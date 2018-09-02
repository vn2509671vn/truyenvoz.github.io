<div class="col-md-12 col-xs-12">
    <div class="x_panel no-border">
        <div class="x_title">
            <h2>Quản lý truyện</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            <table id="data_table" class='display table table-striped table-bordered table-full-width' cellspacing='0' width='100%'>
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Tên truyện</th>
                        <th class="text-center">Người tạo</th>
                        <th class="text-center">Lượt xem</th>
                        <th class="text-center">Ngày tạo</th>
                        <th class="text-center">Lần cập nhật cuối</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; ?>
                    <?php foreach($listProduct as $product){ ?>
                    <tr data-id="<?php echo $product['id']; ?>">
                        <td class="text-center"><?php echo $stt ?></td>
                        <td><strong><?php echo $product['title']; ?></strong></td>
                        <td class="text-center"><?php echo $product['name']; ?></td>
                        <td class="text-center"><?php echo $product['views']; ?></td>
                        <td class="text-center"><?php echo $product['create_date']; ?></td>
                        <td class="text-center"><?php echo $product['updated_date']; ?></td>
                        <td class="text-center">
                            <a class="btn btn-warning btnEdit btn-xs">Sửa</a>
                            <a class="btn btn-danger btnDelete btn-xs" onclick="deleteItem('<?php echo base_url(); ?>','product',<?php echo $product['id']; ?>)">Xóa</a>
                        </td>
                    </tr>
                    <?php $stt++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#data_table').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                {
                    text: 'Tạo mới',
                    className: 'btn btn-primary',
                    action: function ( e, dt, node, config ) {
                        window.location.replace("<?php echo base_url("product/add-new"); ?>");
                    }
                }
            ]
        } );
        
        $(document).on('click','.btnEdit',function(){
           var id = $(this).closest('tr').attr("data-id");
           window.location.replace("<?php echo base_url("product/edit"); ?>/"+id);
        });
    } );
</script>