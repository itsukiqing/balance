<?php

$SUPABASE_URL = 'https://jospczygelbmnzwqepdp.supabase.co';
$SUPABASE_API_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Impvc3BjenlnZWxibW56d3FlcGRwIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDM3NjA5ODIsImV4cCI6MjA1OTMzNjk4Mn0.HZmcO7xXxIYdWGpvbu-13qSu0s3dkUXzSMvGN3eCpfE';
$table = 'balance';

$unit = $_GET['unit'] ?? '';
$unit = trim($unit);
$balance = null;
$error = null;

if ($unit !== '') {
    $url = "$SUPABASE_URL/rest/v1/$table?unit_number=eq." . urlencode($unit) . "&select=balance";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "apikey: $SUPABASE_API_KEY",
        "Authorization: Bearer $SUPABASE_API_KEY",
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if (isset($data[0]['balance'])) {
        $balance = $data[0]['balance'];
    } else {
        $error = "❌ Unit $unit not found in database.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Unit Balance Checker</title>
</head>
<body>
    <h2>Check Unit Balance</h2>
    <form method="get">
        <label>Enter Unit Number:</label>
        <input type="text" name="unit" value="<?= htmlspecialchars($unit) ?>" />
        <input type="submit" value="Check Balance" />
    </form>

    <hr/>

    <?php if ($unit !== ''): ?>
        <?php if ($balance !== null): ?>
            <p>Outstanding Balance for Unit <strong><?= htmlspecialchars($unit) ?></strong>: 
                <strong>$<?= $balance ?></strong>
            </p>
        <?php else: ?>
            <p style="color:red;"><?= $error ?></p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
