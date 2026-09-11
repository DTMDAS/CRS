<?php
// Database Configuration (Apne database ki details yahan dalein)
$host = "localhost";
$username = "root";
$password = "";
$dbname = "certificate_portal";

$conn = new mysqli($host, $username, $password, $dbname);

// Telegram Configuration
define('TELEGRAM_BOT_TOKEN', '8873914554:AAGTblEBmofkZ0PRntlzmyww3X3AETm5Op0');
define('TELEGRAM_CHAT_ID', '7742143795');

function sendTelegramMessage($message) {
    $url = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendMessage?chat_id=" . TELEGRAM_CHAT_ID . "&text=" . urlencode($message) . "&parse_mode=HTML";
    @file_get_contents($url);
}

function sendTelegramPhoto($photo_path, $caption) {
    $url = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendPhoto";
    $post_fields = array('chat_id' => TELEGRAM_CHAT_ID, 'photo' => new CURLFile(realpath($photo_path)), 'caption' => $caption, 'parse_mode' => 'HTML');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    @curl_exec($ch);
    curl_close($ch);
}

// Dummy User Session for testing
$user_id = 1;

// Handle Add Balance
if(isset($_POST['submit_payment'])) {
    $amount = $_POST['amount'];
    $utr = $_POST['utr_number'];
    if($amount < 200) {
        $pay_error = "Minimum add balance limit is ₹200!";
    } else {
        $target_dir = "";
        $screenshot = $target_dir . basename($_FILES["screenshot"]["name"]);
        move_uploaded_file($_FILES["screenshot"]["tmp_name"], $screenshot);
        
        $conn->query("INSERT INTO transactions (user_id, amount, utr, screenshot, status) VALUES ('$user_id', '$amount', '$utr', '$screenshot', 'Pending')");
        sendTelegramPhoto($screenshot, "<b>New Balance Request!</b>\nUser ID: $user_id\nAmount: ₹$amount\nUTR: $utr");
        $pay_success = "Payment submitted successfully! Admin will verify soon.";
    }
}

// Handle Certificate Apply
if(isset($_POST['apply'])) {
    $type = $_POST['certificate_type'];
    $charge = ($type == 'Birth') ? 500 : 600;
    
    $u_query = $conn->query("SELECT balance FROM users WHERE id='$user_id'");
    $user_data = $u_query->fetch_assoc();
    $balance = $user_data['balance'] ?? 0;
    
    if($balance < $charge) {
        $app_error = "Insufficient Balance! You need ₹$charge for $type Certificate.";
    } else {
        $details = json_encode($_POST);
        $conn->query("UPDATE users SET balance = balance - $charge WHERE id='$user_id'");
        $conn->query("INSERT INTO applications (user_id, type, details, status) VALUES ('$user_id', '$type', '$details', 'Pending')");
        sendTelegramMessage("<b>New Certificate Request!</b>\nType: $type\nCharge: ₹$charge\nUser ID: $user_id");
        $app_success = "Application submitted successfully! ₹$charge deducted.";
    }
}

// Handle Admin Actions
if(isset($_POST['admin_add_bal'])) {
    $uid = $_POST['target_user_id'];
    $amt = $_POST['add_amount'];
    $conn->query("UPDATE users SET balance = balance + $amt WHERE id='$uid'");
    $admin_msg = "Balance added successfully!";
}

if(isset($_POST['update_app'])) {
    $app_id = $_POST['app_id'];
    $status = $_POST['status'];
    $pdf_path = "";
    if(!empty($_FILES["pdf_file"]["name"])) {
        $pdf_path = "" . basename($_FILES["pdf_file"]["name"]);
        move_uploaded_file($_FILES["pdf_file"]["tmp_name"], $pdf_path);
    }
    $conn->query("UPDATE applications SET status='$status', pdf_file='$pdf_path' WHERE id='$app_id'");
    sendTelegramMessage("<b>Application Update!</b>\nApp ID: $app_id\nStatus: $status");
    $admin_msg = "Application updated successfully!";
}

