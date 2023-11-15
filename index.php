<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
 
<body>
 
 <form action="index.php" methode="GET">
    <input name="searchtext" type="text">
    <input name="search" value="Zoeken" type="submit">
 </form>
 
 
    <?php
 
    include 'connect.php';
 
    $where = "";
 
    if (empty($_GET['searchtext'])){
    } else {
        $searchtext = $_GET['searchtext'];
        echo $searchtext;
        $where = "WHERE name OR description_short LIKE '%$searchtext%'";
    }
 
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT id, name, description_short FROM projects $where");
        $stmt->execute();
 
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($stmt->fetchAll() as $k => $v) {
            echo "<a href='detail.php?project=" . $v['id'] . "'>view detials</a>";
            echo $v['id'] . ": ";
            echo $v['name'];
            echo " - " . $v['description_short'];
            echo "<br>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
 
    // try {
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     $stmt = $conn->prepare("SELECT id, name, discription_short FROM projects");
    //     $stmt->execute();
 
    //     // set the resulting array to associative
    //     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //     foreach ($stmt->fetchAll() as $k => $v) {
    //         echo "<a href='detail.php?project=" . $v['id'] . "'>view detials</a>";
    //         echo $v['id'] . ": ";
    //         echo $v['name'];
    //         echo " - " . $v['discription_short'];
    //         echo "<br>";
    //     }
    // } catch (PDOException $e) {
    //     echo "Error: " . $e->getMessage();
    // }
    $conn = null;
    ?>
 
</body>
 
</html>