<?php  
include 'baglan.php';  

$vericek=$db->query("SELECT * FROM bot", PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Sociality.io</title>
  </head>
  <body>
    <h1>Sociality.io Software Developer Intern Project - Sinan SINIK</h1>
    <br>

  <form action="bot.php" method="POST">
  <div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Veriyi Çekmek istediğiniz Ürün Linkini Giriniz" name="url">
    <div class="input-group-append">
      <button class="btn btn-outline-primary" type="submit" name="getir" value="getir">Get Data!</button>
    </div>
  </div>
  </form>
  <br>
  <h4>The data registered in the database are displayed below.</h4>
  
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
  <?php 
  foreach ($vericek as $veriyaz) {?>
    <tr>
      <th scope="row"><?php echo $veriyaz['id']?></th>
      <td><?php echo $veriyaz['product']?></td>
      <td><?php echo $veriyaz['price']?></td>
      <td><a href="<?php echo $veriyaz['images']?>" target="_blank"><?php echo $veriyaz['images']?></a></td>
    </tr>
    <?php }
  ?>
    
  </tbody>
</table>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>
