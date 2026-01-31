<?php
    require_once 'session.php';
    require_once 'User.php';
    require_once 'Product.php';
    require_once 'Order.php';
    require_once 'OrderItem.php';
    require_once 'Database.php';
    require_once 'OrderRepository.php';
    require_once 'ProductRepository.php';

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
    $user = unserialize($_SESSION['user']);
    $db = new Database();
    $conn = $db->getConnection();
    $orderRepo = new OrderRepository($conn);
    $orders = $orderRepo->getOrdersByUserId($user->getId());
    $productRepo = new ProductRepository($conn);

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

    if(isset($_POST['cancel-order-id'])) {
        $cancelId = $_POST['cancel-order-id'];
        $orderRepo->cancelOrder($cancelId);

        header("Location: profile.php");
        exit;
    }
    if(isset($_POST['repeat-order-id'])) {
        
        $repeatId = $_POST['repeat-order-id'];

        foreach($orders as $order) {
            if($order->getId() == $repeatId) {

                foreach($order->getItems() as $item) {
                    $product = $productRepo->getProductById($item->getProduct()->getId());
                
                    $productId = $product->getId();
                    $qty = $item->getQty();

                    if(isset($_SESSION['cart'][$productId])) {
                        $_SESSION['cart'][$productId]['quantity'] += $qty;
                    } else {
                        $_SESSION['cart'][$productId] = [
                            'name' => $product->getName(),
                            'brand' => $product->getBrand(),
                            'price' => $product->getPrice(),
                            'old_price' => $product->getOldPrice(),
                            'size' => 'Default',
                            'color' => 'Default',
                            'image' => $product->getImageUrl(),
                            'quantity' => $qty
                        ];
                    }
                }
            }
        }

        header("Location: cart.php");
        exit;
    }
    if (isset($_POST['change_password'])) {
        $current = $_POST['current_password'];
        $new = $_POST['new_password'];
        $confirm = $_POST['confirm_password'];

        if ($new !== $confirm) {
            echo "Fjalëkalimet nuk përputhen!";
        } else {
            $stmt = $conn->prepare("SELECT password FROM users WHERE id = :id");
            $id = $user->getId();
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashedPassword = $row['password'];
            if ($row && password_verify($current, $hashedPassword)) {
                $hash = password_hash($new, PASSWORD_DEFAULT);
                $update = $conn->prepare("UPDATE users SET password = :p WHERE id = :id");
                $update->bindParam(':p', $hash);
                $id = $user->getId();
                $update->bindParam(':id', $id);
                $update->execute();
                echo "Fjalëkalimi u ndryshua me sukses!";
            } else {
                echo "Fjalëkalimi aktual nuk është i saktë!";
            }
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
                        <p>Fjalëkalimi aktual</p>
                        <input type="password" name="current_password" id="currentPassword" autocomplete="current-password" required>
                        <div id="currentError" class="error" aria-live="polite"></div>
                    </div>
                    <div class="form-group">
                        <p>Fjalëkalimi i ri</p>
                        <input type="password" name="new_password" id="newPassword" autocomplete="new-password" required>
                        <div id="newError" class="error" aria-live="polite"></div>
                    </div>
                    <div class="form-group">
                        <p>Konfirmo fjalëkalimin</p>
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
        <div class="orders-card">
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
                <?php foreach ($orders as $order): ?>
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-info">
                            <div class="order-id">Numri i porosisë: #<?php echo $order->getId(); ?></div>
                            <div class="order-date"><?php echo $order->getDate(); ?></div>
                        </div>
                        <div class="order-header-R">
                            <div class="status-class <?php echo $order->getStatusClass(); ?>">
                                    <?php echo $order->getStatus(); ?>
                            </div>
                            <div class="order-status">
                                <div class="order-total"><?php echo $order->getTotal(); ?>€</div>
                                <button class="order-button view-button">Shiko detajet</button>
                            </div>
                        </div>
                    </div>
                    <div class="order-details">
                        <div class="order-items">
                            <h4>Produktet:</h4>
                            <?php foreach ($order->getItems() as $item): ?>
                            <div class="order-item">
                                <img src="<?php echo $item->getProduct()->getImageUrl(); ?>" alt="<?php echo $item->getProduct()->getName(); ?>" class="order-item-image">
                                <div class="item-name"><?php echo $item->getProduct()->getName(); ?></div>
                                <div class="item-qty">x<?php echo $item->getQty(); ?></div>
                                <div class="item-price"><?php echo $item->getPrice(); ?>€</div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    
                        <div class="order-actions">
                            <form method="POST">
                                <input type="hidden" name="repeat-order-id" value="<?php echo $order->getId(); ?>">
                                <button type="submit" class="order-button">Përsërit porosinë</button>
                            </form>
                            <?php if($order->getStatus() === 'Në Proces'): ?>
                                <form method="POST">
                                    <input type="hidden" name="cancel-order-id" value="<?php echo $order->getId(); ?>">
                                    <button type="submit" class="order-button" >Anulo porosinë</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once 'footer.php' ?>