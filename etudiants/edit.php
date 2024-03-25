<?php
 session_start();
 require_once 'db_connect.php';
 $error_nom = $error_email = $error_telephone= $error_address = $error_cours = $error_dates = "";
 

 if(!isset($_GET['id']))
        {
            header("location: index.php");
        }
        $etudiant_id = mysqli_real_escape_string($db_connect, $_GET['id']);
        $query = "SELECT * from etudiants where id= '$etudiant_id'";
        $query_run = mysqli_query($db_connect, $query);
        if(mysqli_num_rows($query_run) > 0)
        {
            $etudiant = mysqli_fetch_array($query_run);
        }
        else{
            header("location: index.php");
        }

 
 if(isset($_SESSION['error']))
 {
    if(isset($_SESSION['error']['nom'])){
        $error_nom = $_SESSION['error']['nom'];
    }
    if(isset($_SESSION['error']['email'])){
        $error_email = $_SESSION['error']['email'];
    }
    if(isset($_SESSION['error']['telephone'])){
        $error_telephone = $_SESSION['error']['telephone'];
    }
    if(isset($_SESSION['error']['address'])){
        $error_address = $_SESSION['error']['address'];
    }
    if(isset($_SESSION['error']['cours'])){
        $error_cours = $_SESSION['error']['cours'];
    }
    if(isset($_SESSION['error']['dates'])){
        $error_dates =  $_SESSION['error']['dates'];
    }
    


 }
 if(isset($_SESSION['data']))
 {
    if(isset($_SESSION['data']['nom'])){
        $nom = $_SESSION['data']['nom'];
    }
    if(isset($_SESSION['data']['email'])){
        $email = $_SESSION['data']['email'];
    }
    if(isset($_SESSION['data']['telephone'])){
        $telephone = $_SESSION['data']['telephone'];
    }
    if(isset($_SESSION['data']['address'])){
        $address = $_SESSION['data']['address'];
    }
    if(isset($_SESSION['data']['cours'])){
        $cours = $_SESSION['data']['cours'];
    }
    if(isset($_SESSION['data']['dates'])){
        $dates = $_SESSION['data']['dates'];
    }

 }
        
    

    
    
   





?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="col-md-9 mx-auto my-auto">
            <div class="card my-5 mx-auto shadow">
                <div class="card-body mb-3">
                    <h4>Formulaire
                        <a href="index.php" class="mb-2 btn btn-primary btn-sm float-end">Retour</a>
                    </h4>
                    
                    <form class="row g-3" action="code.php" method= "post">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="nom" value ="<?= $etudiant['nom']?>" aria-label="name">
                            <span class="text-danger"><i><?= $error_nom?></i></span>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Email" value ="<?= $etudiant['email']?>" name="email" id="email">
                            <span class="text-danger"><i><?= $error_email?></i></span>
                        </div>
                        <div class="col-md-6">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="number" class="form-control" name="telephone" value ="<?= $etudiant['telephone']?>" id="telephone">
                            <span class="text-danger"><i><?= $error_telephone?></i></span>
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" value ="<?= $etudiant['address']?>" id="address">
                            <span class="text-danger"><i><?= $error_address?></i></span>
                        </div>
                        <div class="col-md-6">
                            <label for="cours" class="form-label">Cours</label>
                            <input type="text" class="form-control" name="cours" value ="<?= $etudiant['cours']?>" id="cours">
                            <span class="text-danger"><i><?= $error_cours?></i></span>
                        </div>
                        <div class="col-md-6">
                            <label for="dates" class="form-label">Date de naissance</label>
                            <input type="text" class="form-control" name="dates"  value ="<?= $etudiant['dates']?>" id="dates">
                            <span class="text-danger"><i><?= $error_dates?></i></span>
                        </div>
                        <input type="hidden" name="id" value="<?= $etudiant['id']?>">
                        
                        <div class="col-12">
                            <button type="submit" name="update" class="btn btn-primary">Modifier</button>
                        </div>
                    </form>

                </div>

            </div>
        
        </div>
        
    </div>
    




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
<?php unset($_SESSION['error']);unset($_SESSION['data'])?>