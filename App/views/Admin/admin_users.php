<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:/login');
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_users->execute([$delete_id]);
   header('location:/admin_users');

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Utilisateurs</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/admin_style.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="user-accounts">

   <h1 class="title">Comptes utilisateur</h1>

   <div class="box-container">

      <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box" style="<?php if($fetch_users['id'] == $admin_id){ echo 'display:none'; }; ?>">
         <img src="./ressources/uploaded_img/<?= $fetch_users['image']; ?>" alt="">
         <p> Id utilisateur : <span><?= $fetch_users['id']; ?></span></p>
         <p> Nom d'utilisateur : <span><?= $fetch_users['name']; ?></span></p>
         <p> Email : <span><?= $fetch_users['email']; ?></span></p>
         <p> Rôle : <span style=" color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'orange'; }; ?>"><?= $fetch_users['user_type']; ?></span></p>
         <a href="/admin_users?delete=<?= $fetch_users['id']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur?');" class="delete-btn">Supprimer</a>
      </div>
      <?php
      }
      ?>
   </div>

</section>













<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

</body>
</html>