// Fetch User Balance
$u_res = $conn->query("SELECT * FROM users WHERE id='$user_id'");
$curr_user = $u_res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Birth & Death Certificate Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="#">Certificate Portal</a>
        <span class="text-white">Wallet Balance: <b>₹<?php echo $curr_user['balance'] ?? 0; ?></b></span>
    </nav>

    <div class="container mt-4">
        <!-- ADD BALANCE SECTION -->
        <div class="card p-4 mb-4 shadow-sm">
            <h3>Add Balance (Min ₹200)</h3>
            <?php if(isset($pay_error)) echo "<div class='alert alert-danger'>$pay_error</div>"; ?>
            <?php if(isset($pay_success)) echo "<div class='alert alert-success'>$pay_success</div>"; ?>
            <p>Scan & Pay via UPI (GPay/Paytm/PhonePe): <b>merchant@upi</b></p>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3"><label>Amount (Min 200):</label><input type="number" name="amount" min="200" class="form-control" required></div>
                <div class="mb-3"><label>UTR / Transaction ID:</label><input type="text" name="utr_number" class="form-control" required></div>
                <div class="mb-3"><label>Upload Screenshot:</label><input type="file" name="screenshot" class="form-control" required></div>
                <button type="submit" name="submit_payment" class="btn btn-primary">Submit Payment</button>
            </form>
        </div>

        <!-- APPLY CERTIFICATE SECTION -->
        <div class="card p-4 mb-4 shadow-sm">
            <h3>Apply for Certificate</h3>
            <?php if(isset($app_error)) echo "<div class='alert alert-danger'>$app_error</div>"; ?>
            <?php if(isset($app_success)) echo "<div class='alert alert-success'>$app_success</div>"; ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label>Select Type:</label>
                    <select name="certificate_type" class="form-control" required>
                        <option value="Birth">Birth Certificate (₹500)</option>
                        <option value="Death">Death Certificate (₹600)</option>
                    </select>
                </div>
                <div class="mb-3"><label>Full Name:</label><input type="text" name="full_name" class="form-control" required></div>
                <div class="mb-3"><label>Date of Event:</label><input type="date" name="event_date" class="form-control" required></div>
                <button type="submit" name="apply" class="btn btn-success">Submit Application</button>
            </form>
        </div>

        <!-- ADMIN PANEL SECTION -->
        <div class="card p-4 mb-4 border-danger shadow-sm">
            <h3 class="text-danger">Admin Panel</h3>
            <?php if(isset($admin_msg)) echo "<div class='alert alert-info'>$admin_msg</div>"; ?>
            <hr>
            <h4>Add Balance to User</h4>
            <form action="" method="POST" class="row g-3 mb-3">
                <div class="col-auto"><input type="number" name="target_user_id" placeholder="User ID" class="form-control" required></div>
                <div class="col-auto"><input type="number" name="add_amount" placeholder="Amount" class="form-control" required></div>
                <div class="col-auto"><button type="submit" name="admin_add_bal" class="btn btn-warning">Add Balance</button></div>
            </form>

            <h4>All Applications</h4>
            <table class="table table-bordered">
                <tr><th>ID</th><th>User</th><th>Type</th><th>Status</th><th>Action / Upload PDF</th></tr>
                <?php
                $apps = $conn->query("SELECT * FROM applications ORDER BY id DESC");
                while($row = $apps->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['user_id']}</td>
                        <td>{$row['type']}</td>
                        <td><b>{$row['status']}</b></td>
                        <td>
                            <form action='' method='POST' enctype='multipart/form-data'>
                                <input type='hidden' name='app_id' value='{$row['id']}'>
                                <select name='status' class='form-control mb-1'><option value='Approved'>Approve</option><option value='Rejected'>Reject</option></select>
                                <input type='file' name='pdf_file' class='form-control mb-1'>
                                <button type='submit' name='update_app' class='btn btn-sm btn-success'>Update</button>
                            </form>
                        </td>
                    </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
