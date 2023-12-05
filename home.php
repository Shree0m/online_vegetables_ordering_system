<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}
else{
    $user_id = '';
}

include 'components/add_cart.php';

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Swiper Link for swipe content -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

    <!-- Font Link Cdnjs -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- CSS links -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    
<!-- Header Section Starts -->
<?php include 'components/user_header.php'; ?>
<!-- Header Section Ends -->



<!-- Home Section Starts -->

<section class="hero">

    <div class="swiper hero-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Order Online</span>
                    <h3>Fresh Vegetable</h3>
                    <a href="menu.php" class="btn">See Menus</a>
                </div>
                <div class="image">
                    <img src="images/home-content-img-1.png">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Order Online</span>
                    <h3>Organic Fruits</h3>
                    <a href="menu.php" class="btn">See Menus</a>
                </div>
                <div class="image">
                    <img src="images/home-content-img-2.png">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Order Online</span>
                    <h3>Dry Fruits</h3>
                    <a href="menu.php" class="btn">See Menus</a>
                </div>
                <div class="image">
                    <img src="images/home-content-img-3.png">
                </div>
            </div>

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>

<!-- Home Section Ends -->


<!-- Home Catagory Section Starts -->

<section class="category">

    <h1 class="title">Our Category</h1>
    
    <div class="box-container">

        <a href="#" class="box">
            <img src="images/cat-1.png" alt="">
            <h3>Stachy Veg.</h3>
        </a>

        <a href="#" class="box">
            <img src="images/cat-2.png" alt="">
            <h3>Non-Starchy Veg.</h3>
        </a>

        <a href="#" class="box">
            <img src="images/cat-3.png" alt="">
            <h3>Normal Fruits</h3>
        </a>

        <a href="#" class="box">
            <img src="images/cat-4.png" alt="">
            <h3>Dry Fruits</h3>
        </a>

    </div>

</section>

<!-- Home Catagory Section Ends -->


<!-- Home Products Section Starts -->

<section class="products">

    <h1 class="title"> Latest Food</h1>

    <div class="box-container">
        <?php
            $select_products = $conn->prepare("SELECT * FROM products LIMIT 6");
            $select_products->execute();
            if($select_products->rowCount() > 0){
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC))
                {  
        ?>

        <form action="" method="post" class="box">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
            <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
            <button type="submit" name="add_to_cart" class="fas fa-shopping-cart"></button>
            <img src="uploaded_img/<?= $fetch_products['image']; ?>" class="image" alt="">
            <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
            <div class="name"><?- $fetch_products['name']; ?></div>
            <div class="flex">
                <div class="price"><span>Rs.</span><?= $fetch_products['price']; ?><span> (Kg)</span></div>
                <input type="number" name="qty" class="qty" value="1"  min="1" max="99" maxlength="0">
            </div>
        </form>
        <?php
                }
            }else{
                echo '<p class="empty">No Products Added Yet!</p>';

            }
        ?>
    </div>

    <div class="more-btn">
        <a href="menu.php" class="btn">Load More</a>
    </div>

</section>

<!-- Home Products Section Ends -->



<!-- Footer Section Starts -->
<?php include 'components/footer.php'; ?>
<!-- Footer Section Ends -->



<!--
<div class="loader">
    <img src="images/loader.gif" alt="">
</div>
        -->




<!-- Swiper JS Code -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<!-- JavaScript File Link-->
<script src="js/script.js"></script>

<!-- Swiper Pagination JS -->
<script>
    var swiper = new Swiper(".hero-slider", {
      loop:true,  
      effect: "flip",
      grabCursor: true,
      pagination: {
        el: ".swiper-pagination",
        clickable:true
      },
    });
  </script>

</body>
</html>