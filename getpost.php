<?php
$filename = 'votes.txt';

if (!file_exists($filename)) {
    $initialVotes = [
        'Rosary Bea' => 0,
        'Be-ann' => 0,
        'Daniel' => 0,
        'Ciara May' => 0,
        'Jose Gabriel' => 0,
    ];
    file_put_contents($filename, json_encode($initialVotes));
}

$votes = json_decode(file_get_contents($filename), true);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote'])) {
    $votedMember = $_POST['vote'];

    if (isset($votes[$votedMember])) {
        $votes[$votedMember]++;
        file_put_contents($filename, json_encode($votes));
        echo "<p>Thank you for voting for $votedMember!</p>";
    } else {
        echo "<p>Invalid vote.</p>";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['show_votes']) && $_GET['show_votes'] === 'true') {
        echo "<h2>Current Votes:</h2>";
        echo "<ul>";
        foreach ($votes as $name => $count) {
            echo "<li>" . htmlspecialchars("$name: $count votes") . "</li>";
        }
        echo "</ul>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group 2: Group Website</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>

<h1>Vote for Your Favorite Group Member</h1>

<form method="POST">
    <div class="member">
        <img src="group photos/rb.jpg" alt="Rosary Bea">
        <button name="vote" value="Rosary Bea">Vote for Rosary Bea</button>
    </div>
    <div class="member">
        <img src="group photos/b.jpg" alt="Be-ann">
        <button name="vote" value="Be-ann">Vote for Be-ann</button>
    </div>
    <div class="member">
        <img src="group photos/daniel.jpg" alt="Daniel">
        <button name="vote" value="Daniel">Vote for Daniel</button>
    </div>
    <div class="member">
        <img src="group photos/may.jpg" alt="Ciara May">
        <button name="vote" value="Ciara May">Vote for Ciara May</button>
    </div>
    <div class="member">
        <img src="group photos/jose.jpg" alt="Jose Gabriel">
        <button name="vote" value="Jose Gabriel">Vote for Jose Gabriel</button>
    </div>
</form>

<!-- Add a link to show votes -->
<a href="?show_votes=true">Show Current Votes</a>

</body>
</html>