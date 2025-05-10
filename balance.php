<?php
$balances = [
    '101' => 850,
    '102' => 0,
    '103' => 1000,
    '114' => 114514,
    '201' => 100,
    '202' => 120,
    '203' => 1200,
    '301' => 200,
    '302' => 500,
    '303' => 280,
    '401' => 200,
    '402' => 500,
    '403' => 280,
    '501' => 800,
    '502' => 1000,
    '503' => 1500,
];


$unit = $_GET['unit'] ?? '';
$unit = trim($unit);
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

    <?php
    if ($unit !== '') {
        if (array_key_exists($unit, $balances)) {
            $balance = $balances[$unit];
            echo "<p>Outstanding Balance for Unit $unit: <strong>\$$balance</strong></p>";
        } else {
            echo "<p style='color:red;'>❌ Unit $unit not found.</p>";
        }
    }
    ?>
</body>
</html>
