<?php
require 'connect.php';

$sql = "SELECT 
            e.employeeNumber, 
            e.lastName, 
            e.firstName, 
            o.city, 
            o.country 
        FROM 
            employees e
        JOIN 
            offices o ON e.officeCode = o.officeCode
        ORDER BY
            e.employeeNumber ASC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เงื่อนไขที่ 1: ข้อมูลพนักงานและสำนักงาน</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 80%; border-collapse: collapse; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">ข้อมูลพนักงานและที่ตั้งสำนักงาน</h2>
    <table>
        <thead>
            <tr>
                <th>รหัสพนักงาน (employeeNumber)</th>
                <th>ชื่อ (lastName)</th>
                <th>นามสกุล (firstName)</th>
                <th>เมือง (city)</th>
                <th>ประเทศ (country)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["employeeNumber"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["lastName"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["firstName"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["city"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["country"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>ไม่พบข้อมูล</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>

</html>
