<?php
require 'connect.php';

$sql = "SELECT
            e.employeeNumber,
            e.lastName,
            e.firstName,
            COUNT(c.customerNumber) AS totalOrders
        FROM
            employees e
        LEFT JOIN
            customers c ON e.employeeNumber = c.salesRepEmployeeNumber
        GROUP BY
            e.employeeNumber, e.lastName, e.firstName
        ORDER BY
            totalOrders DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เงื่อนไขที่ 2: ยอดการสั่งซื้อของพนักงาน</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 80%; border-collapse: collapse; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">ยอดรวมการสั่ง Order ของพนักงาน (รายคน)</h2>
    <table>
        <thead>
            <tr>
                <th>รหัสพนักงาน (employeeNumber)</th>
                <th>ชื่อ (lastName)</th>
                <th>นามสกุล (firstName)</th>
                <th>ยอดรวม Order ทั้งหมด</th>
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
                    echo "<td>" . htmlspecialchars($row["totalOrders"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>ไม่พบข้อมูล</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>

</html>
