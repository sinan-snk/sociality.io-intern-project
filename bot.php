<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Sociality.io</title>
  </head>
<?php

include 'baglan.php'; 

if (isset($_POST['getir'])) {
$url = $_POST['url'];
$veri = file_get_contents($url);
preg_match_all('@<h1 class="wt-text-body-03 wt-line-height-tight wt-break-word wt-mb-xs-1" data-buy-box-listing-title="true">(.*?)</h1>@si',$veri,$baslik);
preg_match_all('@<p class="wt-text-title-03 wt-mr-xs-2">(.*?)</p>@si',$veri,$fiyat);
preg_match_all('@src="https://i.etsystatic.com/(.*?)"@si',$veri,$foto);


$isim=ltrim($baslik[1][0]);
$para=ltrim($fiyat[1][0]);
$fotoyol="https://i.etsystatic.com/".$foto[1][7];

if ($isim==null){
  ?>
    <div class="alert alert-danger" role="alert">
    You have entered an incorrect product page. Click <a href="index.php" class="alert-link">here</a> to return to the homepage.
</div>
    <?php exit;
}


  $kontrol=$db->prepare("SELECT * FROM bot WHERE product = ? ");
  $kontrol->execute(array($isim));
  if($kontrol->rowCount()){ ?>
  <div class="alert alert-warning" role="alert">
  These data have already been taken. You can access the data below. Click <a href="index.php" class="alert-link">here</a> o make a new query.
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product Name</th>
      <th scope="col">Price</th>
      <th scope="col">Image</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><?php echo $isim?></td>
      <td><?php echo $para?></td>
      <td><a href="<?php echo $fotoyol ?>"target="_blank"><?php echo $fotoyol ?></a></td>
    </tr>
  </tbody>
</table>
  </div>
  <?php exit;}
  else {
  $kaydet=$db->prepare("INSERT INTO bot SET
  product=:product,
  images=:images,
  price=:price");
  $insert=$kaydet->execute(array(
    'product'=>$isim,
    'images'=>$fotoyol,
    'price'=>$para,
  ));
  }
  if($insert){
?>
    <div class="alert alert-success" role="alert">
    Data import was successful. The imported data is shown below. Click <a href="index.php" class="alert-link">here</a> to return to homepage.
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product Name</th>
      <th scope="col">Price</th>
      <th scope="col">Image</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><?php echo $isim?></td>
      <td><?php echo $para?></td>
      <td><a href="<?php echo $fotoyol ?>"target="_blank"><?php echo $fotoyol ?></a></td>
    </tr>
  </tbody>
</table>
    </div>
    <?php
  }
  else {?>
    <div class="alert alert-danger" role="alert">
    Data could not be pulled. Error message <?php echo ($insert->ErrorInfo)?>. Click <a href="index.php" class="alert-link">here</a> to return to the homepage.
</div>
    <?php
    echo ($insert->ErrorInfo);
  }

}
?>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>
