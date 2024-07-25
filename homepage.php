<?php
session_start();
include("connect.php");

$quotes = [
    "The best way to get started is to quit talking and begin doing. - Walt Disney",
    "The pessimist sees difficulty in every opportunity. The optimist sees opportunity in every difficulty. - Winston Churchill",
    "Don’t let yesterday take up too much of today. - Will Rogers",
    "You learn more from failure than from success. Don’t let it stop you. Failure builds character. - Unknown",
    "It’s not whether you get knocked down, it’s whether you get up. - Vince Lombardi",
    "If you are working on something that you really care about, you don’t have to be pushed. The vision pulls you. - Steve Jobs",
    "People who are crazy enough to think they can change the world, are the ones who do. - Rob Siltanen",
    "Failure will never overtake me if my determination to succeed is strong enough. - Og Mandino",
    "We may encounter many defeats but we must not be defeated. - Maya Angelou",
    "Knowing is not enough; we must apply. Wishing is not enough; we must do. - Johann Wolfgang Von Goethe"
];


if (isset($_SESSION['quote_of_the_day']) && isset($_SESSION['quote_timestamp']) && (time() - $_SESSION['quote_timestamp'] < 86400)) {
    
    $quote_of_the_day = $_SESSION['quote_of_the_day'];
} else {
   
    $quote_of_the_day = $quotes[array_rand($quotes)];
   
    $_SESSION['quote_of_the_day'] = $quote_of_the_day;
    $_SESSION['quote_timestamp'] = time();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        body {
            background-color: #f0f8ff;
            font-family: Arial, sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            padding: 3%;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .container p {
            margin: 20px 0;
        }
        .greeting {
            font-size: 50px;
            font-weight: bold;
            color: rgb(125, 125, 235);
        }
        .quote-title {
            font-size: 24px;
            font-weight: bold;
            color: rgb(125, 125, 235);
        }
        .quote {
            font-size: 20px;
            font-style: italic;
            color: rgb(125, 125, 235);
        }
        .logout {
            font-size: 18px;
            color: rgb(125, 125, 235);
            text-decoration: none;
            border: 2px solid rgb(125, 125, 235);
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        .logout:hover {
            background-color: rgb(125, 125, 235);
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <p class="greeting">
            Hello
            <?php
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $query = mysqli_query($conn, "SELECT users.* FROM users WHERE users.email='$email'");
                while ($row = mysqli_fetch_array($query)) {
                    echo $row['firstName'] . ' ' . $row['lastName'];
                }
            }
            ?>
        </p>
        <p class="quote-title">
            Quote of the Day
        </p>
        <p class="quote">
            "<?php echo $quote_of_the_day; ?>"
        </p>
        <a class="logout" href="logout.php">Logout</a>
    </div>
</body>
</html>