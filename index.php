<?php
include 'config.php';
$sql = "SELECT * FROM tblconcert order by concert_date";
$all_concert = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Concert Ticketing System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="hero">
        <nav>
            <div></div>
            <ul>
                <li><a href="register.php"><i class="fas fa-user-plus"></i> SIGN UP</a></li>
                <li><a href="login.php"><i class="fas fa-user"></i> LOGIN</a></li>
            </ul>
        </nav>
        <div class="content">
            <h1>CONCERT TICKETING SYSTEM</h1>
            <p>
                <i class="fas fa-music"></i> At South East Asian Institute Of Technology events, every beat tells a
                story, and every melody invites
                you to dance in the rhythm of the cosmos.
                <br>
                <i class="fas fa-map-marker-alt"></i> Only in Tupi, South Cotabato
            </p>
        </div>
    </div>

    <div class="container">
        <br>
        <h1 class="heading">AVAILABLE UPCOMING CONCERTS</h1>
        <p style="color:#2DAEB5FF; font-weight:bold;">
            <?php echo date('F j, Y') ?> -
            <?php echo date('F j, Y', strtotime(date('Y-m-t'))); ?>
        </p>
        <br>
        <p> Explore our vibrant lineup of upcoming events, where every beat tells a unique story. From chart-topping
            artists to emerging talents, our diverse selection offers an unforgettable musical experience. Discover the
            excitement and reserve your spot now!</p> <br>
        <p>Join us at South East Asian Institute Of Technology, where every event becomes a timeless memory.</p><br><br>

        <div class="box-container">
            <?php
            if ($all_concert->num_rows > 0) {
                while ($row = $all_concert->fetch_assoc()) {
                    ?>
                    <div class="box">
                        <?php echo '<img src="adminside/uploaded_img/' . $row["image"] . '" class="concert-image" alt="Concert Image">'; ?>
                        <h3>
                            <?php echo $row['concert_name']; ?>
                        </h3>
                        <p>
                            <?php echo date('F j, Y', strtotime($row['concert_date'])); ?><br>
                        </p>
                        <a href="login.php" class="btn">Buy Tickets</a>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="no-concerts">No concerts available.</div>';
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>