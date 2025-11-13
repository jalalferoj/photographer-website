<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photography Portfolio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Your Name</h1>
        <nav>
            <ul>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
        <div class="theme-switch-wrapper">
            <label class="theme-switch" for="checkbox">
                <input type="checkbox" id="checkbox" />
                <div class="slider round"></div>
            </label>
        </div>
    </header>
    <main>
        <section id="portfolio">
            <h2>Portfolio</h2>
            <div class="gallery">
                <?php include 'display.php'; ?>
            </div>
        </section>
        <section id="upload">
            <h2>Upload Image</h2>
            <?php
            if (isset($_GET['message'])) {
                $message = htmlspecialchars($_GET['message']);
                $uploadOk = $_GET['uploadOk'];
                echo "<div class='message " . ($uploadOk == 1 ? "success" : "error") . "'>$message</div>";
            }
            ?>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload" required>
                <input type="text" name="title" placeholder="Image Title" required>
                <textarea name="description" placeholder="Image Description"></textarea>
                <input type="submit" value="Upload Image" name="submit">
            </form>
        </section>
        <section id="about">
            <h2>About Me</h2>
            <p>A passionate photographer...</p>
        </section>
        <section id="contact">
            <h2>Contact</h2>
            <p>your.email@example.com</p>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Your Name</p>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>
