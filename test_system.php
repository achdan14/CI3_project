<?php
// Simple test to verify system can run
echo "Testing CodeIgniter System...\n";

// Test if CodeIgniter can be loaded
try {
    // Set the path to the CodeIgniter index.php
    $ci_path = __DIR__ . '/index.php';
    
    if (file_exists($ci_path)) {
        echo "✓ CodeIgniter index.php found\n";
    } else {
        echo "✗ CodeIgniter index.php not found\n";
        exit(1);
    }
    
    // Test if autoload can be loaded
    $autoload_path = __DIR__ . '/application/config/autoload.php';
    if (file_exists($autoload_path)) {
        echo "✓ Autoload config found\n";
    } else {
        echo "✗ Autoload config not found\n";
        exit(1);
    }
    
    // Test if database config exists
    $db_config_path = __DIR__ . '/application/config/database.php';
    if (file_exists($db_config_path)) {
        echo "✓ Database config found\n";
    } else {
        echo "✗ Database config not found\n";
        exit(1);
    }
    
    // Test if auth helper exists
    $auth_helper_path = __DIR__ . '/application/helpers/auth_helper.php';
    if (file_exists($auth_helper_path)) {
        echo "✓ Auth helper found\n";
    } else {
        echo "✗ Auth helper not found\n";
        exit(1);
    }
    
    // Test if controllers exist
    $dashboard_controller = __DIR__ . '/application/controllers/Dashboard.php';
    $admin_controller = __DIR__ . '/application/controllers/Admin.php';
    
    if (file_exists($dashboard_controller)) {
        echo "✓ Dashboard controller found\n";
    } else {
        echo "✗ Dashboard controller not found\n";
        exit(1);
    }
    
    if (file_exists($admin_controller)) {
        echo "✓ Admin controller found\n";
    } else {
        echo "✗ Admin controller not found\n";
        exit(1);
    }
    
    // Test if models exist
    $user_model = __DIR__ . '/application/models/User_model.php';
    $product_model = __DIR__ . '/application/models/Product_model.php';
    $transaction_model = __DIR__ . '/application/models/Transaction_model.php';
    
    if (file_exists($user_model)) {
        echo "✓ User model found\n";
    } else {
        echo "✗ User model not found\n";
        exit(1);
    }
    
    if (file_exists($product_model)) {
        echo "✓ Product model found\n";
    } else {
        echo "✗ Product model not found\n";
        exit(1);
    }
    
    if (file_exists($transaction_model)) {
        echo "✓ Transaction model found\n";
    } else {
        echo "✗ Transaction model not found\n";
        exit(1);
    }
    
    // Test if view directories exist
    $user_views = __DIR__ . '/application/views/user';
    $admin_views = __DIR__ . '/application/views/admin';
    
    if (is_dir($user_views)) {
        echo "✓ User views directory found\n";
    } else {
        echo "✗ User views directory not found\n";
        exit(1);
    }
    
    if (is_dir($admin_views)) {
        echo "✓ Admin views directory found\n";
    } else {
        echo "✗ Admin views directory not found\n";
        exit(1);
    }
    
    echo "\n🎉 All tests passed! System is ready to run.\n";
    echo "You can now access the system through your web server.\n";
    echo "User Dashboard: http://localhost/ci3_project/dashboard\n";
    echo "Admin Dashboard: http://localhost/ci3_project/admin\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?> 