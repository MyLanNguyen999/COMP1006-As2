<?php
$title = "Pages";
include('shared/header.php');

// * error handling
try {
    // * connect db
    include('shared/db.php');

    // * query to fetch page data
    $sql = "SELECT * FROM adminPages";
    $cmd = $db -> prepare($sql);

    // * run query and store results as $pages
    $cmd -> execute();
    $titles = $cmd->fetchAll();
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}
// * show the pages
echo '<h2> Pages </h2>';
// * formar the pages into table
echo   
    '<table>
        <thead>
            <th> Pages </th>';
            if (!empty($_SESSION['username'])){
                echo'<th> Edit </th> ';
            }
            if (!empty($_SESSION['username'])){
                echo '<th> Delete </th>';
            }
        echo '</thead>';
    foreach ($titles as $title) {
        echo 
            '<tr>
                <td> ' . $title['title'] . ' </td>
                <td> 
                    <a href="edit-page.php?pageId='.$title['pageId'].' "> Edit </a> 
                </td>

                <td> 
                    <a href="delete-page.php?pageId='.$title['pageId'].' " onclick="return confirmDelete();"> Delete </a> 
                </td>
            ';
    }
    echo '</tr>';
    echo '</table>';
    echo '</main>';
// * disconnect db
$db = null;
?>