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
    <header class="masthead">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1><?php echo $catName['name']; ?></h1>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <?php foreach($lstProduct as $product){ ?>
              <div class="post-preview">
                <a href="<?php echo base_url("post/".$product['slug']."/".$product['id']); ?>">
                  <h3 class="post-title">
                    <?php echo $product['title']; ?>
                  </h3>
                </a>
                <p class="post-meta">Đăng bởi 
                  <a href="<?php echo base_url("post/".$product['slug']."/".$product['id']); ?>"><?php echo $product['name']; ?></a>
                  lúc <?php echo $product['create_date']; ?></p>
              </div>
            <?php } ?>
          </div>
          <div class="col-md-4">
            <?php $this->load->view('common/rightmenu', isset($data)?$data:NULL); ?>
          </div>
        </div>
      </div>
    </article>

    <hr>

    <!-- Footer -->
    <?php $this->load->view('common/footer', isset($data)?$data:NULL); ?>

  </body>

</html>