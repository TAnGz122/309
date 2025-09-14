<?php
// กำหนดค่าตัวแปรสำหรับการเชื่อมต่อฐานข้อมูล
$servername = "localhost"; // หรือ IP Address ของ Server
$username = "root";       // ชื่อผู้ใช้งานฐานข้อมูล
$password = "";           // รหัสผ่าน (ถ้ามี)
$dbname = "classicmodels"; // ชื่อฐานข้อมูลจากไฟล์ .sql ของคุณ

// สร้างการเชื่อมต่อด้วย MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบว่าการเชื่อมต่อสำเร็จหรือไม่
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตั้งค่าชุดอักขระ (Charset) เป็น UTF-8 เพื่อให้รองรับภาษาไทย
$conn->set_charset("utf8");
?>