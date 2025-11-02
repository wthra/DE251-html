/G07
│
├── /docs                     # เอกสารที่เกี่ยวข้องกับโปรเจ็กต์
│   ├── รายงานเรื่อง การสร้างเว็บLittle Orchid Shop.docx   # รายงานเอกสาร Word
│   ├── รายงานเรื่อง การสร้างเว็บLittle Orchid Shop.pptx   # รายงานเอกสาร PowerPoint
│   ├── Slide The Orchid Shop.pdf                 # ไฟล์สไลด์ในรูปแบบ PDF
│   ├── Slide The Orchid Shop.pptx                # ไฟล์สไลด์ในรูปแบบ PowerPoint
│
├── /source                   # ไฟล์โปรเจ็กต์หลัก
│   ├── /project_orchid       # โฟลเดอร์สำหรับไฟล์โปรเจ็กต์หลัก
│       ├── /img              # ไฟล์รูปภาพสินค้า
│           ├── product1.jpg
│           ├── product2.jpg
│           ├── ...           # รูปภาพเพิ่มเติม
│       ├── account.php            # หน้าโปรไฟล์และการจัดการบัญชี
│       ├── admin_dashboard.php    # หน้าแดชบอร์ดสำหรับผู้ดูแลระบบ
│       ├── cart.php               # หน้าตะกร้าสินค้า
│       ├── confirm_checkout.php   # การประมวลผลยืนยันการชำระเงิน
│       ├── contact.php            # หน้าแบบฟอร์มติดต่อ
│       ├── db.php                 # ไฟล์เชื่อมต่อฐานข้อมูลแบบ mysql
│       ├── db_pdo.php             # ไฟล์เชื่อมต่อฐานข้อมูลแบบ PDO
│       ├── header.php             # ส่วนหัวของเว็บที่ใช้ร่วมกัน
│       ├── index.php              # หน้าแรกของเว็บ
│       ├── login.php              # หน้าเข้าสู่ระบบ
│       ├── order_confirmation.php # การประมวลผลยืนยันคำสั่งซื้อ
│       ├── process.php            # การประมวลผลการจัดการคำสั่งซื้อในตะกร้าสินค้า
│       ├── product-detail.php     # หน้ารายละเอียดสินค้า
│       ├── product.php            # หน้ารายการสินค้าหลัก
│       ├── submit_contact.php     # การประมวลผลแบบฟอร์มติดต่อ
│
├── /sql                        # ไฟล์ฐานข้อมูล
│   ├── ecommerce.sql           # สคริปต์สร้างฐานข้อมูลและตารางที่เกี่ยวข้อง
│   ├── er_ecommerce.png        # สคริปต์สร้างฐานข้อมูลและตารางที่เกี่ยวข้อง
│
└── README.txt                  # ไฟล์อธิบายโครงสร้างและวิธีติดตั้งโปรเจ็กต์


โปรแกรมที่จำเป็น
XAMPP (หรือโปรแกรมเว็บเซิร์ฟเวอร์ที่รองรับ PHP และ MySQL)
PHP 7.4 ขึ้นไป
เว็บเบราว์เซอร์ (Chrome, Firefox, หรือ Edge)
PHPMyAdmin สำหรับจัดการฐานข้อมูล

การติดตั้งโปรเจกต์

ดาวน์โหลดและติดตั้ง XAMPP:

ดาวน์โหลดโปรแกรม XAMPP จากเว็บไซต์ https://www.apachefriends.org
ติดตั้งโปรแกรมและเริ่ม Apache และ MySQL ผ่าน XAMPP Control Panel
คัดลอกไฟล์โปรเจ็กต์:

คัดลอกโฟลเดอร์ project_orchid ไปไว้ที่ htdocs ของ XAMPP
ตัวอย่าง: C:\xampp\htdocs\project_orchid

ตั้งค่าการเชื่อมต่อฐานข้อมูล:

เปิดไฟล์ /source/project_orchid/db.php และ /source/project_orchid/db_pdo.php
แก้ไขค่าการเชื่อมต่อฐานข้อมูลให้ตรงกับเครื่องของคุณ:
$host = "localhost"; // เปลี่ยน server host ตาม MySQL ที่ใช้
$user = "root"; // เปลี่ยน user ตาม MySQL ที่ใช้
$password = ""; // เปลี่ยน password ตาม MySQL ที่ใช้
$database = "ecommerce"; // ชื่อฐานข้อมูล

การติดตั้งฐานข้อมูล

เข้าสู่ PHPMyAdmin:
เปิดเบราว์เซอร์และเข้า URL: http://localhost/phpmyadmin
สร้างฐานข้อมูล:
คลิก "New" และสร้างฐานข้อมูลชื่อ ecommerce
นำเข้าฐานข้อมูล:
ไปที่แท็บ "Import" และเลือกไฟล์ /sql/ecommerce.sql
คลิก "Go" เพื่อสร้างตารางและข้อมูลเริ่มต้น

ตั้งค่าบัญชีผู้ดูแลระบบ (Admin):
แก้ไขโดยตรงที่ฐานข้อมูลในตาราง users และตั้งค่าคอลัมน์ role เป็น admin

รันโปรเจกต์:

เปิดเว็บเบราว์เซอร์
เข้าสู่ URL: http://localhost/project_orchid/login.php

รหัสผ่านเข้าเว็ปไซต์ role admin
username: admin
password: admin123

รหัสผ่านเข้าเว็ปไซต์ role user
username: user
password: user123

Report:
https://drive.google.com/file/d/12Qb3_XMoyo0Oi05_rqLH8eIaLKmCiCfX/view

This is a complete sample website.

**  https://661010170.waridee.com/project/index.php (copy) **
