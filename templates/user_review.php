<?php

require_once("models/User.php");

$userModel = new User();

$fullName = $userModel->getFullName($review->user);

if($review->user->image == "") {
    $review->user->image = "user.jpg";
  }
  
?>

<div class="row review-container mt-3 mb-3">
<div class="col-lg-12">
  <div class="row">
    <div class="col-lg-1 pt-3">
    <a href="<?= $BASE_URL ?>profile.php?id=<?= $review->user->id ?>"><div id="review-profile" style="background-image: url('<?= $BASE_URL ?>/img/users/<?= $review->user->image?>');"></div></a>
    </div>
    <div class="col-lg-11 mt-4">
    <h5><?= $fullName?></h5>
    <h6 style="font-size: 12px;"><i class="fa-solid fa-graduation-cap"></i>  Aluno(a)</h6>
    </div>
  </div>
</div>
<div class="col mt-3 pt-3 ps-2 comment-container">
  <p><?=$review->review ?></p>
</div>
</div>