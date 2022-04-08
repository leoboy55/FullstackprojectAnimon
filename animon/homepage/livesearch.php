<?php
/** @noinspection ALL */
session_start();
require_once ("../db/db_connection.php");

if(isset($_POST["input"]) && isset($_SESSION["userEmail"])){
    $conn = newcon();
    $input = $_POST["input"];
    $query = "SELECT name, afbeelding, account_email, genre, idanimes, rating  FROM animes 
    INNER JOIN account_has_animes ON idanimes = animes_idanimes  
WHERE name LIKE '{$input}%' AND account_email = '" . $_SESSION["userEmail"] . "'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0)
    {
        ?>
        <table class="table table-border table-striped mt-4">
            <?php
            while($row = mysqli_fetch_assoc($result)) {

                $name = $row["name"];
                $afbeelding = $row["afbeelding"];
                $rating = $row["rating"];

                ?>
                <tr>
                    <td><?php echo "<a href='../Animelist/list.php'>" . $name; ?></td>
                    <td> <?php echo "<img src='$afbeelding'>";?></td>
                    <td> <?php echo dRating($rating); ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
<?php
    }
    else
    {
        echo "<h6 class='text-danger text-center mt-3'>NO ANIME FOUND</h6>";
    }
} else if (isset($_POST["input"]) && !isset($_SESSION["userEmail"])){
    $conn = newcon();
    $input = $_POST["input"];
    $query = "SELECT name, afbeelding, account_email, genre, idanimes, rating  FROM animes 
    INNER JOIN account_has_animes ON idanimes = animes_idanimes  
WHERE name LIKE '{$input}%' AND account_email = 'thomasleonardojr@gmail.com'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0)
    {
        ?>
        <table class="table table-border table-striped mt-4">
            <?php
            while($row = mysqli_fetch_assoc($result)) {

                $name = $row["name"];
                $afbeelding = $row["afbeelding"];
                $rating = $row["rating"];

                ?>
                <tr>
                    <td><?php echo "<a href='../Animelist/list.php'>" . $name; ?></td>
                    <td> <?php echo "<img src='$afbeelding'>";?></td>
                    <td> <?php echo dRating($rating); ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
}
function dRating($rating){
    for($i = 0; $i < 5; $i++){
        if($i < $rating){
            echo "★";
        }
        else {
            echo "☆";
        }
    }
}

