<?php
session_start();
require_once 'db_connect.php';
$error = $data = [];

// suppression
if(isset($_POST['delete'])){
    $id = mysqli_real_escape_string($db_connect, $_POST['delete']);
    // verification si l'etudiant exite
    $query = "SELECT * from etudiants where id= '$id'";
    $query_run = mysqli_query($db_connect, $query);
    if(mysqli_num_rows($query_run) > 0)
    {
        // mettre a jour
        $query = "DELETE from etudiants  where id = '$id'";
        
        if(mysqli_query ($db_connect, $query)) 
        {
                $_SESSION['message'] =" Etudiant supprimé avec succès !!!";
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
    // cours
    if(empty($_POST['cours']))
    {
        $error += ['cours' => "veuillez saisir votre cours"] ;
    }else{
        $cours = mysqli_real_escape_string ($db_connect, $_POST['cours']);
        $data += ['cours' => $cours];
    }
    // date
    if(empty($_POST['dates']))
    {
        $error += ['dates' => "veuillez saisir votre dates de naissance"] ;
        
    }else{
        $dates = mysqli_real_escape_string ($db_connect, $_POST['dates']);
        $data += ['dates' => $dates];
    }
    // insertion a la db
    if(empty($error)){
       
        // verification si l'etudiants exite
        $query = "SELECT * from etudiants where id= '$id'";
        $query_run = mysqli_query($db_connect, $query);
        if(mysqli_num_rows($query_run) > 0)
        {
            // mettre a jour
            $query = "UPDATE etudiants set nom ='$nom', email = '$email', telephone = '$telephone', address = '$address', 
            cours = '$cours', dates = '$dates' where id = '$id'";
            
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
    // cours
    if(empty($_POST['cours']))
    {
        $error += ['cours' => "veuillez saisir votre cours"] ;
    }else{
        $cours = mysqli_real_escape_string ($db_connect, $_POST['cours']);
        $data += ['cours' => $cours];
    }
    // dates
    if(empty($_POST['dates']))
    {
        $error += ['dates' => "veuillez saisir votre dates"] ;
        
    }else{
        $dates = mysqli_real_escape_string ($db_connect, $_POST['dates']);
        $data += ['dates' => $dates];
    }
    // insertion a la db
    if(empty($error)){
       
        $query = ("INSERT into etudiants (nom, email, telephone, address, cours, dates) values ('$nom', '$email', '$telephone', '$address', '$cours', '$dates')");
            
        if(mysqli_query ($db_connect, $query)) 
        {
                $_SESSION['message'] =" Inscription reussite vous avez bien été enregistrer !!!";
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