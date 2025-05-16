<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ฟอร์มติดต่อ</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
        }
        .container {
            width: 90%;
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            margin-top: 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background: #45a049;
        }
        .error-list {
            color: red;
            margin-bottom: 15px;
        }
        .success {
            background: #e6ffe6;
            border: 1px solid #b2ffb2;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            color: #2d862d;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>ฟอร์มติดต่อเรา</h2>

    <?php
    $name = $email = $subject = $message = "";
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $errors[] = "กรุณากรอกชื่อ-นามสกุล";
        } else {
            $name = htmlspecialchars($_POST["name"]);
        }

        if (empty($_POST["email"])) {
            $errors[] = "กรุณากรอกอีเมล";
        } else {
            $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "รูปแบบอีเมลไม่ถูกต้อง";
            }
        }

        if (empty($_POST["subject"])) {
            $errors[] = "กรุณากรอกหัวข้อ";
        } else {
            $subject = htmlspecialchars($_POST["subject"]);
        }

        if (empty($_POST["message"])) {
            $errors[] = "กรุณากรอกข้อความ";
        } else {
            $message = htmlspecialchars($_POST["message"]);
        }

        if (empty($errors)) {
            echo "<div class='success'>";
            echo "<strong>ส่งข้อความสำเร็จ!</strong><br><br>";
            echo "<b>ชื่อ-นามสกุล:</b> $name<br>";
            echo "<b>อีเมล:</b> $email<br>";
            echo "<b>หัวข้อ:</b> $subject<br>";
            echo "<b>ข้อความ:</b><br><pre style='white-space:pre-wrap; word-break:break-word; overflow-wrap:break-word;'>$message</pre>";
            echo "</div>";
        } else {
            echo "<div class='error-list'><ul>";
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul></div>";
        }
    }
    ?>

    <form method="post" action="" onsubmit="return validateForm();">
        <label>ชื่อ-นามสกุล:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">

        <label>อีเมล:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>">

        <label>หัวข้อ:</label>
        <input type="text" name="subject" value="<?= htmlspecialchars($subject) ?>">

        <label>ข้อความ:</label>
        <textarea name="message" rows="5"><?= htmlspecialchars($message) ?></textarea>

        <input type="submit" value="ส่งข้อความ">
    </form>
</div>
<script>
function validateForm() {
    const email = document.getElementById("email").value.trim();
    
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(email)) {
        alert("รูปแบบอีเมลไม่ถูกต้อง");
        return false; 
    }

    return true;
}
</script>
</body>
</html>
