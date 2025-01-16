<?php
// Start or resume the session
session_start();

// Include the database connection file
include "koneksi.php";

// Check if the user is already logged in, redirect to admin page if true
if (isset($_SESSION['username'])) { 
  header("location:admin.php"); 
  exit();
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = md5($_POST['password']); // Encrypt the password using md5

  // Prepare the SQL statement
  $stmt = $conn->prepare("SELECT username FROM user WHERE username=? AND password=?");

  // Bind the parameters
  $stmt->bind_param("ss", $username, $password);

  // Execute the statement
  $stmt->execute();

  // Get the result
  $hasil = $stmt->get_result();

  // Fetch the row as an associative array
  $row = $hasil->fetch_array(MYSQLI_ASSOC);

  // Check if a matching user was found
  if (!empty($row)) {
    // Save the username in the session
    $_SESSION['username'] = $row['username'];

    // Redirect to the admin page
    header("location:admin.php");
    exit();
  } else {
    // Redirect back to the login page on failure
    header("location:login.php");
    exit();
  }

  // Close the statement and connection
  $stmt->close();
  $conn->close();
} else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | My Daily Journal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="icon" href="img/logo.png" />
</head>

<body class="bg-danger-subtle">
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card border-0 shadow rounded-5">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="bi bi-person-circle h1 display-4"></i>
                            <p>My Daily Journal</p>
                            <hr />
                        </div>
                        <form action="" method="post">
                            <input type="text" name="username" class="form-control my-4 py-2 rounded-4"
                                placeholder="Username" required />
                            <input type="password" name="password" class="form-control my-4 py-2 rounded-4"
                                placeholder="Password" required />
                            <div class="text-center my-3 d-grid">
                                <button class="btn btn-danger rounded-4">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
}
?>