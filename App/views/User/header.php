<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>




<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Big<span>Burger+</span></a>

      <nav class="navbar">
         <a href="/">Accueil</a>
         <a href="route/shop">Boutique</a>
         <a href="route/orders">Commande</a>
         <a href="route/about">A-propos</a>
         <a href="route/contact">Contact</a>
      </nav>

      <div class="icons"  >
         <div id="menu-btn"  class="fas fa-bars" ></div>
         <div id="user-btn"  class="fas fa-user"></div>
         <a href="/search" ><i class="fas fa-search"></i></a>
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
         ?>
         <a href="/wishlist" class='wishlist'>
            <i class="fas fa-heart"></i>
            <span ><?= $count_wishlist_items->rowCount(); ?></span>
         </a>
         <a href="/card" class='card'>
            <i class="fas fa-shopping-cart"></i>
            <span ><?= $count_cart_items->rowCount(); ?></span>
         </a>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);

            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="./ressources/uploaded_img/<?= $fetch_profile['image']; ?>" alt="">

         
         <p><?= $fetch_profile['name']; ?></p>
         <a href="/user_profile_update" class="btn">Mise à jour/ Profile</a>
         <a href="/logout" class="delete-btn">Se déconnecter</a>
         
         <?php
            }else{
         ?>
            <p class="flex-btn">Connectez-vous pour une meilleure expérience! 😋</p>
            <a href="/login" class="btn">Se connecter</a>
         <?php
          }
         ?>
      </div>

   </div>

</header>