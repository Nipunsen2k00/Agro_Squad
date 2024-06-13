<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources - Farming Services</title>
    <link rel="stylesheet" href="./css/Resource.css">
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
    <section class="resources-section">
        <div class="resources-image">
            <img src="Images\\Frame 7.jpg" alt="Books and Coffee">
        </div>
        <div class="resources-form-container">
            <h2>Resources</h2>
            <p>What do you need done? Find it</p>
            <form action="search.php" method="get">
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category">
                        <option value="">Select Category</option>
                        <option value="agriculture">Agriculture</option>
                        <option value="technology">Technology</option>
                        <option value="business">Business</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="format">Format</label>
                    <select id="format" name="format">
                        <option value="">Select Format</option>
                        <option value="article">Article</option>
                        <option value="video">Video</option>
                        <option value="podcast">Podcast</option>
                    </select>
                </div>
                
                <button type="submit">Search</button>
            </form>
        </div>
    </section>
</body>
</html>