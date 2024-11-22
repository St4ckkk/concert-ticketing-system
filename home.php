<?php
include 'config.php';
session_start();


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = null;
}

$sql = "SELECT * FROM tblconcert";
$all_concert = $conn->query($sql);

$select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
if (mysqli_num_rows($select) > 0) {
    $fetch = mysqli_fetch_assoc($select);
} else {
    $fetch = null;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}


$itemsPerPage = 3;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $itemsPerPage;
$sql = "SELECT * FROM tblconcert LIMIT $offset, $itemsPerPage";
$all_concert = $conn->query($sql);


$totalConcerts = $conn->query("SELECT COUNT(*) FROM tblconcert")->fetch_row()[0];
$totalPages = ceil($totalConcerts / $itemsPerPage);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>



    <header class="header" style="box-shadow:0 10px 10px rgba(0,0,0,.2);">

        <a href="home.php" class="logo">
            <i class="fas fa-music" style="color: #00ADB5;"></i>
            <span style="color:#00ADB5;">CONCERT TICKETING</span> SYSTEM</a>
        <nav class="navbar">
            <a href="#home"></i>Home</a>
            <a href="#concerts">Concerts</a>
            <a href="#about">About Us</a>
            <a href="#contact">Contact Us</a>
            <a href="ticketshistory.php">Tickets</a>
            <a href="update_profile.php"></i> Profile </a>
            <a href="login.php?logout=1 " class="logout">Log-Out</a>
        </nav>
        <div id="menu-bars" class="fas fa-bars">

        </div>


    </header>

    <script src="js/navbar.js"></script>


    <section class="home" id="home">
        <div class="wrapper">
            <div class="box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

        <div class="content">

            <h3><span> CONCERT TICKETING SYSTEM</span></h3>
            <a href="ticketshistory.php" class="btn">My Tickets</a>
        </div>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php
                $concerts = $conn->query("SELECT * FROM tblconcert");
                while ($concert = $concerts->fetch_assoc()) {
                    echo '<div class="swiper-slide">';
                    echo '<img src="adminside/uploaded_img/' . $concert["image"] . '" alt="' . $concert["concert_name"] . '">';
                    echo '</div>';
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <section class="con" id="concerts">
            <div class="content2">
                <h3>Upcoming <span>Concerts</span></h3>
                <p class="intro"> Get ready for an unforgettable music journey! We are thrilled to present our upcoming
                    concerts, where the stage will come alive with sensational performances by some of the most renowned
                    artists
                    in the industry. From heart-pounding rock to soulful melodies and electrifying pop beats, our
                    concerts promise
                    an exhilarating fusion of music genres that will leave you spellbound. Join us for a night of
                    rhythm, harmony,
                    and pure musical magic.</p>
            </div>
            <?php
            $startPage = max(1, $page - 2);
            $endPage = min($totalPages, $startPage + 4);

            // Adjust startPage if necessary to display 5 pages
            if ($endPage - $startPage + 1 < 5) {
                $startPage = max(1, $endPage - 4);
            }
            ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>">&lt;</a>
                <?php endif; ?>

                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" <?php if ($i == $page)
                           echo 'class="active"'; ?>>
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>">&gt;</a>
                <?php endif; ?>
            </div>
            <br>
            <?php
            while ($row = $all_concert->fetch_assoc()) {
                $concertId = $row["concert_id"];
                $url = 'concert.php?concert_id=' . urlencode($concertId);
                ?>
                <div class="container">
                    <div class="card">
                        <div class="imgBx">
                            <a href="#">
                                <?php echo '<img src="adminside/uploaded_img/' . $row["image"] . '">'; ?>
                                <h2><br>
                                    <?php echo $row["concert_name"]; ?>
                                </h2>
                                <div class="desc">
                                    <p><br>Artist Name:
                                        <?php echo $row["concert_artist"]; ?><br>
                                        Concert Date:
                                        <?php echo date('F j, Y', strtotime($row['concert_date'])); ?><br>
                                        Genre:
                                        <?php echo $row["concert_genre"]; ?> <br>
                                        Venue:
                                        <?php echo $row["concert_venue"]; ?>
                                    </p>
                                </div>
                                <div class="button-container">
                                    <a class="button" href="<?php echo $url; ?>">Learn More</a>
                                </div>
                        </div>
                    </div>
                    <?php
            }
            ?>
            </div>

        </section>
    </section>




    <script src="js/home.js"></script>
</body>