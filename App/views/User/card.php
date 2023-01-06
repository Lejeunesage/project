<?php

@include 'config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:/home');
}

// $user_id = $_SESSION['user_id'];

// if(!isset($user_id)){
//    header('location:/login');
// };

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$delete_id]);
   header('location:/card');
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:/card');
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $p_qty = $_POST['p_qty'];
   $p_qty = htmlspecialchars($p_qty);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$p_qty, $cart_id]);
   $message[] = 'Quantité du panier mise à jour';
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Panier</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/style.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="shopping-cart">

   <h1 class="title">Produits ajoutés</h1>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="POST" class="box">
      <a href="/card?delete=<?= $fetch_cart['id']; ?>" 
         onclick="return confirm('Supprimer ceci du panier ?');">
      
         <i class="fas fa-times" ></i>

   </a>
      <a href="/views?pid=<?= $fetch_cart['pid']; ?>" >
      <i class="fas fa-eye" ></i>

      </a>
      <img src="./ressources/uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
      <div class="name"><?= $fetch_cart['name']; ?></div>
      <div class="price"><?= $fetch_cart['price']; ?>€</div>
      <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
      <div class="flex-btn">
         <input type="number" min="1" value="<?= $fetch_cart['quantity']; ?>" class="qty" name="p_qty">
         <input type="submit" value="Mettre à jour" name="update_qty" class="option-btn">
      </div>
      <div class="sub-total"> Sous-total : <span><?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>€</span> </div>
   </form>
   <?php
      $grand_total += $sub_total;
      }
   }else{
      echo '<p class="empty">Votre panier est vide</p>';
   }
   ?>
   </div>

   <div class="cart-total">
      <p>Grand total : <span><?= $grand_total; ?>€</span></p>
      <a href="/shop" class="option-btn">Continuer vos achats</a>
      <a href="/card?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>">Supprimer tout</a>
      <a href="/checkout" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Passer à la caisse</a>
   </div>

</section>









<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

<?php include 'footer.php'; ?>

</body>
</html>