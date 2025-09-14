<?php
require 'connect.php';

$sql = "SELECT
            o.orderNumber,
            od.productCode,
            p.productName,
            o.orderDate,
            o.shippedDate,
            o.status
        FROM
            orders o
        JOIN
            orderdetails od ON o.orderNumber = od.orderNumber
        JOIN
            products p ON od.productCode = p.productCode
        WHERE
            p.productLine = 'Classic Cars'
            AND o.status = 'Shipped'
            AND YEAR(o.orderDate) BETWEEN 2003 AND 2004
        ORDER BY
            o.orderDate ASC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เงื่อนไขที่ 3: รายการสั่งซื้อ Classic Cars</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 80%; border-collapse: collapse; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">รายการสั่งซื้อหมวด Classic Cars (2003-2004) ที่จัดส่งแล้ว</h2>
    <table>
        <thead>
            <tr>
                <th>เลขที่สั่งซื้อ (OrderNumber)</th>
                <th>รหัสสินค้า (productCode)</th>
                <th>ชื่อสินค้า (productName)</th>
                <th>วันที่สั่ง (orderDate)</th>
                <th>วันที่จัดส่ง (shippedDate)</th>
                <th>สถานะ (status)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["orderNumber"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["productCode"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["productName"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["orderDate"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["shippedDate"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>ไม่พบข้อมูลตามเงื่อนไข</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>

</html>
