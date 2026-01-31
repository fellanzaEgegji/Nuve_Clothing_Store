<?php
    require_once 'session.php';
    $page_css = "dashboard.css";
    require_once 'header.php';
    require_once 'Database.php';
    require_once 'OrderRepository.php';
    require_once 'ProductRepository.php';
    require_once 'ContactMessageRepository.php';

    $db = new Database();
    $conn = $db->getConnection();
    
    $productRepo = new ProductRepository($conn);
    $products = $productRepo->getAllProducts();
    $editProduct = null;
    if (isset($_GET['edit'])) {
        $editProduct = $productRepo->getProductById($_GET['edit']);
  }

    $orderRepo = new OrderRepository($conn);
    $orders = $orderRepo->getAllOrders();

    $messagesRepo = new ContactMessageRepository($conn);
    $messages = $messagesRepo->getAllMessages();
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
        <h1>Menaxhimi i Produkteve</h1>
        <h2><?= isset($_GET['edit']) ? "Edito Produkt" : "Shto Produkt" ?></h2>

        <form action="product-action.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="<?= isset($_GET['edit']) ? "update" : "create" ?>">
        <?php if(isset($editProduct)): ?>
            <input type="hidden" name="id" value="<?= $editProduct?->getId() ?>">
            <input type="hidden" name="existing_image" value="<?= $editProduct?->getImageUrl() ?>">
        <?php endif; ?>

            <input type="text" name="name" placeholder="Emri" value="<?= $editProduct?->getName() ?? '' ?>" required>
            <textarea name="description" placeholder="Përshkrimi"><?= $editProduct?->getDescription() ?? ''?></textarea>
            <input type="number" step="0.01" name="price" placeholder="Çmimi" value="<?= $editProduct?->getPrice() ?? ''?>" required>
            <input type="number" name="sale" placeholder="Zbritja" value="<?= $editProduct?->getSale() ?? 0 ?>">
            <select name="category" required>
                <option value="Femra" <?= ($editProduct && $editProduct->getCategory() == 'Femra') ? 'selected' : '' ?>>Femra</option>
                <option value="Meshkuj" <?= ($editProduct && $editProduct->getCategory() == 'Meshkuj') ? 'selected' : '' ?>>Meshkuj</option>
                <option value="Fëmijë" <?= ($editProduct && $editProduct->getCategory() == 'Fëmijë') ? 'selected' : '' ?>>Fëmijë</option>
            </select>
            <input type="number" name="stock" placeholder="Stoku" value="<?= $editProduct?->getStock() ?? 0 ?>" required>
            <input type="file" name="image">

        <?php if(isset($editProduct) && $editProduct->getImageUrl()): ?>
            <img src="<?= $editProduct->getImageUrl() ?>" width="50" alt="">
        <?php endif; ?>

            <button type="submit"><?= isset($editProduct) ? "Përditëso" : "Ruaj" ?></button>
        </form>

            <div class="section-header">
                <h2>Produktet</h2>
                <a href="add-product.php" class="btn-primary">+ Shto Produkt</a>
            </div>

            <table class="dashboard-table">
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
                            <td><?= $product->getId() ?></td>
                            <td><?= htmlspecialchars($product->getName()) ?></td>
                            <td><?= $product->getPrice() ?> €</td>
                            <td><?= $product->getSale() ?>%</td>
                            <td><?= $product->getStock() ?></td>
                            <td class="actions">  
                            <!-- Edit -->
                            <a href="dashboard.php?edit=<?= $product->getId() ?>" class="btn-edit">Edit</a>

                            <!-- Delete -->
                            <form action="product-action.php" method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $product->getId() ?>">
                                <button class="btn-delete" onclick="return confirm('A je i sigurt?')">Delete</button>
                            </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
        <!-- Orders Section -->
        <section id="orders" class="section">
            <h2>Porositë</h2>
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Klienti</th>
                        <th>Produkt</th>
                        <th>Sasia</th>
                        <th>Statusi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($orders)): ?>
                    <?php foreach($orders as $order): ?>
                        <tr>
                            <td><?= $order['id'] ?></td>
                            <td><?= $order['user_id'] ?></td>
                            <td><?= $order['total'] ?> €</td>
                            <td><?= $order['status'] ?></td>
                            <td><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
                            <td>
                                <a href="edit_order.php?id=<?= $order['id'] ?>" class="btn-edit">Edit</a> 
                                <a href="delete_order.php?id=<?= $order['id'] ?>" class="btn-delete" onclick="return confirm('A je i sigurt?')">Delete</a>
                                <button onclick="toggleItems(<?= $order['id'] ?>)" class="btn-primary" >Shfaq Produktet</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Nuk ka porosi.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </section>

        <!-- Contact Messages Section -->
        <section id="contact-messages" class="section">
            <h2>Mesazhet nga klientët</h2>
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Emri</th>
                        <th>Mbiemri</th>
                        <th>Email</th>
                        <th>Mesazhi</th>
                        <th>Nr. Telefonit</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($messages)): ?>
                        <?php foreach($messages as $msg): ?>
                            <tr>
                                <td><?= htmlspecialchars($msg['id']) ?></td>
                                <td><?= htmlspecialchars($msg['first_name']) ?></td>
                                <td><?= htmlspecialchars($msg['last_name']) ?></td>
                                <td><?= htmlspecialchars($msg['email']) ?></td>
                                <td><?= htmlspecialchars($msg['message']) ?></td>
                                <td><?= htmlspecialchars($msg['phone']) ?></td>
                                <td><?= date('d/m/Y', strtotime($msg['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">Nuk ka mesazhe të reja.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>
</section>
<script src="script.js" ></script>
<?php require_once 'footer.php' ?>