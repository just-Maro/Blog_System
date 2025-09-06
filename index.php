<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location:Login.php');
  exit();
}
require_once 'db/connection.php';

$numOfPosts = " SELECT COUNT(*) as total FROM posts";
$postRes = mysqli_query($con, $numOfPosts);
$totalPosts = mysqli_fetch_assoc($postRes)['total'];
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

$limit = 3;
$offset = ($page - 1) * $limit;
$numOfPages = ceil($totalPosts / $limit);
if ($page < 1) {
  $page = 1;
} else if ($page > $numOfPages) {
  $page = $numOfPages;
}

require_once 'inc/header.php';
$query = "SELECT * FROM posts LIMIT $limit OFFSET $offset";
$result = mysqli_query($con, $query);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>
<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="banner header-text">
  <div class="owl-banner owl-carousel">
    <div class="banner-item-01">
      <div class="text-content">
        <!-- <h4>Best Offer</h4> -->
        <!-- <h2>New Arrivals On Sale</h2> -->
      </div>
    </div>
    <div class="banner-item-02">
      <div class="text-content">
        <!-- <h4>Flash Deals</h4> -->
        <!-- <h2>Get your best products</h2> -->
      </div>
    </div>
    <div class="banner-item-03">
      <div class="text-content">
        <!-- <h4>Last Minute</h4> -->
        <!-- <h2>Grab last minute deals</h2> -->
      </div>
    </div>
  </div>
</div>
<!-- Banner Ends Here -->
<div class="latest-products">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php
        if (isset($_SESSION['successLogin'])) {
          echo '<div class="d-flex justify-content-center w-50 m-auto alert alert-success" role="alert">' . $_SESSION['successLogin'] . '</div>';
          unset($_SESSION['successLogin']);
        }
        if (isset($_SESSION['successDelete'])) {
          echo '<div class="d-flex justify-content-center w-50 m-auto alert alert-success" role="alert">' . $_SESSION['successDelete'] . '</div>';
          unset($_SESSION['successDelete']);
        }

        if (isset($_SESSION['successAdd'])) {
          echo '<div class="d-flex justify-content-center w-50 m-auto alert alert-success" role="alert">' . $_SESSION['successAdd'] . '</div>';
          unset($_SESSION['successAdd']);
        }

        if (isset($_SESSION['successUpdate'])) {
          echo '<div class="d-flex justify-content-center w-50 m-auto alert alert-success" role="alert">' . $_SESSION['successUpdate'] . '</div>';
          unset($_SESSION['successUpdate']);
        }

        ?>
        <div class="section-heading">
          <h2>Latest Posts</h2>
          <!-- <a href="products.html">view all products <i class="fa fa-angle-right"></i></a> -->
        </div>
      </div>
      <?php foreach ($posts as $post) { ?>
        <div class="col-md-4">
          <div class="product-item">
            <a href="viewPost.php?id=<?= $post['id'] ?>"><img src="assets/images/postImage/<?= $post['image'] ?>" alt="" class="img-fluid"></a>
            <div class="down-content">
              <a href="viewPost.php?id=<?= $post['id'] ?>">
                <h4><?= $post['title'] ?></h4>
              </a>
              <h6><?= $post['created_at'] ?></h6>
              <p> <?= $post['body'] ?>.</p>
              <!-- <ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span>Reviews (24)</span> -->
              <div class="d-flex justify-content-end">
                <a href="viewPost.php?id=<?= $post['id'] ?>" class="btn btn-info "> view</a>
              </div>

            </div>
          </div>
        </div>
      <?php } ?>
      </div">
    </div>

    <nav class="d-flex justify-content-center" aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item <?php if($page == 1 || $numOfPages == 0){echo 'd-none';} ?>"><a class="page-link" href="index.php?page=<?= $page - 1 ?>">Previous</a></li>
        <?php for ($i = 1; $i <= $numOfPages; $i++) { ?>
          <li class="page-item"><a class="page-link" href="index.php?page=<?= $i ?>"><?= $i ?></a></li>
          <?php } ?>
          <li class="page-item <?php if($page == $numOfPages){echo 'd-none';} ?>"><a class="page-link" href="index.php?page=<?= $page + 1 ?>">Next</a></li>
      </ul>
    </nav>
  </div>



  <?php require_once 'inc/footer.php' ?>