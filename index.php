<?php require "db.php";
if(isset($_GET['category'])){
  $category_id = $_GET['category'];
  $category_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT category FROM plan_categories WHERE id = $category_id"));
}

if(isset($_GET['plan'])){
  $plan_id = $_GET['plan'];
  $plan_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT plan_name FROM plans WHERE id = $plan_id"));
  $plan_category = mysqli_fetch_assoc(mysqli_query($conn, "SELECT category FROM plans WHERE id = $plan_id"));
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>Планировки домов</title>
  <link rel="shortcut icon" href="/img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css">
    <!--Plugin CSS file with desired skin-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    
</head>
<body>
	<div class="container mt-5 d-none d-md-block">
	  <div class="row">
	    <div class="col-md-3 text-center">
	      <a href="/"><img src="img/logo.png" width="200"></a>
	    </div>
	    <div class="col-md-9 text-right">
	      <div class="font-weight-bold h5 pt-2"><a href="tel:8(800)250-45-77" style="color: #3fb938">8 (800) 250-45-77</a></div>
	    </div>
	  </div>
	</div>

	<div class="container">
		<div class="row h-100">
			<aside class="col-12 col-sm-3 p-0 bg-white">
			    <nav class="navbar navbar-expand-sm navbar-light bg-white align-items-start flex-sm-column flex-row pt-0">
			        <a class="navbar-brand d-block d-sm-none" href="/"><img src="img/logo.png" width="200"></a>
			        <a href class="navbar-toggler mt-2" data-toggle="collapse" data-target=".sidebar">
			           <span class="navbar-toggler-icon"></span>
			        </a>
			        <div class="collapse navbar-collapse sidebar py-3" style="width: 100%;">
			            <ul class="flex-column navbar-nav w-100 justify-content-between">
			              <?php $categories = mysqli_query($conn, "SELECT * FROM plan_categories");
			              	while(($category = mysqli_fetch_assoc($categories))):
			              		$count_plans = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) as count FROM plans WHERE category = " . $category['id'])); ?>
			              		<li class="nav-item <?php if($category_id == $category['id']){echo('active');}?>">
				                    <a class="nav-link pl-0" href="/?category=<?=$category['id'];?>"><div class="pull-left"><?=$category['category'];?></div><div class="pull-right"><?=$count_plans['count'];?></div><div class="clearfix"></div></a>
				                </li>
			              <?php endwhile;?>
			            </ul>
			        </div>
			    </nav>
			</aside>
			<?php if(isset($category_id) AND !isset($plan_id)):?>
			  <main class="col bg-faded py-4">
			  	<h5 class="text-uppercase font-weight-bold" style="color: #506286; letter-spacing: 2px;"><?=$category_name['category'];?></h5>
              <div class="breadcrumbs mb-4 text-secondary font-italic"><a href="/" class="text-secondary">Главная</a> → <?=$category_name['category'];?></div>
              <div class="row">
                <?php $plans = mysqli_query($conn, "SELECT * FROM plans WHERE category = $category_id ORDER BY id DESC");
                  while(($plan = mysqli_fetch_assoc($plans))): ?>
                  <div class="col-md-6">
                    <div class="card mb-3" style="box-shadow: 0 1px 0 0 #d7d8db, 0 0 0 1px #e3e4e8;">
                      <a href="/?category=<?=$category_id;?>&plan=<?=$plan['id'];?>"><img class="card-img-top" style="height: 150px; overflow: hidden;  object-fit: cover;" src="uploads/<?=$category_id;?>/<?=$plan['id'];?>_1_1.jpg"></a>
                      <div class="card-body">
                        <div class="card-title"><h5><a href="/?category=<?=$category_id;?>&plan=<?=$plan['id'];?>" style="color: #506286;"><?=$plan['plan_name'];?></a></h5></div>
                        <ul class="specifications">
                          <li>
                            <span class="text">Общая площадь</span>
                            <span class="info" style="color: #506286;"><b><?=$plan['gross_area'];?> м<sup>2</sup></b></span>
                          </li>
                          <li>
                            <span class="text">Жилая площадь</span>
                            <span class="info" style="color: #506286;"><b><?=$plan['net_area'];?> м<sup>2</sup></b></span>
                          </li>
                          <li>
                            <span class="text">Кол-во спальных комнат</span>
                            <span class="info" style="color: #506286;"><b><?=$plan['bedrooms'];?></b></span>
                          </li>
                          <li>
                            <span class="text">Кол-во сан. узлов</span>
                            <span class="info" style="color: #506286;"><b><?=$plan['bathrooms'];?></b></span>
                          </li>
                          <li>
                            <span class="text">Этажи</span>
                            <span class="info" style="color: #506286;"><b><?=$plan['floors'];?></b></span>
                          </li>
                          <li>
                            <span class="text">Высота</span>
                            <span class="info" style="color: #506286;"><b><?=$plan['height'];?> м</b></span>
                          </li>
                          <li>
                            <span class="text">Ширина</span>
                            <span class="info" style="color: #506286;"><b><?=$plan['width'];?> м</b></span>
                          </li>
                          <li>
                            <span class="text">Длина</span>
                            <span class="info" style="color: #506286;"><b><?=$plan['depth'];?> м</b></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                <?php endwhile;?>
              </div>
            </main>
        <?php elseif(isset($plan_id) AND isset($category_id) AND $plan_category['category'] == $category_id):?>
          <main class="col bg-faded py-4">
            <h5 class="text-uppercase font-weight-bold" style="color: #506286;"><?=$plan_name['plan_name'];?></h5>
            <div class="breadcrumbs mb-4 text-secondary font-italic"><a href="/" class="text-secondary">Главная</a> → <a href="/?category=<?=$category_id;?>" class="text-secondary"><?=$category_name;?></a> → <?=$plan_name['plan_name'];?></div>
            <div class="row">
              <div class="col-md-7 mb-3">
                <h6 class="text-secondary mb-3">Визуализация</h6>
                <?php $images = mysqli_query($conn, "SELECT * FROM plan_images WHERE plan_id = $plan_id AND form = 1");
                  while(($image = mysqli_fetch_assoc($images))): ?>
                    <a href="uploads/<?=$category_id;?>/<?=$plan_id;?>_1_<?=$image['image'];?>.jpg" data-fancybox="gallery"><img src="uploads/<?=$category_id;?>/<?=$plan_id;?>_1_<?=$image['image'];?>.jpg" class="my-1" style="width: 150px; height: 100px; overflow: hidden;  object-fit: cover;"></a>
                <?php endwhile;?>
                <h6 class="text-secondary my-3">Планировка</h6>
                <?php $images = mysqli_query($conn, "SELECT * FROM plan_images WHERE plan_id = $plan_id AND form = 2");
                  while(($image = mysqli_fetch_assoc($images))): ?>
                    <a href="uploads/<?=$category_id;?>/<?=$plan_id;?>_2_<?=$image['image'];?>.jpg" data-fancybox="gallery"><img src="uploads/<?=$category_id;?>/<?=$plan_id;?>_2_<?=$image['image'];?>.jpg" class="my-1" style="width: 150px; height: 100px; overflow: hidden;  object-fit: cover;"></a>
                <?php endwhile;?>
              </div>
              <div class="col-md-5">
                <?php $plans = mysqli_query($conn, "SELECT * FROM plans WHERE id = $plan_id");
                  foreach ($plans as $plan); ?>
                    <ul class="specifications">
                      <li>
                        <span class="text">Общая площадь</span>
                        <span class="info" style="color: #506286;"><b><?=$plan['gross_area'];?> м<sup>2</sup></b></span>
                      </li>
                      <li>
                        <span class="text">Жилая площадь</span>
                        <span class="info" style="color: #506286;"><b><?=$plan['net_area'];?> м<sup>2</sup></b></span>
                      </li>
                      <li>
                        <span class="text">Кол-во спальных комнат</span>
                        <span class="info" style="color: #506286;"><b><?=$plan['bedrooms'];?></b></span>
                      </li>
                      <li>
                        <span class="text">Кол-во сан. узлов</span>
                        <span class="info" style="color: #506286;"><b><?=$plan['bathrooms'];?></b></span>
                      </li>
                      <li>
                        <span class="text">Этажи</span>
                        <span class="info" style="color: #506286;"><b><?=$plan['floors'];?></b></span>
                      </li>
                      <li>
                        <span class="text">Высота</span>
                        <span class="info" style="color: #506286;"><b><?=$plan['height'];?> м</b></span>
                      </li>
                      <li>
                        <span class="text">Ширина</span>
                        <span class="info" style="color: #506286;"><b><?=$plan['width'];?> м</b></span>
                      </li>
                      <li>
                        <span class="text">Длина</span>
                        <span class="info" style="color: #506286;"><b><?=$plan['depth'];?> м</b></span>
                      </li>
                    </ul>
                    <?php if($_SESSION['logged_user']->role == 2):?><div class="pt-4"><?=$plan['link'];?></div><?php endif;?>
              </div>
            </div>
          </main>
        <?php else:?>
          <main class="col bg-faded py-4">
            <div class="row">
              <?php $categories = mysqli_query($conn, "SELECT * FROM plan_categories");
                while (($category = mysqli_fetch_assoc($categories))): ?>
                <div class="col-md-6">
                  <div class="card mb-3" style="box-shadow: 0 1px 0 0 #d7d8db, 0 0 0 1px #e3e4e8;">
                    <a href="/?category=<?=$category['id'];?>"><img class="card-img-top" style="height: 150px; overflow: hidden;  object-fit: cover;" src="img/<?=$category['img'];?>"></a>
                    <div class="card-footer">
                      <a href="/?category=<?=$category['id'];?>" style="color: #506286;" class="font-weight-bold"><?=$category['category'];?></a>
                    </div>
                  </div>
                </div>
              <?php endwhile;?>
            </div>
          </main>
        <?php endif;?>
		</div>
	</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
<!--jQuery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!--Plugin JavaScript file-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
<script src="js/jquery.maskedinput.min.js"></script>
</body>
</html>