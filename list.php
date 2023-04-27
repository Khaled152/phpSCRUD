<?php

//connect Mysql
$conn = mysqli_connect("localhost","root","","SCRUD");
if(! $conn){
    echo mysqli_connect_error();
    exit;
}
//select all users
$result =mysqli_query($conn,"SELECT * FROM `users`");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> List User </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid " style="justify-content: center;">
            <a class="navbar-brand" href="#">
                <h1>List Users</h1>
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Admin</th>
                    <th scope="col">ACtion</th>

                </tr>
            </thead>
            <tbody>
                <!--show data by while statment-->
                <?php while($row = mysqli_fetch_assoc($result)){?>
                <tr>
                    <th>
                        <?=$row['id']?>
                    </th>
                    <td>
                        <?=$row['username']?>
                    </td>
                    <td>
                        <?=$row['email']?>
                    </td>
                    <td>
                        <?=$row['admin'] ? 'yes' : 'No'  ?>
                    </td>
                    <td><a href="edit.php?id=<?=$row['id']?>" class="btn btn-primary">Edit</a> <a
                            href="delete.php?id=<?=$row['id']?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="text-align: center;">count:
                        <?= mysqli_num_rows($result)?> users
                    </td>
                    <td colspan="3" style="text-align: center;"><a href="add.php" class="btn btn-success">ADD</a></td>

                </tr>
            </tfoot>
        </table>


    </div>
    <?php
//close database connection
mysqli_free_result($result);
mysqli_close($conn);
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
        crossorigin="anonymous"></script>
</body>

</html>