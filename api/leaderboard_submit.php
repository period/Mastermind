<?php
    header("Content-Type: application/json");
    $reqInput = json_decode(file_get_contents("php://input"), true);

    if(empty($reqInput["code"]) || empty($reqInput["name"]) || empty($reqInput["duplicates"]) || empty($reqInput["attempts"]) || empty($reqInput["started"]) || empty($reqInput["guesses"])) {
        http_response_code(400);
        die("{\"message\": \"Missing field\"}");
    }

    $reqInput["name"] = htmlspecialchars($reqInput["name"]);
    if(strlen($reqInput["name"]) > 32 || strlen($reqInput["name"]) < 3) {
        http_response_code(400);
        die("{\"message\": \"Name too long or short\"}");
    }

    $timeTaken = time() - $reqInput["started"];
    if($timeTaken > 3600 || $reqInput["attempts"] > 50) {
        http_response_code(400);
        die("{\"message\": \That's far from leaderboard worthy\"}");
    }
    $duplicatesEnabled = 1;
    if($reqInput["duplicates"] == false) $duplicatesEnabled = 0;

    if(sizeof($reqInput["code"]) != 4) {
        http_response_code(400);
        die("{\"message\": \"Invalid code\"}");
    }

    $hexRegex = "/^(\#[\da-f]{3}|\#[\da-f]{6}|rgba?\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)(,\s*(0\.\d+|1))?\)|hsla?\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)(,\s*(0\.\d+|1))?\))$/"; // https://stackoverflow.com/questions/12837942/regex-for-matching-css-hex-colors/45478147


    foreach($reqInput["code"] as $code) {
        if(preg_match($hexRegex, $code) == false) {
            http_response_code(400);
            die("{\"message\": \"Invalid code - not int\"}");
        }
    }
    foreach($reqInput["guess"] as $guess) {
        foreach($guess as $guessedNumber) {
            if(preg_match($hexRegex, $guessedNumber) == false) {
                http_response_code(400);
                die("{\"message\": \"Invalid guess\"}");
            }
        }
    }

    $guesses = json_encode($reqInput["guesses"]);
    $correctCode = json_encode($reqInput["code"]);


    require_once("database.php");

    $stmt = $conn->prepare("INSERT INTO mastermind_leaderboard VALUES (null, ?, ?, ?, ?, UNIX_TIMESTAMP(), ?, ?);");
    $stmt->bind_param("siiiss", $reqInput["name"], $duplicatesEnabled, $timeTaken, $reqInput["attempts"], $guesses, $correctCode);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    http_response_code(201);
