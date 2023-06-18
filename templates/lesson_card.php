<?php
if(empty($lesson->image)) {
  $lesson->image = "class_cover.jpg";
}

?>

<div class="card m-2" style="width: 18rem;border:none;">
  <a href="<?= $BASE_URL ?>video_lesson.php?id=<?= $lesson-> id ?>"><div class="card-image" style="background-image: url('<?= $BASE_URL ?>img/lessons/<?= $lesson-> image ?>')"></div></a>
  
  <div class="card-body">
  <a href="<?= $BASE_URL ?>video_lesson.php?id=<?= $lesson-> id ?>" style="text-decoration: none; color: #161616;"><h2 class="card-title" style="font-weight: bold; font-size:15px;"><?= $lesson-> title ?></h2>
  </div>
  <div class="mt-4 ps-3"><i class="fa-solid fa-star" style="color: #e59819;"></i><span>Avaliado com nota: <?= $lesson->rating ?></span></div>
</div>