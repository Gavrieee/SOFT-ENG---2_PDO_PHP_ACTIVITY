<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid;
            padding: 5px;
            margin: 5px;
            border-collapse: separate;
            border-spacing: 15px;
        }
        tr:nth-child(even) {
            background-color: #87ffa7;
        }
        th, td {
            padding-left: 25px;
            padding-right: 25px;
            text-align: center;
        }
    </style>
</head>
<body>

    <?php 

// NO. 3

    $stmt = $pdo->prepare("SELECT * FROM Users"); // Prints all users from the Users table

    if($stmt->execute()) {
        echo "<pre>";
        print_r($stmt->fetchAll());
        echo "<pre>";
    }

// NO. 4

    $stmt = $pdo->prepare("SELECT * FROM Songs WHERE song_id = 23"); // Selects the song_id of 23 from the songs 

    if($stmt->execute()) {
        echo "<pre>";
        print_r($stmt->fetch()); // Fetches the row of 23
        echo "<pre>";
    }

// NO. 5

    $query = "INSERT INTO Genres (genre_id, name) VALUES (?,?)"; // Will insert a row based on given values

    $stmt = $pdo->prepare($query);

    $executeQuery = $stmt->execute([ // Inserts these values onto the Genres table
        52, 'Jejemon'
    ]);

    if ($executeQuery){
        echo "Query Successful!!!";
    } else {
        "Query Unsuccessful!!";
    }

// NO. 6

    $query = "DELETE FROM Streaming_History WHERE history_id = 1"; //Will delete the row with an id of 1

    $stmt = $pdo->prepare($query);

    $executeQuery = $stmt->execute(); // Deletes the said id of 1

    if ($executeQuery){
        echo "Deletion Successful!!!";
    } else {
        "Deletion Unsuccessful!!";
    }

// NO. 7

    $query = "UPDATE Artists SET username = ?, genre_id = ?, birth_date = ? WHERE artist_id = 23"; // Wil update the row from Artists table

    $stmt = $pdo->prepare($query);

    $executeQuery = $stmt->execute([
        "Yves", 10, "2003-10-23"
    ]); // Updates the row id of 23 with the given values

    if($executeQuery){
        echo "Updated Successfully!!!";
    } else {
        echo "Updated Unsuccessfully!!";
    }

// NO. 8

    $query = "SELECT
                    Users.user_id as ID,
                    Users.username as Username,
                    COUNT(Streaming_History.user_id) as Total_Songs_Listened

                    FROM Streaming_History

                    JOIN Songs on Songs.song_id = Streaming_History.song_id
                    JOIN Users on Users.user_id = Streaming_History.user_id

                    WHERE Users.user_id = 3;
                    ";

    $stmt = $pdo->prepare($query);

    $executeQuery = $stmt->execute(); 

    if($executeQuery){
        $TotalSongsUser = $stmt->fetchAll();
    } else {
        echo "Query Failed!!";
    }

    ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Total_Songs_Listened</th>
        </tr>
        <?php foreach($TotalSongsUser as $row) ?>
        <tr>
            <td><?php echo $row['ID']?></td>
            <td><?php echo $row['Username']?></td>
            <td><?php echo $row['Total_Songs_Listened']?></td>
        </tr>
    </table>
    
</body>
</html>
