<?php
// session_start(); // Bắt đầu session
require_once 'view/auth/vendor/autoload.php';

// init configuration
$clientID = '55135624167-1f24q2tga4ul78hmsfd3peml7v5csh40.apps.googleusercontent.com'; // your client id
$clientSecret = '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'; // your client secret
$redirectUri = 'http://localhost:8000/login';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php2";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email = $google_account_info->email;
    $name = $google_account_info->name;

    // Insert or update user into database
    $stmt = $conn->prepare("INSERT INTO userss (email, name, role) VALUES (?, ?, 'user') ON DUPLICATE KEY UPDATE name = VALUES(name)");
    $stmt->bind_param("ss", $email, $name);
    if ($stmt->execute()) {
        // Lấy thông tin người dùng từ database
        $stmt = $conn->prepare("SELECT * FROM userss WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Lưu thông tin user vào session
            $_SESSION['user'] = $user;

            // Kiểm tra vai trò và chuyển hướng
            if ($user['role'] === 'admin') {
                echo "<script>window.location.href='/';</script>";
            } else {
                echo "<script>window.location.href='/';</script>";
            }
        } else {
            echo "Error: Unable to fetch user data.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    exit;
} else {
?>

    <h1 class="text-center my-4">Login</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?= $error ?>
        </div>
    <?php endif; ?>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <div class="container">
        <form method="POST" class="w-50 mx-auto border p-4 rounded shadow">
           
            <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" 
                   value="<?= htmlspecialchars($email ?? '') ?>" placeholder="Enter your email" >
            <?php if (!empty($errors['email'])): ?>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['email']) ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control <?= !empty($errors['password']) ? 'is-invalid' : '' ?>" 
                   placeholder="Enter your password" >
            <?php if (!empty($errors['password'])): ?>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['password']) ?></div>
            <?php endif; ?>
        </div>
            <div class="container">
        <div class="table-responsive">
            <h3 align="center">Đăng nhập google đi em</h3>
            <div class="box">
                <div class="form-group">
                    <center><a href="<?php echo $client->createAuthUrl() ?>"><img src="uploads/gglogin.jpg" width="256"></a></center>
                </div>
            </div>
        </div>
    </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
           

        </form>
        <p class="text-center mt-3">
            Don't have an account? <a href="/register">Register</a>
        </p>
    </div>
    
<?php
}
?>