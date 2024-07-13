<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User stats</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vbis";
$conn2 = new mysqli($servername, $username, $password, $dbname);

if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
}

$sql2 = "SELECT DATE_FORMAT(datum_kreiranja, '%Y-%m') AS month_year, COUNT(*) AS broj_korisnika
        FROM user
        GROUP BY month_year
        ORDER BY month_year";

$result2 = $conn2->query($sql2);

$labels2 = [];
$data2 = [];

while ($row = $result2->fetch_assoc()) {
    $labels2[] = $row['month_year'];
    $data2[] = $row['broj_korisnika'];
}

$conn2->close();
?>

<canvas id="myChart" class="mh-300px"></canvas>

<script>
    var ctx2 = document.getElementById('myChart').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels2); ?>,
            datasets: [{
                label: 'Number of users',
                data: <?php echo json_encode($data2); ?>,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            scales: {
                x: [{
                    type: 'time',
                    time: {
                        unit: 'month',
                        displayFormats: {
                            month: 'MMM YYYY'
                        }
                    }
                }],
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>
