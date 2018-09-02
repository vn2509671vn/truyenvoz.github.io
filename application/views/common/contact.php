<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Truyện Hay - Tổng hợp những câu chuyện đời thường ý nghĩa, những gốc khuất của xã hội....</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tổng hợp những câu chuyện đời thường ý nghĩa, những gốc khuất của xã hội hiện đại,.....">
    <meta name="keywords" content="truyện hay, truyện đời thường, truyện vui, truyện voz, truyện tâm lý xã hội, truyện ma, truyện 18+, truyện online">
    <meta name="author" content="">
    <link href="<?php echo base_url();?>templates/img/Truyen-Hay.ico" rel="shortcut icon" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>templates/clean-blog/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?php echo base_url();?>templates/clean-blog/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>templates/clean-blog/css/clean-blog.css" rel="stylesheet">
    
    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url();?>templates/clean-blog/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>templates/clean-blog/vendor/bootstrap/js/bootstrap.bundle.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url();?>templates/clean-blog/js/clean-blog.js"></script>
    
  </head>

  <body>

    <!-- Navigation -->
    <?php $this->load->view('common/header', isset($data)?$data:NULL); ?>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('<?php echo base_url();?>templates/img/home-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>Liên Hệ Với Tôi</h1>
              <span class="subheading">Nếu bạn có bất kỳ câu hỏi hoặc mẫu truyện bất kỳ vui lòng gửi phản hồi về cho tôi.</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <h4 class="text-center orange-color"><?php if(isset($msgForContacting)) echo $msgForContacting; ?></h4>
          <form name="sentMessage" method="POST" action="<?php echo base_url('contact'); ?>">
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Họ Tên <span class="required red-color">*</span></label>
                <input type="text" class="form-control" placeholder="Name" name="name" required>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Địa chỉ email</label>
                <input type="email" class="form-control" placeholder="Email Address" name="email">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Số điện thoại</label>
                <input type="tel" class="form-control" placeholder="Phone Number" name="phone">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Nội dung</label>
                <textarea rows="5" class="form-control" placeholder="Message" name="message" required></textarea>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <hr>

    <!-- Footer -->
    <?php $this->load->view('common/footer', isset($data)?$data:NULL); ?>

  </body>
      
</html>