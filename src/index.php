<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Check if user role is admin
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        header("Location: approval.php"); // Redirect to approval page for admin
        exit();
    }
    
    include 'navbar_after.php'; // For logged-in users
    // Display the user_id and role safely
    $user_id = $_SESSION['user_id'];
    $role = isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'User'; // Default to 'User' if role is not set
    // echo "<div class='bg-green-100 p-4 text-green-800'>Logged in as User ID: $user_id | Role: $role</div>";
} else {
    include 'navbar.php'; // For guests
}

// ฟังก์ชันเชื่อมต่อฐานข้อมูล
function connectDatabase($host, $username, $password, $database)
{
    $connection = mysqli_connect($host, $username, $password, $database);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $connection;
} 

// ค่าคงที่สำหรับฐานข้อมูล
define('DB_HOST', 'db');
define('DB_USERNAME', 'php_docker');
define('DB_PASSWORD', 'passwordd');
define('DB_NAME', 'php_docker');

// เชื่อมต่อฐานข้อมูล
$connect = connectDatabase(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// JOIN ตาราง Books กับ Categories และจัดเรียงตามวันที่สร้างล่าสุด
$query = "
SELECT b.*, c.category_name
FROM Books b
LEFT JOIN Categories c ON b.category_id = c.category_id
WHERE b.status = 'approved' 
ORDER BY b.created_at DESC";

$response = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>mebook</title>
</head>

<body>

    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Daily Updates</h2>

            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                <?php
                // Loop ผ่านข้อมูลหนังสือและแสดงข้อมูลเรียงตามวันที่สร้างล่าสุด
                while ($book = mysqli_fetch_assoc($response)) {
                    $title = htmlspecialchars($book['title']);                // ชื่อหนังสือ
                    $categoryName = htmlspecialchars($book['category_name']); // ชื่อหมวดหมู่
                    $imageUrl = htmlspecialchars($book['image_url']);         // URL ของภาพ
                    $createdAt = htmlspecialchars($book['created_at']);       // วันที่สร้างหนังสือ

                    // แสดงข้อมูลหนังสือในรูปแบบที่ต้องการ
                    echo "
                    <div class='group relative'>
                        <div class='aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80'>
                            <img src='$imageUrl' alt='$title' class='h-full w-full object-cover object-center lg:h-full lg:w-full'>
                        </div>
                        <div class='mt-4 flex justify-between'>
                            <div>
                                <h3 class='text-sm text-gray-700'>
                                    <a href='book_details.php?id=" . htmlspecialchars($book['book_id']) . "'>
                                        <span aria-hidden='true' class='absolute inset-0'></span>
                                        $title
                                    </a>
                                </h3>
                                <p class='mt-1 text-sm text-gray-500'>หมวดหมู่: $categoryName</p>
                                <p class='text-sm text-gray-400'>สร้างเมื่อ: $createdAt</p>
                            </div>
                        </div>
                    </div>
                    ";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
