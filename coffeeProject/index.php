<?php 
session_start(); 
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    


  

    <header class="header">
        <div id="menu-btn" class="fas fa-bars"></div>
        <a href="#" class="logo">Coffee Shop <i class="fas fa-mug-hot"></i> </a>
        <nav class="navbar">
            <a href="/coffeeProject">home</a>
            <a href="#about">about</a>
            <a href="#menu">menu</a>
            <a href="#review">review</a>
            <a href="#contactUs">contact us</a>
        </nav>
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
            <div> <a href="/coffeeProject/menu.php" class="btn">order now</a>
            <a href="./php/logout.php" class="btn">Logout</a></div>
           
        <?php else: ?>
            <a href="./php/signin.php" class="btn">Login</a>
        <?php endif; ?>
    </header>



<section class="home" id="home">

    <div class="row">

        <div class="content">
            <h3>fresh coffee in the morning</h3>
            <a href="#" class="btn">buy one now</a>
        </div>

        <div class="image">
            <img src="image/home-img-1.png" class="main-home-image" alt="">
        </div>

    </div>

    <div class="image-slider">
        <img src="image/home-img-1.png" alt="">
        <img src="image/home-img-2.png" alt="">
        <img src="image/home-img-3.png" alt="">
    </div>

</section>



<section class="about" id="about">

    <h1 class="heading"> about us <span>why choose us</span> </h1>    

    <div class="row">

        <div class="image">
            <img src="image/about-img.png" alt="">
        </div>

        <div class="content">
            <h3 class="title">what's make our coffee special!</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Esse et commodi, ad, doloremque obcaecati maxime quam minima dolore mollitia saepe quos, debitis incidunt. Itaque possimus adipisci ipsam harum at autem.</p>
            <a href="#" class="btn">read more</a>
            <div class="icons-container">
                <div class="icons">
                    <img src="image/about-icon-1.png" alt="">
                    <h3>quality coffee</h3>
                </div>
                <div class="icons">
                    <img src="image/about-icon-2.png" alt="">
                    <h3>our branches</h3>
                </div>
                <div class="icons">
                    <img src="image/about-icon-3.png" alt="">
                    <h3>free delivery</h3>
                </div>
            </div>
        </div>

    </div>

</section>




<?php include './php/config.php'; ?>
<section class="menu" id="menu">
    <h1 class="heading"> our menu <span>popular menu</span> </h1>
    <div class="box-container">
        <?php
        // Select only the first 4 menu items
        $sql = "SELECT * FROM menu_items LIMIT 4";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<a href="#" class="box">';
                echo '<img src="./image/' . $row["image_url"] . '" alt="">';
                echo '<div class="contentMenu">';
                echo '<div class="content">';
                echo '<h3>' . $row["name"] . '</h3>';
                echo '<p>' . $row["description"] . '</p>';
                echo '<span>$' . $row["price"] . '</span>';
                echo '</div>';
                // echo '<button href="#" class="btnBook">Order</button>';
                echo '</div>';
                echo '</a>';
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>
    <div class="view"><a href="./menu.php" class="btn">view more</a></div>
</section>



<section class="review" id="review">

    <h1 class="heading"> reviews <span>what people says</span> </h1>

    <div class="swiper review-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide box">
                <i class="fas fa-quote-left"></i>
                <i class="fas fa-quote-right"></i>
                <img src="image/pic-1.png" alt="">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore aliquid eveniet qui, similique aut sit.</p>
                <h3>john deo</h3>
                <span>satisfied client</span>
            </div>

            <div class="swiper-slide box">
                <i class="fas fa-quote-left"></i>
                <i class="fas fa-quote-right"></i>
                <img src="image/pic-2.png" alt="">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore aliquid eveniet qui, similique aut sit.</p>
                <h3>john deo</h3>
                <span>satisfied client</span>
            </div>

            <div class="swiper-slide box">
                <i class="fas fa-quote-left"></i>
                <i class="fas fa-quote-right"></i>
                <img src="image/pic-3.png" alt="">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore aliquid eveniet qui, similique aut sit.</p>
                <h3>john deo</h3>
                <span>satisfied client</span>
            </div>

            <div class="swiper-slide box">
                <i class="fas fa-quote-left"></i>
                <i class="fas fa-quote-right"></i>
                <img src="image/pic-4.png" alt="">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore aliquid eveniet qui, similique aut sit.</p>
                <h3>john deo</h3>
                <span>satisfied client</span>
            </div>

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>



<section class="book" id="contactUs">

    <h1 class="heading"> contactUs  </h1>

    <form action="">

        <input type="text" placeholder="your name" class="box">
        <input type="email" placeholder="your email" class="box">
        <input type="number" placeholder="subject" class="box">

        <textarea name="" placeholder="your message" class="box" id="" cols="30" rows="10"></textarea>

        <button onclick="alert('Thankyou for contact us')";><input type="submit" value="send message" class="btn"></button>

    </form>

</section>



<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>our branches</h3>
            <a href="#"> <i class="fas fa-arrow-right"></i> Beirut </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> Baabda </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> Aley </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> Harisa </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> Tyre </a>
        </div>

        <div class="box">
            <h3>quick links</h3>
            <a href="#"> <i class="fas fa-arrow-right"></i> home </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> about </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> menu </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> review </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> book </a>
        </div>

        <div class="box">
            <h3>contact info</h3>
            <a href="#"> <i class="fas fa-phone"></i> +96170891093 </a>
            <a href="#"> <i class="fas fa-phone"></i> +96171361731 </a>
            <a href="#"> <i class="fas fa-envelope"></i> 11931339@students.liu.edu.lb </a>
            <a href="#"> <i class="fas fa-envelope"></i> 42030237@students.liu.edu.lb </a>
        </div>

        <div class="box">
            <h3>contact info</h3>
            <a href="https://facebook.com"> <i class="fab fa-facebook-f"></i> facebook </a>
            <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
            <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
        </div>

    </div>

    <div class="credit">   all Copyrights reserved &copy;</div>

</section>





























<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>


<script src="js/script.js"></script>

</body>
</html>