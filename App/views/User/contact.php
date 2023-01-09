<?php

@include 'config.php';



if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


if(isset($_POST['send'])){
   
   $user_id = $_SESSION['user_id'];
   
   if(!isset($user_id)){
      header('location:/login');
   };

   $name = $_POST['name'];
   $name = htmlspecialchars($name);
   $email = $_POST['email'];
   $email = htmlspecialchars($email);
   $number = $_POST['number'];
   $number = htmlspecialchars($number);
   $msg = $_POST['msg'];
   $msg = htmlspecialchars($msg);

   $select_message = $conn->prepare("SELECT * FROM `message` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = '
      Message déjà envoyé !';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `message`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'Message envoyé avec succès !';

   }

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/style.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">


</head>
<body>
   
<?php include 'header.php'; ?>

<section class="contact">

   <h1 class="title">Entrer en contact avec nous</h1>

   <form action="" method="POST">
      <input type="text" name="name" class="box" required placeholder="Nom complet">
      <input type="email" name="email" class="box" required placeholder="Email">
      <input type="number" name="number" min="0" class="box" required placeholder="Numero de téléphone">
      <textarea name="msg" class="box" required placeholder="Entrer votre message" cols="30" rows="10"></textarea>
      <input type="submit" value="Envoyer message" class="btn" name="send">
   </form>

</section>









<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

<?php include 'footer.php'; ?>

</body>
</html>