<?php
session_start();
include("database.php");

function removeCandidate($conn, $id)
{
    $sql = "DELETE FROM candidates WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Candidate removed successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['declare_result'])) {
    $highest_votes_query = "SELECT * FROM candidates ORDER BY votes DESC LIMIT 1";
    $result = mysqli_query($conn, $highest_votes_query);
    if ($result && mysqli_num_rows($result) > 0) {
        $highest_votes_candidate = mysqli_fetch_assoc($result);
        $winner_name = $highest_votes_candidate['name'];
        $winner_party = $highest_votes_candidate['party'];
        $result_declared = true;
    } else {
        echo "<script>alert('Members not found'); window.location.href = 'admindash.php';</script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_candidate'])) {
    $name = $_POST['name'];
    $party = $_POST['party'];

    $sql = "INSERT INTO candidates (name, party, votes) VALUES ('$name', '$party', 0)";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Unwanted Error'); window.location.href = 'admindash.php';</script>";
    }
    header("Location: admindash.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    echo "<script>alert('Logged Out'); window.location.href = 'login.html';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_candidate'])) {
    $candidate_id = $_POST['candidate_id'];
    removeCandidate($conn, $candidate_id);
    header("Location: admindash.php");
    exit();
}

$candidates_query = "SELECT * FROM candidates";
$candidates_result = mysqli_query($conn, $candidates_query);
$num_candidates = mysqli_num_rows($candidates_result);

?>

<!DOCTYPE html>
<html>

<head>
    <title>E-voting</title>
    <link rel="stylesheet" href="./styles.css">
    <link rel="shortcut icon" href="./Store/Logo.png" type="image/x-icon">
</head>

<body>
    <header class="header">
        <h1>Online Voting System</h1>
    </header>
    <div class="admin-panel">
        <h2>Admin Dashboard</h2>
        <a href="?logout">Logout</a>
        <?php if (isset($result_declared) && $result_declared) : ?>
            <h2>Winner:</h2>
            <p>Winner: <?php echo $winner_name; ?> (Party: <?php echo $winner_party; ?>)</p>
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['back'])) {
                header("Location: admindash.php");
                exit();
            } ?>
            <form action="admindash.php" method="post">
                <button type="submit" name="back">Back</button>
            </form>
        <?php else : ?>
            <?php if ($num_candidates > 0) : ?>
                <div class="candidates-list">
                    <h3>Candidates List:</h3>
                    <ul>
                        <?php while ($row = mysqli_fetch_assoc($candidates_result)) : ?>
                            <li>
                                <?php echo $row['name'] . '</br>' . $row['party'] . '</br> Votes: ' . $row['votes']; ?>
                                <form action="admindash.php" method="post" style="display: inline;">
                                    <input type="hidden" name="candidate_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="remove_candidate">Remove</button>
                                </form>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <h2>Add Candidate</h2>
            <form action="admindash.php" method="post">
                <input type="text" name="name" placeholder="Candidate Name" required>
                <input type="text" name="party" placeholder="Party Name" required>
                <div class="btn">
                    <button type="submit" name="add_candidate">Add Candidate</button>
                </div>
            </form>
            <?php if ($num_candidates > 0) : ?>
                <form action="admindash.php" method="post">
                    <button type="submit" name="declare_result">Declare Result</button>
                </form>
                <form action="download.php" method="post">
                    <button type="submit" name="download">Download Voters List</button>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>

</html>