<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farming_services";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch unique crop categories for dropdown
$sql = "SELECT DISTINCT crop_catagory FROM crop";
$result = $conn->query($sql);

$categories = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Fetch unique crop names for dropdown
$sql = "SELECT DISTINCT crop_name FROM crop";
$result = $conn->query($sql);

$names = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $names[] = $row;
    }
}

// Fetch plant details if a category and name are selected
$plant_details = null;
if (isset($_POST['category']) && isset($_POST['name'])) {
    $category = $_POST['category'];
    $name = $_POST['name'];
    $stmt = $conn->prepare("SELECT * FROM crop WHERE crop_catagory = ? AND crop_name = ?");
    $stmt->bind_param("ss", $category, $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $plant_details = $result->fetch_assoc();
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Details - Farming Services</title>
    <link rel="stylesheet" href="./css/Service1.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="Images\\Green_and_White_Circle_Icon_Organic_Food_Logo-removebg-preview 1.png" alt="Fedas Logo">
        </div>
        <nav>
        <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="About.php">About</a></li>
                <li><a href="Service1.php">Services</a></li>
                <li><a href="Contact.php">Contact</a></li>
                <li><a href="Resource.php">Resources</a></li>
            </ul>
        </nav>
        <div class="search-bar">
            <input type="text" placeholder="Search">
        </div>
    </header>
    <section class="hero">
        <div class="content-container">
            <div class="dropdowns">
                <form action="Service1.php" method="post">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category">
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['crop_catagory']; ?>"><?php echo $category['crop_catagory']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Crop</label>
                        <select id="name" name="name">
                            <?php foreach ($names as $name): ?>
                                <option value="<?php echo $name['crop_name']; ?>"><?php echo $name['crop_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit">Enter</button>
                </form>
            </div>
            <?php if ($plant_details): ?>
                <div class="plant-details">
                    <h2><?php echo strtoupper($plant_details['crop_name']); ?></h2>
                    <p><?php echo nl2br($plant_details['description']); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>