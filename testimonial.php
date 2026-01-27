<?php
    require_once 'session.php';
    require_once 'Database.php';
    require_once 'Testimonials.php';
    $page_css = "testimonial.css";
    include_once 'header.php';

    $database = new Database();
    $conn = $database->getConnection(); 

    $testimonialObj = new Testimonials($conn);
    $testimonials = $testimonialObj->getAll();
?>

 <!--Imazh + Tekst-->
    <section class="main">
        <div class="main-img">
            <img src="library/testimonial.png" alt="">
        </div>
        <div class="main-text">
            <h1>Çfarë thonë klientët tanë?</h1>
            <p>Eksperienca reale nga klientët tanë besnikë. Shiko si rrobat tona bëjnë klientët të lumtur dhe të kënaqur...</p>
        </div>
    </section>   
<!--Shto koment-->
<section class="add-testimonial">
    <h2>Shto komentin tënd</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_testimonial'])) {
        $name = trim($_POST['name']);
        $text = trim($_POST['text']);

        if (!empty($name) && !empty($text)) {
            if ($testimonialObj->add($name, $text)) {
                echo '<p style="color:green;">Koment u shtua me sukses!</p>';
                $testimonials = $testimonialObj->getAll();
            } else {
                echo '<p style="color:red;">Diçka shkoi gabim, provoni përsëri.</p>';
            }
        } else {
            echo '<p style="color:red;">Ju lutem plotësoni të gjitha fushat.</p>';
        }
    }
    ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Shkruani emrin tuaj" required>
        <textarea name="text" placeholder="Shkruani komentin tuaj" required></textarea>
        <button type="submit" name="submit_testimonial">Shto Komentin</button>
    </form>
</section>


<!--Slider i komenteve-->
    <section class="testimonials">
    <div class="slider">
        <button class="nav prev">&#10094;</button>
        <div class="viewport">
            <div class="track">
                <?php foreach($testimonials as $t): ?>
                    <div class="card">
                        <p class="quote">“</p>
                        <p class="text"><?= htmlspecialchars($t['text']) ?></p>
                        <span class="name"><?= htmlspecialchars($t['name']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button class="nav next">&#10095;</button>
    </div>
    <div class="dots"></div>
    </section>

<script src="testimonial.js?v=1.2"></script>
<?php require_once 'footer.php' ?>