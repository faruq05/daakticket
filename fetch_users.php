<?php
require_once 'config.php';
header("Content-Type: application/json");

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit;
}

// Fetch user data
$userTable = "";
$query = "SELECT user_id, username, email, status, role_id, registration_date FROM user";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $userTable .= "<tr>
            <td>" . htmlspecialchars($row['user_id']) . "</td>
            <td>" . htmlspecialchars($row['username']) . "</td>
            <td>" . htmlspecialchars($row['email']) . "</td>
            <td>" . ($row['status'] == 1 ? 'Active' : 'Inactive') . "</td>
            <td>" . htmlspecialchars($row['role_id']) . "</td>
            <td>" . htmlspecialchars($row['registration_date']) . "</td>
        </tr>";
    }
} else {
    $userTable = "<tr><td colspan='6'>No users found</td></tr>";
}

// Fetch post history
$postHistoryTable = "";
$query = "SELECT history_id, post_id, user_id, change_description FROM post_history";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $postHistoryTable .= "<tr>
            <td>" . htmlspecialchars($row['history_id']) . "</td>
            <td>" . htmlspecialchars($row['post_id']) . "</td>
            <td>" . htmlspecialchars($row['user_id']) . "</td>
            <td>" . htmlspecialchars($row['change_description']) . "</td>
        </tr>";
    }
} else {
    $postHistoryTable = "<tr><td colspan='4'>No post history found</td></tr>";
}

$conn->close();

// Return data as JSON
echo json_encode([
    "userTable" => $userTable,
    "postHistoryTable" => $postHistoryTable
]);
