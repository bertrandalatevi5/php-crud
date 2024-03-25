<?php
 session_start();
 $error_nom = $error_prix = $error_image = "";
 $nom = $prix =  "";
 
 if(isset($_SESSION['error']))
 {
    if(isset($_SESSION['error']['nom'])){
        $error_nom = $_SESSION['error']['nom'];
    }
    if(isset($_SESSION['error']['prix'])){
        $error_prix = $_SESSION['error']['prix'];
    }
    if(isset($_SESSION['error']['image'])){
        $error_image = $_SESSION['error']['image'];
    }
   
    


 }
 if(isset($_SESSION['data']))
 {
    if(isset($_SESSION['data']['nom'])){
        $nom = $_SESSION['data']['nom'];
    }
    if(isset($_SESSION['data']['prix'])){
        $prix = $_SESSION['data']['prix'];
    }
    if(isset($_SESSION['data']['image'])){
        $image = $_SESSION['data']['image'];
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
                    
                    <form class="row g-3" action="code.php" method= "post" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="nom" value ="<?= $nom?>" aria-label="name">
                            <span class="text-danger"><i><?= $error_nom?></i></span>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label">Prix</label>
                            <input type="number" class="form-control" placeholder="prix" value ="<?= $prix?>" name="prix" id="prix">
                            <span class="text-danger"><i><?= $error_prix?></i></span>
                        </div>
                        <div class="col-md-12">
                            <label for="name" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" >
                            <span class="text-danger"><i><?= $error_image?></i></span>
                        </div>
                       
                        
                        <div class="col-12">
                            <button type="submit" name="create" class="btn btn-primary">Ajouter</button>
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