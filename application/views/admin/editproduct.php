<div class="col-md-12 col-xs-12">
    <div class="x_panel no-border">
        <div class="x_title">
            <h2>Sửa truyện: <b><?php echo $sanpham['title']; ?></b></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            <form action="<?php echo base_url('product/edit/'. $sanpham['id']); ?>" method="post" class="form-horizontal"  enctype="multipart/form-data">
                <div class='form-group'>
                    <span class='error-red control-label col-md-6 col-sm-6 col-xs-12'><?php if(isset($msg)) echo $msg;?></span>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên truyện <span class="required red-color">*</span></label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control" required name="name" value="<?php echo ($this->input->post('title') ? $this->input->post('title') : $sanpham['title']); ?>"/>
                        <strong class='error-red'><?php echo form_error('name'); ?></strong>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Loại truyện <span class="required red-color">*</span></label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <?php echo $catList; ?>
                        <strong class='error-red'><?php echo form_error('category'); ?></strong>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Nội dung chi tiết <span class="required red-color">*</span></label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
						<textarea name="description" id="description" class="form-control" rows="10" cols="50"><?php echo ($this->input->post('description') ? $this->input->post('description') : $sanpham['description']); ?></textarea>
					    <strong class='error-red'><?php echo form_error('description'); ?></strong>
					</div>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-3 col-xs-12">
                        <input type="submit" class="btn btn-primary" value="Sửa"/>
                        <a href="<?php echo base_url('product'); ?>" class="btn btn-danger">Quay lại</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function onlyNumbers(e) {
        //if (String.fromCharCode(e.keyCode).match(/[^0-9\.]/g)) return false;
        return !(e > 31 && (e < 48 || e > 57));
    }
    
    $(document).ready(function(){
        var roxyFileman = '/templates/admin/plugins/fileman/index.html'; 
	    CKEDITOR.replace('description', {filebrowserBrowseUrl:roxyFileman,
                                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                removeDialogTabs: 'link:upload;image:upload'});
                                
        $('.tree li:has(ul)').addClass('parent_li');
        $('.tree li.parent_li > span > i.node').on('click', function (e) {
            var children = $(this).closest('li.parent_li').find(' > ul > li');
            if (children.is(":visible")) {
                children.hide('fast');
                $(this).addClass('fa-plus-square').removeClass('fa-minus-square');
            } else {
                children.show('fast');
                $(this).addClass('fa-minus-square').removeClass('fa-plus-square');
            }
            e.stopPropagation();
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#kv-explorer").fileinput({
            'theme': 'explorer',
            'uploadUrl': '#',
            'showUpload': false,
            'allowedFileExtensions': ['jpg', 'png', 'gif']
        });
        
        <?php foreach($checkCatList as $cat){ ?>
            $('input[type=checkbox][value=<?php echo $cat['cat_id']; ?>]').prop('checked', true);
        <?php } ?>
    });
</script>