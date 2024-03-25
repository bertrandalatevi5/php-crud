<?php 
        session_start();
        require_once "db_connect.php";
        if(!isset($_GET['id']))
        {
            header("location: index.php");
        }
        $produit_id = mysqli_real_escape_string($db_connect, $_GET['id']);
        $query = "SELECT * from produit where id= '$produit_id'";
        $query_run = mysqli_query($db_connect, $query);
        if(mysqli_num_rows($query_run) > 0)
        {
            $produit = mysqli_fetch_array($query_run);
        }
        else{
            header("location: index.php");
        }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="col-md-8 mx-auto my-auto">
        <div class="card mt-5">
            <div class="card-header">
                <h4>
                    information sur <small><i><?= $produit['nom']?></i></small>
                    <a href="index.php" class="mb-2 btn btn-primary btn-sm float-end">Retour</a>
                </h4>
            </div>
            <div class="card-body ">
                <ul class="list-group">
                    <li class="list-group-item mb-2">
                        <b>Nom :</b><span class="float-end"><?= $produit['nom']?></span>
                    </li>
                    <li class="list-group-item mb-2">
                        <b>Prix :</b><span class="float-end"><?= $produit['prix']?></span>
                    </li>
                    <li class="list-group-item mb-2">

                        <b>Image :</b>
                        <span class="float-end">
                            <a href="image/<?= $produit['image']?>">
                            <img src="image/<?= $produit['image']?>"
                            style="height:100px; width:100px;" class="object-fit-cover"></a>
                        </span>
                    </li>
                    <li class="list-group-item mb-2">
                            <button type="submit" name="update" class="btn btn-primary">Acheter</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>