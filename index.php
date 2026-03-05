<!DOCTYPE html>
<html>
<head>
    <title>TrackClock HR - Salary Payment</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        form { background: #fff; padding: 20px; border-radius: 8px; width: 400px; margin: auto; }
        input, select { width: 100%; padding: 8px; margin: 10px 0; }
        button { padding: 10px 20px; background: #0b068c; color: #fff; border: none; cursor: pointer; border-radius: 5px; }
    </style>
</head>
<body>

<h2 style="text-align:center;">TrackClock HR - Multiple Salary Payment</h2>

<form action="pay.php" method="POST">

    <label>Select Employees (Hold Ctrl to select multiple):</label>
    <select name="employees[]" multiple required size="4">
        <option value="5241474757">5241474757</option>
        <option value="9123456780">9123356780</option>
        <option value="9987785565">9987785565</option>
        <option value="7645391002">7645391002</option>
    </select>

    <label>Salary Amount Per Employee (₹):</label>
    <input type="number" name="amount" required placeholder="Enter salary amount" />

    <button type="submit">Pay Salaries</button>
</form>

</body>
</html>