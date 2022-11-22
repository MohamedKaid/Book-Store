<?php
    // database connection $conn
	include_once 'dbConnect.php';
    // session_start();

    // get query parameters from url
    $cat = $_GET["category"];
    $sin = $_GET["searchon"];

    // first searchon query string will be an array
    if(is_array($sin)) {
        $sin = (string) $sin[0];
    }
    $sfor = $_GET["searchfor"];
    // $cartisbn = $_SESSION["array"]);

    // whether or not category selected
    $catSelected = 0;

    // begin query creation
    $query = "SELECT * FROM book";

    // apply category condition
    if(strcmp($cat, 'all') != 0) {
        $catSelected = 1;
        $query .= " WHERE category = ";

        switch ($cat) {
            case 1:
                $query .= "'Fantasy'";
                break;
            case 2:
                $query .= "'Adventure'";
                break;
            case 3:
                $query .= "'Fiction'";
                break;
            case 4:
                $query .= "'Horror'";
                break;
        }
    }
    
    // apply search condition
    $sfor = trim($sfor);
    if(!empty($sfor)) {
        if($catSelected) {
            $query .= " AND ";
        }
        
        $query .= " WHERE ";

        if(strcmp($sin, 'anywhere') != 0) {
            $query .= $sin." LIKE '%".$sfor."%'";
        } else {
            $query .= "title LIKE '%".$sfor."%' OR author LIKE '%".$sfor."%' OR 
            publisher LIKE '%".$sfor."%' OR isbn LIKE '%".$sfor."%'";
        }
    }
    // iterate through results and display
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
        echo "<tr><td align='left'><button name='btnCart' id='btnCart' onClick='";
        if(in_array($row["isbn"], $_SESSION["mycart"])) {
            echo "'> In Cart!";
        } else {
            echo "cart(\" ".$row["isbn"]." \", \" ".$sfor." \", \"" .$sin. "\", \"" .$cat. "\")'>Add to Cart";
        }
        echo "</button></td>";

        echo "
            <td rowspan='2' align='left'>".$row["title"]."</br>By ".$row["author"]."</br><b>Publisher:</b> ".$row["publisher"].",</br><b>ISBN:</b> ".($row["isbn"])."</t> <b>Price:</b> ".$row["cost"]."</td>
        </tr>
        <tr>
            <td align='left'><button name='review' id='review' onClick='review(\"".$row["isbn"]."\", \"".$row["title"]."\")'>Reviews</button></td>
        </tr>
        <tr>
            <td colspan='2'><p>_______________________________________________</p></td>
        </tr>	";
    }
?>