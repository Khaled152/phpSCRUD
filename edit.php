<?php
$error = array();
    //connect to DB
$conn = mysqli_connect("localhost","root","","SCRUD");
if(! $conn){
    echo mysqli_connect_error();
exit;
}

$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$select = "SELECT * FROM `users` WHERE `users`.`id` =".$id." LIMIT 1 ";
$result= mysqli_query($conn,$select);
$row = mysqli_fetch_assoc($result);




if($_SERVER['REQUEST_METHOD']=='POST'){
    //validation 
    if(!(isset($_POST['username']) && ! empty($_POST['username']))){
        $error [] = "username";
    }
    if(!(isset($_POST['email']) && filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL)   )){
        $error[]="email";
    }
    if(!$error){
    
    //Escape any special characters to avoid sql  INJECTION
    $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
    $name = mysqli_escape_string($conn,$_POST['username']);
    $email = mysqli_escape_string($conn,$_POST['email']);
    $admin = (isset($_POST['admin'])) ? 1 : 0;
    //insert data
    $query = "UPDATE  `users` SET  `username` = '".$name."' , `email` = '".$email."', `admin`= ".$admin." WHERE `users`.`id` = ".$id;
    
        if(mysqli_query($conn,$query)){
        header("Location: list.php");
        exit;
    }else{
        echo mysqli_error($conn);
    }
    //close connection 
    mysqli_free_result($result);
    mysqli_close($conn);
}
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container pt-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Admin :: ADD user</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-user-o"></span>
                    </div>
                    <h3 class="text-center mb-4">Sign up</h3>
                    <form method="POST" class="login-form">

                        <div class="form-group mb-4">
                            <input type="text" class="form-control rounded-left" name="username" id="username" placeholder="username" value="<?=(isset($row['username'])) ? $row['username'] : '' ?>" >
                            <?php  if(in_array("username",$error)) echo"Please Enter Name";?>
                        </div>


                        <div class="form-group mb-4">
                            <input type="email" class="form-control rounded-left" name="email" id="email" placeholder="email" value="<?=(isset($row['email'])) ? $row['email'] : '' ?>">
                            <?php if(in_array("email",$error)) echo"Please Enter email";?>
                        </div>




                        <div class="form-group" style="text-align: center; ">
                            <div >
                                <label class="checkbox-wrap checkbox-primary">Admin
                                    <input type="checkbox" name="admin" <?=(isset($row['admin'])) ? 'checked' : '' ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </div>



                        <div class="form-group mb-4">
                            <button type="submit" name="submit"
                                class="form-control btn btn-primary rounded submit px-3">Login</button>
                        </div>
 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>