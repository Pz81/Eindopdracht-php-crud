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

 <form action="index.php" method="GET">
    <input type="date" name="date_from">
    <input type="date" name="date_till">
    <input type="submit" name="date_filter">
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

    if (!empty($_GET['date_filter'])){
        $date_from = $_GET['date_from'];
        $date_till = $_GET['date_till'];
        $where = "WHERE input_date BETWEEN ('".$date_from."') AND ('".$date_till."')";
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



    $conn = mysqli_connect('localhost', 'root', '');  

    // root is the default username 

    // ' ' is the default password
    if (! $conn) {  

        die("Connection failed" . mysqli_connect_error());  

} 

else {  

        // connect to the database named module13

        mysqli_select_db($conn, 'module13');  

}  

// variable to store number of rows per page

$limit = 5;  

// query to retrieve all rows from the table input_date

$getQuery = "select *from projects";    

// get the result

$result = mysqli_query($conn, $getQuery);  

$total_rows = mysqli_num_rows($result);    

// get the required number of pages

$total_pages = ceil ($total_rows / $limit);    

// update the active page number

if (!isset ($_GET['page']) ) {  

   $page_number = 1;  

} else {  

   $page_number = $_GET['page'];  

}    

// get the initial page number

$initial_page = ($page_number-1) * $limit;   

// get data of selected rows per page    

$getQuery = "SELECT *FROM projects LIMIT " . $initial_page . ',' . $limit;  

$result = mysqli_query($conn, $getQuery);       

//display the retrieved result on the webpage  

while ($row = mysqli_fetch_array($result)) {  

   echo "<a href='detail.php?project=" . $row['id'] . "'>view detials</a>";
            echo $row['id'] . ": ";
            echo $row['name'];
            echo " - " . $row['description_short'];
            echo " - " . $row['input_date'];
            echo "<br>"; 

}    

// show page number with link   

for($page_number = 1; $page_number<= $total_pages; $page_number++) {  

   echo '<a href = "index.php?page=' . $page_number . '">' . $page_number . ' </a>';  

}    


   
 
    ?>
 
</body>
 
</html>