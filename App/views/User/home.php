<?php

// @include 'config.php';
use App\Controllers\Connexion;
use App\Controllers\ProductController;
use App\Controllers\CardController;







// if(isset($_POST['add_to_wishlist'])){

//    $user_id = $_SESSION['user_id'];
//    if(!isset($user_id)){
//          header('location:/login');
//       }

//    $pid = $_POST['pid'];
//    $pid = htmlspecialchars($pid);
//    $p_name = $_POST['p_name'];
//    $p_name = htmlspecialchars($p_name);
//    $p_price = $_POST['p_price'];
//    $p_price = htmlspecialchars($p_price);
//    $p_image = $_POST['p_image'];
//    $p_image = htmlspecialchars($p_image);

//    $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
//    $check_wishlist_numbers->execute([$p_name, $user_id]);

//    $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
//    $check_cart_numbers->execute([$p_name, $user_id]);

//    if($check_wishlist_numbers->rowCount() > 0){
//       $message[] = "Déjà ajouté à la liste d'envie !";
//    }elseif($check_cart_numbers->rowCount() > 0){
//       $message[] = 'Déjà ajouté au panier !';
//    }else{
//       $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
//       $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
//       $message[] = 'Ajouté à la liste d\'envie !';
//    }

// }


?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Page d'accueil</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../ressources/css/style.css">
   <link rel="stylesheet" href="../ressources/css/footer.css">



</head>
<body>
   
<?php include 'header.php'; ?>

<div class="home-bg">
   
   <section class="home">

      <div class="content">
      
         <span>Un Hamburgé, c'est comme un burger...</span>
         <h2>MAIS EN BIEN MEILLEUR !</h2>
         <p>Un pain du boulanger frais et du matin.</p>
         <p>Une viande de race cuite à votre convenance.</p>
         <a href="/about" class="btn">A propos</a>
      </div>

      <figure class="hero-banner">
            <img src="../ressources/images/hero-banner-bg.png" width="820" height="716" alt="" aria-hidden="true"
              class="w-100 hero-img-bg">
            <img src="../ressources/images/hero-banner.png" loading="lazy" alt="Burger"
              class="w-100 hero-img">
          </figure>


   </section>

</div>
 <!-- 
        - #CATEGORY
      -->

      <section class="section section-divider white promo">
        <div class="container">

        <h1 class="title">Nos Hamburgés</h1>
        <p>C'est comme des burgers, mais en bien meilleur ! </p>
        <h2>Catégories</h2>
          <ul class="promo-list has-scrollbar">

            <li class="promo-item">
              <div class="promo-card">
                <h3 class="h3 card-title">Nos Hamburgés</h3>
                
                <p class="card-text">
               </p>

                <img src="../ressources/images/promo-3.png" width="300" height="300" loading="lazy" alt="Le Victor"
                  class="w-100 card-banner">

                  <a href="/category?category=hamburges" class="btn">Hamburgés</a>
              </div>
            </li>

            <li class="promo-item">
              <div class="promo-card">


                <h3 class="h3 card-title">A côté</h3>

                <p class="card-text">
                  
                </p>

                <img src="../ressources/images/img-fernandines.png" width="300" height="300" loading="lazy" alt="Le Bartholomé"
                  class="w-100 card-banner">

                  <a href="/category?category=a-cote" class="btn">A-côté</a>

              </div>
            </li>

            <li class="promo-item">
              <div class="promo-card">

                <h3 class="h3 card-title">Desserts</h3>

                <p class="card-text">
                  
                </p>

                <img src="../ressources/images/img-fondantbaulois.png" width="300" height="300" loading="lazy" alt="Le Paulette"
                  class="w-100 card-banner">

                  <a href="/category?category=desserts" class="btn">Desserts</a>

              </div>
            </li>

            <li class="promo-item">
              <div class="promo-card">
                <h3 class="h3 card-title">Boissons</h3>

                <p class="card-text">
                 
                </p>

                <img src="../ressources/images/img-elixir.png" width="300" height="300" loading="lazy" alt="Le Big Fernand"
                  class="w-100 card-banner">

                  <a href="/category?category=boissons" class="btn">Boissons</a>

              </div>
            </li>

          </ul>

        </div>
      </section>

<section class="products">

   <h1 class="title">Nouveaux produits</h1>

   <div class="box-container">

   <?php
      $fetch_products = ProductController::getProduct();

      if (isset($fetch_products)) {
         foreach ($fetch_products as $key => $value) {
            
   ?>
      <form action="Card/infoCard" class="box" method="POST">
         <div class="price"><span><?= $value['price']; ?></span>€</div>
         <a href="/views?pid=<?= $value['id']; ?>" class="fas fa-eye"></a>
         <img src="../ressources/uploaded_img/<?= $value['image']; ?>" alt="">
         <div class="name"><?= $value['name']; ?></div>
         <input type="hidden" name="pid" value="<?= $value['id']; ?>">
         <input type="hidden" name="p_name" value="<?= $value['name']; ?>">
         <input type="hidden" name="p_price" value="<?= $value['price']; ?>">
         <input type="hidden" name="p_image" value="<?= $value['image']; ?>">
         <input type="hidden" type="number" min="1" value="1" name="p_qty" class="qty">
         <input type="submit" value="Ajouter à la liste d'envie" class="option-btn" name="add_to_wishlist">
         <input type="submit" value="Ajouter au panier" class="btn" name="add_to_cart">
      </form>
   <?php
      }

      }else {
         echo '<p class="empty">Aucun produit ajouté pour le moment !</p>';
      }
      
      ?>

   </div>

</section>








<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

<?php include 'footer.php'; ?>

</body>
</html>