<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    include 'connect.php';


    echo "dit komt er binnen" .  $_GET['project'];

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT id, project_name, descr_short FROM projecten WHERE id = ". $_GET['project']);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($stmt->fetchAll() as $k => $v) {
            echo $v['id'] . ": ";
            echo $v['project_name'];
            echo " - " . $v['descr_short'];
            echo "<br>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    


    ?>
</body>

</html>