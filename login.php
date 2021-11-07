<!DOCTYPE HTML>
<html>
    <head>
        <title>Halaman Login</title>
         <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
    </head>

    <body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                <!-- form login Card Body -->
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">ADMIN PERPUSTAKAAN</h1>
                    </div>
                    <form method="post" action="cek_login.php">
            <div class="form-group mb-3">
            <label>Username</label>
            <input type="text" name="user" class="form-control">
        
            </div>
            <div class="form-group mb-3">
            <label>Password</label>
            <input type="password" name="pass" class="form-control">
            </div>
                <button type="submit"  class="btn btn-primary" name="submit">Log in</button>				
            </form>

                </div>
                </div>
            </div>
        </div>
    </div>
    
    </body>
</html>

