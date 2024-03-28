<?php
$title = "Administrators";
include('shared/header.php');

// * error handling
try {
    // * connect LAMP server
    include('shared/db.php');

    // * set up query to fetch users data
    $sql = "SELECT * FROM adminUsers";
    $cmd = $db ->prepare($sql);

    // * run query and store results as $users
    $cmd -> execute();
    $users = $cmd->fetchAll();
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}

// * show the list of users
echo '<h2> User List </h2>';

// * format the list as a table
echo 
    '<table>
        <thead>
            <th> First Name </th>
            <th> LastName </th>
            <th> Users </th>';
            if (!empty($_SESSION['username'])){
                echo'<th> Edit </th> ';
            }
            if (!empty($_SESSION['username'])){
                echo '<th> Delete </th>';
            }
        echo '</thead>';
    foreach ($users as $user){
        echo 
            '<tr>
                <td> ' . $user['firstName'] . '
                </td>
                <td> ' . $user['lastName'] . '
                </td>
                <td> ' . $user['username'] . ' </td>
                <td> 
                    <a href="edit-user.php?userId='.$user['userId'].' "> Edit </a> 
                </td>

                <td> 
                    <a href="delete-user.php?userId='.$user['userId'].' " onclick="return confirmDelete();"> Delete </a> 
                </td>
            ';
    }
    echo '</tr>';
    echo '</table>';
    echo '</main>';
// * disconnect db
$db = null;

?>
<?php
include('shared/footer.php');
?>