<?php
    header("Content-Type: application/json");
    require_once("database.php");

    $lb = [];

    $result = $conn->query("SELECT name, duplicatesEnabled, timeTaken, attempts, attemptedAt FROM mastermind_leaderboard ORDER BY timeTaken, attempts DESC;");
    while($row = $result->fetch_assoc()) {
        if($row["duplicatesEnabled"] == 1) $row["duplicatesEnabled"] = true;
        else $row["duplicatesEnabled"] = false;
        $row["timeTaken"] = intval($row["timeTaken"]);
        $row["attemptedAt"] = date("r", intval($row["attemptedAt"]));
        $row["attempts"] = intval($row["attempts"]);
        $lb[] = $row;
    }
    $conn->close();

    die(json_encode($lb));