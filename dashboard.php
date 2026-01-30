<?php
    require_once 'session.php';
    require_once 'Database.php';
    require_once 'ProductRepository.php';

    $db = new Database();
    $conn = $db->getConnection(); 

    $productRepo = new ProductRepository($conn);
    $products = $productRepo->getAllProducts();

    $page_css = "dashboard.css";
    require_once 'header.php';
?>
<section class="dashboard">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <h2>Sektorët</h2>
        </div>
        <nav>
            <ul>
                <li><a href="#dashboard">Dashboard</a></li>
                <li><a href="#products">Produktet</a></li>
                <li><a href="#orders">Porositë</a></li>
                <li><a href="#contact-messages">Mesazhet</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

        <!-- Dashboard Section -->
        <section id="dashboard" class="section">
            <h1>Mirësevini, Admin!</h1>
            <div class="cards">
                <div class="card">
                    <h3>Produktet</h3>
                    <p>120</p>
                </div>
                <div class="card">
                    <h3>Porositë e fundit</h3>
                    <p>15</p>
                </div>
                <div class="card">
                    <h3>Mesazhet</h3>
                    <p>8</p>
                </div>
            </div>
        </section>
        <!--Products Section-->
    <section id="products" class="section">
        <div class="section-header">
            <h2>Produktet</h2>
            <a href="add-product.php" class="btn-primary">+ Shto Produkt</a>
        </div>

        <table class="products-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Emri</th>
                    <th>Çmimi</th>
                    <th>Zbritja</th>
                    <th>Stoku</th>
                    <th>Aksione</th>
                </tr>
            </thead>
           <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= $product['price'] ?> €</td>
                        <td><?= $product['sale'] ?>%</td>
                        <td><?= $product['stock'] ?></td>
                        <td class="actions">
                        <a href="edit-product.php?id=<?= $product['id'] ?>" class="btn-edit">Edit</a>
                        <a href="delete-product.php?id=<?= $product['id'] ?>"
                           class="btn-delete"
                           onclick="return confirm('A je i sigurt?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

        <!-- Orders Section -->
        <section id="orders" class="section">
            <h2>Porositë</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Klienti</th>
                        <th>Produkt</th>
                        <th>Sasia</th>
                        <th>Statusi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>201</td>
                        <td>Emri M.</td>
                        <td>Produkti</td>
                        <td>2</td>
                        <td>Anuluar</td>
                    </tr>
                    <tr>
                        <td>202</td>
                        <td>Emri M.</td>
                        <td>Produkti</td>
                        <td>1</td>
                        <td>Në Proces</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Contact Messages Section -->
        <section id="contact-messages" class="section">
            <h2>Mesazhet nga klientët</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Emri</th>
                        <th>Email</th>
                        <th>Mesazhi</th>
                        <th>Nr. Telefonit</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Emri M.</td>
                        <td>test@mail.com</td>
                        <td>Pyetja?</td>
                        <td>049 111 222</td>
                        <td>26/01/2026</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Emri M.</td>
                        <td>emri@mail.com</td>
                        <td>Pyetja?</td>
                        <td>049 111 222</td>
                        <td>25/01/2026</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</section>
<?php require_once 'footer.php' ?>