<?php
    require_once 'session.php';
    require_once 'User.php';
    require_once 'Order.php';
    require_once 'OrderItem.php';
    Session::start();
    if (!Session::isLoggedIn()){
        header("Location: login.php");
        exit;
    }
    $page_css = "profile.css";
    require_once 'header.php';
    if (isset($_POST['logout'])) {
        Session::logout();
        header("Location: login.php");
        exit;
    }
    $user = new User(1, "Erblina", "Ramadani", "test@email.com");
    // Porositë statike (shembull)
    $orders = [
    new Order(
        "ORD-2024-001",
        "15 Janar 2024",
        "29.99€",
        "Përfunduar",
        "completed",
        [
            new OrderItem("Produkti 1", 1, "14.99€"),
            new OrderItem("Produkti 2", 1, "15.00€")
        ]
    ),
    new Order(
        "ORD-2024-002",
        "10 Janar 2024",
        "45.50€",
        "Përfunduar",
        "completed",
        [
            new OrderItem("Produkti 1", 1, "25.50€"),
            new OrderItem("Produkti 2", 1, "20.00€")
        ]
    ),
    new Order(
        "ORD-2023-015",
        "5 Dhjetor 2023",
        "12.99€",
        "Anuluar",
        "cancelled",
        [
            new OrderItem("Produkti 1", 1, "12.99€")
        ]
    )
];
$completed = 0;
$inprocess = 0;
$cancelled = 0;

foreach ($orders as $order) {
    if ($order->getStatus() === "Përfunduar") {
        $completed++;
    }
    if ($order->getStatus() === "Në Proces") {
        $inprocess++;
    }
    if ($order->getStatus() === "Anuluar") {
        $cancelled++;
    }
}
?>
<!-- Struktura e user card -->
        <section class="profile">
            <div class="user-card">
                <div class="user-profile">
                    <img src="library/profileimage.png" alt="Profile image">
                </div>
                <div class="user-info">
                    <h1>Profili im</h1>
                <div class="info-row">
                    <span>Emri</span>
                    <p><?php echo $user->getFirstName(); ?></p>
                </div>
                <div class="info-row">
                    <span>Mbiemri</span>
                    <p><?php echo $user->getLastName(); ?></p>
                </div>
                <div class="info-row">
                    <span>Email</span>
                    <p><?php echo $user->getEmail(); ?></p>
                </div>
                <div class="profile-actions">
                    <button type="button" id="togglePassword">Ndrysho fjalëkalimin</button>
                    <form method="POST" style="display:inline;">
                        <button type="submit" name="logout" class="logout">Logout</button>
                    </form>
                </div>
                <form class="password-form" id="passwordForm" method="POST" action="" novalidate>
                    <div class="form-group">
                        <label>Fjalëkalimi aktual</label>
                        <input type="password" name="current_password" id="currentPassword" autocomplete="current-password" required>
                        <div id="currentError" class="error" aria-live="polite"></div>
                    </div>
                    <div class="form-group">
                        <label>Fjalëkalimi i ri</label>
                        <input type="password" name="new_password" id="newPassword" autocomplete="new-password" required>
                        <div id="newError" class="error" aria-live="polite"></div>
                    </div>
                    <div class="form-group">
                        <label>Konfirmo fjalëkalimin</label>
                        <input type="password" name="confirm_password" id="confirmPassword" autocomplete="new-password" required>
                        <div id="confirmError" class="error" aria-live="polite"></div>
                    </div>
                    <button type="submit" class="password-button" name="change_password">Ruaj ndryshimet</button>
                    <div id="formSuccess" class="success" role="status" aria-live="polite"></div>
                </form>
            </div>
        </div>
    </section>

    <!-- Struktura e Porosive -->
     <section class="orders-section">
        <h2>Porositë e mia</h2>
        
        <?php if (empty($orders)): ?>
            <div class="no-orders">
                <img src="library/empty-cart.png" alt="Nuk ka porosi">
                <h3>Nuk keni asnjë porosi akoma</h3>
                <p>Bëni blerjen tuaj të parë tani!</p>
                <a href="products.php" class="shop-button">Shiko produktet</a>
            </div>
        <?php else: ?>
            <div class="orders-container">
                <?php foreach ($orders as $order): ?>
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-info">
                            <div class="order-id"><h4>Porosia:</h4><?php echo $order->getId(); ?></div>
                            <div class="order-date"><?php echo $order->getDate(); ?></div>
                        </div>
                        <div class="order-header-R">
                            <div class="order-status">
                                <div class="status-class <?php echo $order->getStatusClass(); ?>">
                                    <?php echo $order->getStatus(); ?>
                                </div>
                                <div class="order-total"><h4>Total:</h4> <?php echo $order->getTotal(); ?></div>
                            </div>
                            <button class="view-button">Shiko detajet</button>
                        </div>
                    </div>
                    
                    <div class="order-items">
                        <h4>Produktet:</h4>
                        <?php foreach ($order->getItems() as $item): ?>
                        <div class="order-item">
                            <div class="item-name"><?php echo $item->getName(); ?></div>
                            <div class="item-qty">x<?php echo $item->getQty(); ?></div>
                            <div class="item-price"><?php echo $item->getPrice(); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="order-actions">
                        <button class="hide-button">Fshih detajet</button>
                        <button class="repeat-button">Përsërit porosinë</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="orders-stats">
                <div class="stat-box">
                    <h3>Total Porosi</h3>
                    <p><?php echo count($orders); ?></p>
                </div>
                <div class="stat-box">
                    <h3>Përfunduar</h3>
                    <p><?php echo $completed; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Në proces</h3>
                    <p><?php echo $inprocess; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Anuluar</h3>
                    <p><?php echo $cancelled; ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once 'footer.php' ?>