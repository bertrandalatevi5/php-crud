<?php
require_once "db_connect.php";
session_start();
$message = "";
if(isset($_SESSION['message']))
{
    $message = $_SESSION['message'];
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
        <div class="mx-auto my-auto">
            <div class="card my-5 mx-auto shadow">
                <div class="card-header">
                    <?php
                    if($message !=null)
                    {
                    ?>
                        <div class="alert alert-success">
                            <h5>
                                <?=$message?>
                            </h5>
                        </div>
                    <?php
                    unset($_SESSION['message']);
                    }
                    ?>
                    <h4>Liste des employés 
                        <a href="create.php" class="mb-2 btn btn-primary btn-sm float-end">Ajouter</a>
                    </h4>
                </div>
                <div class="card-body" style="overflow-x:scroll;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Address</th>
                                <th>Age</th>
                                <th>Salaire</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * from employes ORDER By created_at DESC";
                        $query_run = mysqli_query($db_connect, $query);
                        // nombre de ligne sur la table employes
                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $employes)
                                {
                        ?>
                            <tr>
                                    <td><?= $employes['id'];?></td>
                                    <td><?= $employes['nom'];?></td>
                                    <td><?= $employes['email'];?></td>
                                    <td><?= $employes['telephone'];?></td>
                                    <td><?= $employes['address'];?></td>
                                    <td><?= $employes['age'];?></td>
                                    <td><?= $employes['salaire'];?></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="view.php?id=<?= $employes['id']?>" class="me-3"><i class="bi bi-eye-fill"></i></i></a>
                                            <a href="edit.php?id=<?= $employes['id']?>" class="me-2"><i class="bi bi-pencil-square"></i></a>
                                            <form action="code.php" method="post">
                                                <button type="submit" name="delete" class="border-0 bg-transparent 
                                                text-danger" value="<?= $employes['id']?>" onclick="return confirm('etes vous sur de supprimer <?= $employes['nom'];?> ?');"><i class="bi bi-trash3-fill"></i></button>
                                            </form>
                                        </div>
                                    </td>
                            </tr>
                        <?php
                                }
                            }
                            else
                            {
                                echo "<td colspan='6' class='text-center'> Pas de données trouvées</td>";
                            }

                        ?>  
                        </tbody>
                    </table>
                </div>
                
                        
                    
                    
                

            </div>

        </div>
    </div>
    




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>