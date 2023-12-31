<?php
require_once('src/Record.php');

$db = new PDO('mysql:host=db;dbname=record_collection', 'root', 'password');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$query = $db->prepare('SELECT `id`, `album_name`, `artist_name`, `year`, `record_label`, `number_of_tracks` FROM `albums`');
$query ->execute([]);
$recordCollection = $query->fetchAll();

$recordCollectionAsObjects = [];
foreach ($recordCollection as $record) {
    $record = new Record ($record['album_name'], $record['artist_name'], $record['year'], $record['record_label'], $record['number_of_tracks']);
    array_push($recordCollectionAsObjects, $record);
}
?>
<html lang="en-GB">
    <head>
        <title>My Record Collection</title>
        <link rel="stylesheet" type="text/css" href="src/style.css">
    </head>
    <body>
        <header>
            <h1>My Record Collection</h1>
        </header>
        <section class="card-container">
            <?php
                foreach ($recordCollectionAsObjects as $recordObject) {
                    echo $recordObject->createRecordCard();
                }
            ?>
        </section>
    </body>
</html>