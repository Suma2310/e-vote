<?php
session_start();
include("database.php");

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    echo "<script>alert('Logged Out'); window.location.href = 'login.html';</script>";
    exit();
}

if (isset($_SESSION['voted']) && $_SESSION['voted'] == true) {
    $_SESSION['option'] = 2;
    header("Location: thankyou.php");
    exit();
}

$sql = "SELECT * FROM candidates";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>E-voting</title>
    <link rel="shortcut icon" href="./Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header class="header">
        <h1>Online Voting System</h1>
    </header>
    <div class="dashboard-container">
    <h2>Voter Dashboard</h2>
    <a href="?logout">Logout</a>
        <?php if(mysqli_num_rows($result) > 0) : ?>
        <div class="candidates-list">
            <h3>Choose Your Candidate:</h3>
            <form action="vote.php" method="post">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <input type="radio" name="candidate_id" value="<?php echo $row['id']; ?>">
                    <?php echo $row['name'] . ' - ' . $row['party']; ?><br>
                <?php endwhile; ?>
                <button type="submit">Vote</button>
            </form>
        </div>
        <?php else : ?>
            <div>
                <h3>No Candidate Available</h3>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
