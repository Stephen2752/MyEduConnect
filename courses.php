<?php
include 'config/db.php';

$result = $conn->query(
    "SELECT * FROM courses"
);

while($row = $result->fetch_assoc())
{
    echo "<h3>".$row['title']."</h3>";
    echo $row['description']."<br>";
    echo "RM ".$row['fee']."<br>";

    echo "<a href='enroll.php?id=".$row['id']."'>
          Enroll
          </a><hr>";
}
?>