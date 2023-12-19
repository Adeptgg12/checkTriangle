<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ตรวจสอบสามเหลี่ยม</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .result {
            margin-top: 20px;
            padding: 10px;
            background-color: #eaeaea;
            border-radius: 4px;
        }

        .back-link {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #4caf50;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function validateInput(event) {
            const charCode = event.which ? event.which : event.keyCode;
            if (charCode === 69 || charCode === 43 || charCode === 45 || event.key === 'e' || event.key === 'E') {
                event.preventDefault();
                return false;
            }
        }
    </script>
</head>

<body>
    <div class="result">
        <?php
        $result = "ยังไม่ใส่ค่า";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $side1 = $_POST['side1'];
            $side2 = $_POST['side2'];
            $side3 = $_POST['side3'];

            function checkTriangle($a, $b, $c)
            {
                if ($a <= 0 || $b <= 0 || $c <= 0 || $a > 100 || $b > 100 || $c > 100) {
                    return "ข้อมูลนำเข้าไม่ถูกต้อง";
                }

                // ตรวจสอบความเป็นสามเหลี่ยม
                if (($a + $b) > $c && ($a + $c) > $b && ($b + $c) > $a) {
                    if ($a == $b && $b == $c) {
                        return "equilateral triangle"; // สามเหลี่ยมหน้าจั่ว
                    } elseif ($a == $b || $a == $c || $b == $c) {
                        return "isosceles triangle"; // สามเหลี่ยมแต่มีด้านสองด้านเท่ากัน
                    } elseif ($a * $a + $b * $b == $c * $c || $a * $a + $c * $c == $b * $b || $b * $b + $c * $c == $a * $a) {
                        return "right triangle"; // สามเหลี่ยมมุมฉาก
                    } else {
                        return "Scalene triangle"; // สามเหลี่ยมทั่วไป
                    }
                } else if (($a + $b) <= $c || ($a + $c) <= $b || ($b + $c) <= $a) {
                    return "Not a Triangle"; // ไม่เป็นสามเหลี่ยม
                }
            }

            // เรียกใช้ฟังก์ชัน checkTriangle
            $result = checkTriangle($side1, $side2, $side3);

            // แสดงผลลัพธ์

        }
        ?>
    </div>
    <form action="index.php" method="post">
        <label for="side1">ด้านที่ 1:</label>
        <input type="number" step="0.01" min="0.00" max="100.00" id="side1" name="side1" required onkeypress="validateInput(event)"><br><br>

        <label for="side2">ด้านที่ 2:</label>
        <input type="number" step="0.01" min="0.00" max="100.00" id="side2" name="side2" required onkeypress="validateInput(event)"><br><br>

        <label for="side3">ด้านที่ 3:</label>
        <input type="number" step="0.01" min="0.00" max="100.00" id="side3" name="side3" required onkeypress="validateInput(event)"><br><br>

        <input type="submit" value="ตรวจสอบ">
    </form>
    <?php
    echo "<br><br><br><br><br>";
    echo '<center><span style="font-weight: bold;">ผลลัพธ์:</span> ' . $result . '</center>';


    ?>

</body>

</html>