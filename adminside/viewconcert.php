<?php
include "config.php";
$sql = "SELECT * FROM tblconcert";
$all_concert = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en" title="Coding design">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Concert</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</head>
<div class="sidebar">
    <img src="images/logo.png" alt="Logo">
    <div class="sidebar-nav">
        <a href="dashboard.php">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="viewbuyer.php">
            <i class="fas fa-ticket-alt"></i> Buyers
        </a>
        <a href="viewconcert.php">
            <i class="fas fa-music"></i> Concerts
        </a>
        <a href="viewusers.php">
            <i class="fas fa-users"></i> Users
        </a>
        <a href="../login.php">
            <i class="fas fa-sign-out-alt"></i> Exit
        </a>
    </div>
</div>

<body>
    <main class="table">
        <section class="table__header">
            <h1>Concert Event Information</h1>
            <div class="input-group">
                <input type="text" name="search" class="searchinput" placeholder="Search Data...">
                <img src="images/search.png" alt="">
            </div>
            <div class="add-button">
                <a href="insertconcert.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Concert</a>
            </div>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Concert ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Artist</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Venue</th>
                        <th scope="col">UB Price</th>
                        <th scope="col">LB Price</th>
                        <th scope="col">VIP Price</th>
                        <th scope="col">GEN AD Price</th>
                        <th scope="col">Concert Contact</th>
                        <th scope="col">Concert Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $all_concert->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['concert_id'] ?></td>
                            <td><?php echo $row['concert_name'] ?></td>
                            <td><?php echo $row['concert_date'] ?></td>
                            <td><?php
                            $convertedTime = date("h:i A", strtotime($row['concert_time']));
                            echo $convertedTime;
                            ?></td>
                            <td><?php echo $row['concert_artist'] ?></td>
                            <td><?php echo $row['concert_genre'] ?></td>
                            <td><?php echo $row['concert_venue'] ?></td>
                            <td><?php echo '&#8369;' . number_format($row['ub_price'], 2) ?></td>
                            <td><?php echo '&#8369;' . number_format($row['lb_price'], 2) ?></td>
                            <td><?php echo '&#8369;' . number_format($row['vip_price'], 2) ?></td>
                            <td><?php echo '&#8369;' . number_format($row['genad_price'], 2) ?></td>
                            <td><?php echo $row['concert_contact'] ?></td>
                            <td><?php echo $row['image'] ?></td>
                            <td>
                                <a href="editconcert.php?concert_id=<?php echo $row['concert_id'] ?>" class="link-dark"><i
                                        class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                                <a href="insertconcert.php?concert_id=<?php echo $row['concert_id'] ?>" class="link-dark"><i
                                        class="fa-solid fa-plus-square fs-5 me-3"></i></a>
                                <a href="#" class="link-dark" onclick="confirmDelete(<?php echo $row['concert_id'] ?>)">
                                    <i class="fa-solid fa-trash fs-5 "></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function confirmDelete(concert_id) {
            var confirmation = confirm("Are you sure you want to delete this concert?");
            if (confirmation) {
                window.location.href = "deleteconcert.php?concert_id=" + concert_id;
            }
        }

        $(document).ready(function () {
            $('.searchinput').keyup(function () {
                // Get the search query
                var query = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: 'searchconcert.php',
                    data: {
                        query: query
                    },
                    dataType: 'json',
                    success: function (response) {
                        // Update the table with the received data
                        updateTable(response);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Function to update the table with search results
            function updateTable(data) {
                var tableBody = $('tbody');
                tableBody.empty();

                if (data.length > 0) {
                    // Append the new rows to the table
                    $.each(data, function (index, row) {
                        var formattedUbPrice = new Intl.NumberFormat('en-PH', {
                            style: 'currency',
                            currency: 'PHP'
                        }).format(row.ub_price);

                        var formattedLbPrice = new Intl.NumberFormat('en-PH', {
                            style: 'currency',
                            currency: 'PHP'
                        }).format(row.lb_price);

                        var formattedVipPrice = new Intl.NumberFormat('en-PH', {
                            style: 'currency',
                            currency: 'PHP'
                        }).format(row.vip_price);

                        var formattedGenadPrice = new Intl.NumberFormat('en-PH', {
                            style: 'currency',
                            currency: 'PHP'
                        }).format(row.genad_price);

                        var newRow = '<tr>';
                        newRow += '<td>' + row.concert_id + '</td>';
                        newRow += '<td>' + row.concert_name + '</td>';
                        newRow += '<td>' + row.concert_date + '</td>';
                        newRow += '<td>' + row.concert_time + '</td>';
                        newRow += '<td>' + row.concert_artist + '</td>';
                        newRow += '<td>' + row.concert_genre + '</td>';
                        newRow += '<td>' + row.concert_venue + '</td>';
                        newRow += '<td>' + formattedUbPrice + '</td>';
                        newRow += '<td>' + formattedLbPrice + '</td>';
                        newRow += '<td>' + formattedVipPrice + '</td>';
                        newRow += '<td>' + formattedGenadPrice + '</td>';
                        newRow += '<td>' + row.concert_contact + '</td>';
                        newRow += '<td>' + row.image + '</td>';
                        newRow += '<td>';
                        newRow += '<a href="editconcert.php?concert_id=' + row.concert_id +
                            '" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>';
                        newRow += '<a href="insertconcert.php?concert_id=' + row.concert_id +
                            '" class="link-dark"><i class="fa-solid fa-plus-square fs-5 me-3"></i></a>';
                        newRow += '<a href="#" onclick="confirmDelete(' + row.concert_id +
                            ')" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>';
                        newRow += '</td>';
                        newRow += '</tr>';
                        tableBody.append(newRow);
                    });
                } else {
                    // Handle no results scenario
                    var noResultsRow = '<tr><td colspan="14">No results found</td></tr>';
                    tableBody.append(noResultsRow);
                }
            }
        });
    </script>
</body>

</html>