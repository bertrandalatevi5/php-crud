<?php
session_start();
require_once 'db_connect.php';
$error = $data = [];

// suppression
if(isset($_POST['delete'])){
    $id = mysqli_real_escape_string($db_connect, $_POST['delete']);
    // verification si l'employes exite
    $query = "SELECT * from employes where id= '$id'";
    $query_run = mysqli_query($db_connect, $query);
    if(mysqli_num_rows($query_run) > 0)
    {
        // mettre a jour
        $query = "DELETE from employes  where id = '$id'";
        
        if(mysqli_query ($db_connect, $query)) 
        {
                $_SESSION['message'] =" Employé supprimé avec succès !!!";
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

    // email
    if(empty($_POST['email']))
    {
        $error += ['email' => "veuillez saisir votre email"] ;
    }else{
        $email = mysqli_real_escape_string ($db_connect, $_POST['email']);
        $data += ['email' => $email];
    }
    
    //  telephone
    if(empty($_POST['telephone']))
    {
        $error += ['telephone' => "veuillez saisir votre numero de telephone"] ;
    }else{
        $telephone = mysqli_real_escape_string ($db_connect, $_POST['telephone']);
        $data += ['telephone' => $telephone];
    }
    // address
    if(empty($_POST['address']))
    {
        $error += ['address' => "veuillez saisir votre address"] ;
    }else{
        $address = mysqli_real_escape_string ($db_connect, $_POST['address']);
        $data += ['address' => $address];
    }
    // age
    if(empty($_POST['age']))
    {
        $error += ['age' => "veuillez saisir votre age"] ;
    }else{
        $age = mysqli_real_escape_string ($db_connect, $_POST['age']);
        $data += ['age' => $age];
    }
    // salaire
    if(empty($_POST['salaire']))
    {
        $error += ['salaire' => "veuillez saisir votre salaire"] ;
        
    }else{
        $salaire = mysqli_real_escape_string ($db_connect, $_POST['salaire']);
        $data += ['salaire' => $salaire];
    }
    // insertion a la db
    if(empty($error)){
       
        // verification si l'employes exite
        $query = "SELECT * from employes where id= '$id'";
        $query_run = mysqli_query($db_connect, $query);
        if(mysqli_num_rows($query_run) > 0)
        {
            // mettre a jour
            $query = "UPDATE employes set nom ='$nom', email = '$email', telephone = '$telephone', address = '$address', 
            age = '$age', salaire = '$salaire' where id = '$id'";
            
            if(mysqli_query ($db_connect, $query)) 
            {
                    $_SESSION['message'] =" Employé modifié avec succès !!!";
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

    // email
    if(empty($_POST['email']))
    {
        $error += ['email' => "veuillez saisir votre email"] ;
    }else{
        $email = mysqli_real_escape_string ($db_connect, $_POST['email']);
        $data += ['email' => $email];
    }
    
    //  telephone
    if(empty($_POST['telephone']))
    {
        $error += ['telephone' => "veuillez saisir votre numero de telephone"] ;
    }else{
        $telephone = mysqli_real_escape_string ($db_connect, $_POST['telephone']);
        $data += ['telephone' => $telephone];
    }
    // address
    if(empty($_POST['address']))
    {
        $error += ['address' => "veuillez saisir votre address"] ;
    }else{
        $address = mysqli_real_escape_string ($db_connect, $_POST['address']);
        $data += ['address' => $address];
    }
    // age
    if(empty($_POST['age']))
    {
        $error += ['age' => "veuillez saisir votre age"] ;
    }else{
        $age = mysqli_real_escape_string ($db_connect, $_POST['age']);
        $data += ['age' => $age];
    }
    // salaire
    if(empty($_POST['salaire']))
    {
        $error += ['salaire' => "veuillez saisir votre salaire"] ;
        
    }else{
        $salaire = mysqli_real_escape_string ($db_connect, $_POST['salaire']);
        $data += ['salaire' => $salaire];
    }
    // insertion a la db
    if(empty($error)){
       
        $query = ("INSERT into employes (nom, email, telephone, address, age, salaire) values ('$nom', '$email', '$telephone', '$address', '$age', '$salaire')");
            
        if(mysqli_query ($db_connect, $query)) 
        {
                $_SESSION['message'] =" Inscription réussie !! vous avez bien été enregistré";
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