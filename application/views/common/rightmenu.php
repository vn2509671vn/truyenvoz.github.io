          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">TÌM KIẾM</h5>
            <div class="card-body">
              <div class="input-group">
                <input type="text" id="txtSearch" class="form-control" placeholder="Nhập từ khóa...">
                <span class="input-group-btn">
                  <button class="btn btn-secondary" id="btnSearch" type="button">Tìm!</button>
                </span>
              </div>
            </div>
          </div>

          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header">DANH MỤC TRUYỆN</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="<?php echo base_url("fullstory");?>">Truyện bộ</a>
                    </li>
                    <!-- <li>
                      <a href="#">HTML</a>
                    </li>
                    <li>
                      <a href="#">Freebies</a>
                    </li> -->
                  </ul>
                </div>
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="<?php echo base_url("partstory");?>">Truyện ngắn</a>
                    </li>
                    <!-- <li>
                      <a href="#">CSS</a>
                    </li>
                    <li>
                      <a href="#">Tutorials</a>
                    </li> -->
                  </ul>
                </div>
              </div>
            </div>
          </div>
          
          <!-- TOP Widget -->
          <div class="card my-4">
            <h5 class="card-header">TRUYỆN ĐƯỢC CHÚ Ý</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <ul class="list-unstyled mb-0">
                    <?php foreach($lstTopProduct as $topproduct){ ?>
                    <li>
                      <a href="<?php echo base_url('post/'.$topproduct['slug'].'/'.$topproduct['id']);?>"><?php echo $topproduct['title']; ?> (<?php echo $topproduct['views']; ?>)</a>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
<script type="text/javascript">
  $(document).ready(function(){
    $("#btnSearch").click(function(){
      var txtSearch = $("#txtSearch").val();
      window.location.href = "<?php echo base_url();?>search/" + txtSearch;
    });
  });
</script>