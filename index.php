<?php
$result_message = "";
$error_message = "";
if (isset($_GET['user_name'])) {
    $name_input = urlencode($_GET['user_name']);
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $dir = dirname($_SERVER['PHP_SELF']);
    $api_url = $protocol . "://" . $host . $dir . "/api/greet.php?name=" . $name_input;
    try {
        $api_response = @file_get_contents($api_url);
        if ($api_response === FALSE) {
            throw new Exception("Could not reach the API. Please check your connection.");
        }
        $data = json_decode($api_response, true);
        if (isset($data['message'])) {
            $result_message = htmlspecialchars($data['message']);
        } else {
            throw new Exception("Received invalid data format from the API.");
        }
    } catch (Exception $e) {
        $error_message = "Oops! Something went wrong: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini API Project</title>
    <link rel="stylesheet" href="style.css">
    <!-- HTML Comment: [your-register-email@example.com] -->
</head>
<body>
    <div class="card">
        <h2>Mini API Tester</h2>
        <form method="GET" action="index.php">
            <input type="text" name="user_name" placeholder="Enter your name" required>
            <button type="submit">Call API</button>
        </form>
        <div class="output">
            <?php if (!empty($error_message)): ?>
                <p style="color: red;"> <?php echo $error_message; ?> </p>
            <?php elseif (!empty($result_message)): ?>
                <p style="color: green;"> <?php echo $result_message; ?> </p>
            <?php else: ?>
                <p>Submit your name to see the API magic!</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

