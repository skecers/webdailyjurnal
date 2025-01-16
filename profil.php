<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Daily Journal | Admin</title>
    <link rel="icon" href="img/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
    .current-profile-pic {
        max-width: 150px;
        /* Adjust the size as needed */
        height: auto;
    }
    </style>

</head>

<body>
    <!-- Profil Section -->
    <div class="container profile-section mt-5">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $password = $_POST['password'];
            $profilePic = $_FILES['profile-pic'];

            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'webdailyjournal');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Update password if provided
            if (!empty($password)) {
                $hashedPassword = md5($password);
                $sql = "UPDATE user SET password='$hashedPassword' WHERE id=1"; // Change 'id=1' to the appropriate user ID
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Password updated successfully.');</script>";
                } else {
                    echo "<script>alert('Error updating password: " . $conn->error . "');</script>";
                }
            }

            $conn->close();
        }
        ?>

        <form action="#" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="password" class="form-label"><strong>Ganti Password</strong></label>
                <input type="password" id="password" name="password" class="form-control"
                    placeholder="Tuliskan Password Baru atau Biarkan Kosong">
            </div>
            <div class="mb-3">
                <label for="profile-pic" class="form-label"><strong>Ganti Foto Profil</strong></label>
                <input type="file" id="profile-pic" name="profile-pic" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Foto Profil Saat Ini</label>
                <div>
                    <img src="profile.jpg" alt="Profile Picture" class="img-thumbnail current-profile-pic">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>

</html>
<script>
$(document).ready(function() {
    $('#profile-pic').change(function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.current-profile-pic').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
});
</script>