<?php include 'session.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['city'] = $_POST['city'];
    
    if (isset($_POST['birth']) && !empty($_POST['birth'])) {
        $birth = DateTime::createFromFormat('Y-m-d', $_POST['birth']);
        if ($birth !== false) {
            $_SESSION['birth'] = $_POST['birth'];
        } else {
            echo "Format tanggal tidak valid!";
        }
    }

    $_SESSION['specialty'] = $_POST['specialty'];
    $_SESSION['about'] = $_POST['about'];
    $_SESSION['hardskill'] = $_POST['hardskill'];
    $_SESSION['education'] = $_POST['education'];
    $_SESSION['softskill'] = $_POST['softskill'];
    $_SESSION['num'] = $_POST['num'];
    $_SESSION['gith'] = $_POST['gith'];

    if (isset($_FILES['pic'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["pic"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["pic"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        if ($_FILES["pic"]["size"] > 500000) {
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
                $_SESSION['pic_path'] = $target_file;
            } else {
                echo "Gagal mengunggah gambar.";
            }
        }
    }

    header("Location: result.php");
    exit();
}

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form CV</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <div class="contentcv">
            <div class="inputbox">
                <p class="greet">Describe yourself!</p><br>
                <form method="POST" enctype="multipart/form-data">
                    <label>Profile Picture</label><br>
                    <label for="pic-up" class="custom-pic-up">Post your picture</label>
                    <input type="file" name="pic" id="pic-up" style="opacity: 0; height: 0.1px;"><br>
                    <label>Name</label><br>
                    <input type="text" name="name" placeholder="Fullname" required><br>
                    <label>Hometown</label><br>
                    <input type="text" name="city" placeholder="Hometown"><br>
                    <label>Birthdate</label><br>
                    <input type="date" name="birth"><br>
                    <label>Title</label><br>
                    <input type="text" name="specialty" placeholder="Major or Profession"><br>
                    <label>About you</label><br>
                    <textarea name="about"></textarea><br>
                    <label>Hardskills</label><br>
                    <textarea name="hardskill"></textarea><br>
                    <label>Education</label><br>
                    <textarea name="education"></textarea><br>
                    <label>Softskills</label><br>
                    <textarea name="softskill"></textarea><br>
                    <label>Phone Number</label><br>
                    <input type="text" name="num" placeholder="+62 xxx-xxxx-xxxx"><br>
                    <label>Github</label><br>
                    <input type="text" name="gith" placeholder="username"><br>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>

    </div>
</body>
</html>