<?php 
$dir="./assets/img/";
$img = scandir($dir);
unset($img[0], $img[1]);
$img = array_values($img);
?>
<h1>Galerie</h1>
<section id="galerie" class="row">
    <?php foreach($img as $photo): ?>
    <article class="col-12 col-sm-6 col-md-4 mb-3">
        <div class="card">
            <img src="<?php echo $dir.$photo ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo rtrim($photo, '.jpg'); ?></h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </article>
    <?php endforeach; ?>
</section>