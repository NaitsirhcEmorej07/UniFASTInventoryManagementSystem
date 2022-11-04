<?php
//If there's no session, start a new session
if(!isset($_SESSION))
{
    session_start();
}


include ("connections/db-connect.php");

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "select * FROM user_tbl where username = '$username' and password ='$password'";
    $user = $conn->query($sql) or die ($conn->error);
    $row = $user->fetch_assoc();
    $total = $user->num_rows;

    if($total>0) 
    {
        $sql1 = "update user_tbl set status='1' where username = '$username' and password ='$password' ";
        $conn->query($sql1) or die ($conn->error); 

        $_SESSION['user_login'] = $row['username'];
        $_SESSION['session_full_name'] = $row['full_name'];
        $_SESSION['session_designation'] = $row['designation'];
        echo header("Location: navbar.php");
    }
    else
    {
        echo '<script>alert("Wrong username or password!")</script>';
    }
    
}

//If there is an existing session redirect to dashboard!
if(isset($_SESSION['user_login']))
{
    echo header("Location: chart.php"); 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="background-color: #e3f2fd;">

       <div class="container-fluid mt-2 py-5">
            <div class="row">
                <div class="col-10 col-sm-8 col-lg-4 m-auto">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            
                            <!-- SVG ICONS-->
                            <div class="mt-3" style="text-align:center;">
                                <img src="img/unifast-web-logo.png" alt="" width="190" height="190">
                                </br>
                                <h3 class="mt-3">Inventory Management System</h3>
                            </div>


                            <form action="" method="post">
                                <input type="text" name="username" id="" class="form-control my-3 py-2" placeholder="Username" style="border-radius:12px;" autocomplete="off">
                                <input type="password" name="password" id="" class="form-control my-3 py-2" placeholder="Password" style="border-radius:12px;" autocomplete="off">
                               
                                <div class="text-center d-grid mt-3 mb-4">
                                    <button class="btn btn-primary" name="login" style="border-radius:12px;">Login</button>
                                    <!-- <a href="" class="nav-link">Forgot password?</a> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    
</body>
</html>