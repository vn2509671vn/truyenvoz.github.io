<div class="col-md-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Chi tiết loại truyện</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_content1" id="add-tab" role="tab" data-toggle="tab" aria-expanded="true">Thêm</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="edit-tab" data-toggle="tab" aria-expanded="false">Chỉnh sửa</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="add-tab">
                        <h4 class="text-center orange-color"><?php if(isset($msgForAdding)) echo $msgForAdding; ?></h4>
                        <form class="form-horizontal form-label-left" method="POST" action="<?php echo base_url('addCat'); ?>">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên loại <span class="required red-color">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" name="add_name" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Mô tả
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <textarea name="add_mota" rows="4" class="form-control col-md-7 col-xs-12"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Thuộc loại:</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <select class="form-control" name="add_parent">
                                        <option value="0" selected>Mặc định</option>
                                        <?php foreach ($nodeList as $node) { ?>
                                        <option value="<?php echo $node['cat_id']; ?>"><?php echo $node['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Thêm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="edit-tab">
                        <h4 class="text-center orange-color"><?php if(isset($msgForEditing)) echo $msgForEditing; ?></h4>
                        <form class="form-horizontal form-label-left" method="POST" action="<?php echo base_url('editCat'); ?>">
                            <input type="hidden" name="id"/>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên loại <span class="required red-color">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" name="name" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mota">Mô tả
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <textarea name="mota" rows="4" class="form-control col-md-7 col-xs-12"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Thuộc loại:</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <select class="form-control" name="parent">
                                        <option value="0" selected>Mặc định</option>
                                        <?php foreach ($nodeList as $node) { ?>
                                        <option value="<?php echo $node['cat_id']; ?>"><?php echo $node['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" id="btnLuu" class="btn btn-success" name="submit" value="Edit">Lưu</button>
                                    <button type="submit" id="btnXoa" class="btn btn-danger"  name="submit" value="Del" onclick="return confirm('Bạn thật sự muốn xóa loại sản phẩm này?');">Xóa</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Danh sách loại truyện</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php echo $catList; ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
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
        $('.tree li > span').on('click', function (e) {
            $("#edit-tab").click();
            $('.tree li > span').each(function(){
                $(this).removeClass("background-gold");
            });
            $(this).addClass("background-gold");
            var id = $(this).attr("data-id");
            var name = $(this).text();
            var descript = $(this).attr("descript");
            var parent = $(this).attr("parent-id");
            $("input[name=id]").val(id);
            $("input[name=name]").val(name);
            $("textarea[name=mota]").val(descript);
            $("select[name=parent]").val(parent);
            $("#btnLuu").show();
            $("#btnXoa").show();
        });
        
        $("#add-tab").click(function(){
            $('.tree li > span').each(function(){
                $(this).removeClass("background-gold");
            })
        });
        
        $("#edit-tab").click(function(){
            var id = $("input[name=id]").val();
            if(id != ""){
                $("#btnLuu").show();
                $("#btnXoa").show();
                $('.tree li > span').each(function(){
                    var data_id = $(this).attr("data-id");
                    if(data_id == id){
                        $(this).addClass("background-gold");
                        return false;
                    }
                });
            }
            else {
                $("#btnLuu").hide();
                $("#btnXoa").hide();
            }
        });
        
        <?php if(isset($msgForEditing)){ ?>
        $(document).ready(function(){
            $("#edit-tab").click();
        })
        <?php } ?>
    });
</script>