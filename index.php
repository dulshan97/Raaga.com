<?php
require_once './classes/database.php';

$dbCon = dbConnect();
$allMusicianSql = 'select * from musicians';
$musicianList = $dbCon->query($allMusicianSql);
$avatar = "/public/images/default-avatar.png";

$css = ['home-page.css'];
include './src/layout/header.php';
?>

<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner carousel-bg">
    <div class="carousel-item carousel-img active">
      <img src="./public/images/slide-2.jpg" class=" d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./public/images/slide-3.jpeg" class="carousel-img d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./public/images/slide-4.jpeg" class="carousel-img d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Fourth slide label</h5>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container">
    <div class="row">
        <h3>Band List </h3>
    </div>
    <div class='row'>
        <div class="row row-cols-1 row-cols-md-4">
            <?php while($band = $musicianList->fetch_assoc()) { ?>
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="<?php echo $band['avatar'] ? $band['avatar'] : $avatar; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $band['name']; ?></h5>
                        <p class="card-text"><?php //echo $band['']; ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="/src/musician/profile.php?id=<?php echo $band['id']; ?>" type="button" class="btn btn-primary btn-lg btn-block">
                            Visit Profile
                        </a>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>

    </div>
</div>
        
    </div>
</div>



<?php
include './src/layout/footer.php';
?>