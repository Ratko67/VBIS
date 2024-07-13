<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vbis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['uvezi'])) {
    $xmlFile = $_FILES['xmlFile']['tmp_name'];

    if (file_exists($xmlFile)) {
        $xmlData = simplexml_load_file($xmlFile);

        $stmt = $conn->prepare("INSERT INTO concert (concert_name, description, starts_at, concert_status, price) VALUES (?, ?, ?, ?, ?)");

        foreach ($xmlData->children() as $item) {
            $concert_name = $item->concert_name;
            $description = $item->description;
            $starts_at = $item->starts_at;
            $concert_status = $item->concert_status;
            $price = $item->price;

            $stmt->bind_param("sssssi", $concert_name,  $description, $starts_at,  $concert_status, $price);
            $stmt->execute();
        }

        $stmt->close();
        echo "XML data successfully imported to the database.";
    } else {
        echo "Error: XML file not found.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML Import Form</title>
    <style>
        .import{
            margin-left: 60%;
            margin-top: 5px;
        }
        button{
            margin-left: 3%;
        }
    </style>
</head>
<body>
<div class="import">
    <label for="xmlFile" style="margin-right: 10px;">IMPORT DATA (.XML)</label>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" style="display: flex; align-items: center;">

        <input type="file" name="xmlFile" id="xmlFile" accept=".xml" class="form-control" required style="width: 300px;">
        <button type="submit" name="uvezi" class="btn btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger">Import XML</button>
    </form>
</div>
</body>
</html>
