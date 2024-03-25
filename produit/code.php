<?php
session_start();
require_once 'db_connect.php';
$error = $data = [];

// suppression
if(isset($_POST['delete'])){
    $id = mysqli_real_escape_string($db_connect, $_POST['delete']);
    // verification si l'produit exite
    $query = "SELECT * from produit where id= '$id'";
    $query_run = mysqli_query($db_connect, $query);
    if(mysqli_num_rows($query_run) > 0)
    {
        // mettre a jour
        $query = "DELETE from produit  where id = '$id'";
        
        if(mysqli_query ($db_connect, $query)) 
        {
                $_SESSION['message'] =" produit supprimé avec succès !!!";
                header('location: index.php');
                
        }  
        else  {
                echo "Erreur " ;
        }
    }
    else{
        $_SESSION['error'] = "erreur";
        header("location: index.php");
    }
}
// modification
if(isset($_POST['update'])){

    // verification de l'id
    if(isset($_POST['id'])){
        $id = mysqli_real_escape_string($db_connect, $_POST['id']);
    }
    else{
        $_SESSION['error'] = "erreur";
        header("location: index.php");
        
    }

    // nom
    if(empty($_POST['nom']))
    {
        $error += ['nom' => "veuillez saisir votre nom"] ;
    }else{
        $nom = mysqli_real_escape_string ($db_connect, $_POST['nom']);
        $data += ['nom' => $nom];
    }

    //  prix
    if(empty($_POST['prix']))
    {
    $error += ['prix' => "veuillez saisir le prix du produit"] ;
    }else{
    $prix = mysqli_real_escape_string ($db_connect, $_POST['prix']);
    $data += ['prix' => $prix];
    }

    //partie image
    //var_dump($_FILES['image']['type']);
    if($_FILES['image']['name'] != "")
    {
        $tmp = $_FILES['image']["tmp_name"];
        $imageName = date('y-m-d') . "_"  .$_FILES['image']["name"];
        $folder = "image/".$imageName;
        $filetype = pathinfo($folder,PATHINFO_EXTENSION);
        // extensions autorisées
        $allow_ext = ["jpg", 'png', 'jpeg'];
        if(!in_array($filetype, $allow_ext))
        {
            $error += ["image"=> "seul les fichiers 'jpg', 'png' et 'jpeg' "];
        }elseif($_FILES['image']['size'] >5000000)/*taille de l'image */
        {
            $error += ["image"=> "taille de l'image doit être inférieur à 5mb"];
        }
    }


    // modification
    if(empty($error)){
       
        // verification si le produit exite
        $query = "SELECT * from produit where id= '$id'";
        $query_run = mysqli_query($db_connect, $query);
        if(mysqli_num_rows($query_run) > 0)
        {
            $produit = mysqli_fetch_assoc($query_run);
            $imagePath = "image/".$produit['image'];
            
            if($_FILES['image']['name'] == "")
            {
                //garder l'ancienne image
                $imageName = $produit['image'];
            }else{
                //supprimer l'ancienne image
                unlink($imagePath);
                //uploader la nouvelle image
                move_uploaded_file($tmp, $folder);
            }
            // mettre a jour
            $query = "UPDATE produit set nom ='$nom', prix = '$prix', image = '$imageName' 
             where id = '$id'";
            
            if(mysqli_query($db_connect, $query)) 
            {
                    $_SESSION['message'] =" produit modifié avec succès !!!";
                    header('location: index.php');
                    
            }  
            else  {
                    echo "Erreur " ;
            }
        }
        else{
            $_SESSION['error'] = "erreur";
            header("location: index.php");
        }
        
    }else{
        $_SESSION ['error' ] = $error;
        $_SESSION ['data' ] = $data;
        header('location: create.php');
    }

    
}    



// insertion
if(isset($_POST['create'])){
    // nom
    if(empty($_POST['nom']))
    {
        $error += ['nom' => "veuillez saisir votre nom"] ;
    }else{
        $nom = mysqli_real_escape_string ($db_connect, $_POST['nom']);
        $data += ['nom' => $nom];
    }

   //  prix
   if(empty($_POST['prix']))
   {
       $error += ['prix' => "veuillez saisir le prix du produit"] ;
   }else{
       $prix = mysqli_real_escape_string ($db_connect, $_POST['prix']);
       $data += ['prix' => $prix];
   }

   //partie image
   //var_dump($_FILES['image']['type']);
   if($_FILES['image']['type'] == "")
   {
    $error += ["image" => "veuillez choisir une image"];
   }else{
    $tmp = $_FILES['image']["tmp_name"];
    $imageName = date('y-m-d') . "_"  .$_FILES['image']['name'];
    $folder = "image/".$imageName;
    $filetype = pathinfo($folder,PATHINFO_EXTENSION);

   }
   // extensions autorisées
   $allow_ext = ["jpg", 'png', 'jpeg'];
   if(!in_array($filetype, $allow_ext))
   {
    $error += ["image"=> "seul les fichiers 'jpg', 'png' et 'jpeg' "];
   }elseif($_FILES['image']['size'] >5000000)/*taille de l'image */
   {
    $error += ["image"=> "taille de l'image doit être inférieur à 5mb"];
   }
   

   
    // insertion a la db
    if(empty($error)){
       
        $query = ("INSERT into produit (nom, prix, image) values ('$nom', '$prix', '$imageName')");
            
        if(mysqli_query ($db_connect, $query)) 
        {     // déplacer l'image vers le dossier image
                move_uploaded_file($tmp, $folder);

                $_SESSION['message'] =" Produit ajouté avec succès !";
                header('location: index.php');
                
        }  
        else  {
                echo "Erreur " ;
        }
        
    }else{
        $_SESSION ['error' ] = $error;
        $_SESSION ['data' ] = $data;
        header('location: create.php');
    }

    
        
}



?>