<?php

@include 'config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:/');

};

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:/login');
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Commandes</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/style.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">


</head>
<body>
   
<?php include 'header.php'; ?>

<section class="placed-orders">

   <h1 class="title">Commandes passées</h1>

   <div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <p> Effectuée le : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> Nom : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> Numero : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> Email : <span><?= $fetch_orders['email']; ?></span> </p>
      <p> Adresse : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> Mode de paiement : <span><?= $fetch_orders['method']; ?></span> </p>
      <p> Vos commandes : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> Prix total : <span><?= $fetch_orders['total_price']; ?>€</span> </p>
      <p> Statut de paiement : <span style="color:<?php if($fetch_orders['payment_status'] == 'En attente'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">Aucune commandes passées!</p>';
   }
   ?>

   </div>

</section>










<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

<?php include 'footer.php'; ?>

</body>
</html>