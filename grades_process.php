<?php 

require_once("globals.php");
require_once("db.php");
require_once("models/Grade.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/GradeDAO.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$gradeDao = new GradeDAO($conn, $BASE_URL);

// Pega o tipo do formulario
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuario
$userData = $userDao->verifyToken();

if($type === "average") {

    // Recebe dados do input
    $p1 = filter_input(INPUT_POST, "p1");
    $p2 = filter_input(INPUT_POST, "p2");
    $p3 = filter_input(INPUT_POST, "p3");
    $p4 = filter_input(INPUT_POST, "p4");
    $t1 = filter_input(INPUT_POST, "t1");
    $t2 = filter_input(INPUT_POST, "t2");
    $users_id = filter_input(INPUT_POST, "user_id");

    $intP1 = intval($p1);
    $intP2 = intval($p2);
    $intP3 = intval($p3);
    $intP4 = intval($p4);
    $intT1 = intval($t1);
    $intT2 = intval($t2);
    
    $p1Weight = $intP1 * 7;
    $p2Weight = $intP2 * 7;
    $p3Weight = $intP3 * 7;
    $p4Weight = $intP4 * 7;
    $t1Weight = $intT1 * 3;
    $t2Weight = $intT2 * 3;
    
    $sumHomeWorks = $t1Weight + $t2Weight;
    $sumTests = $p1Weight + $p2Weight + $p3Weight + $p4Weight;
    $sumTotal = $sumHomeWorks + $sumTests;
    
    $totalWeight = (3 * 2) + (7 * 4);
    $weightedAverage = $sumTotal / $totalWeight;
    $average = number_format($weightedAverage, 2);

    $grade = new Grade();

    $grade->p1 = $p1;
    $grade->p2 = $p2;
    $grade->p3 = $p3;
    $grade->p4 = $p4;
    $grade->t1 = $t1;
    $grade->t2 = $t2;
    $grade->average = $average;
    $grade->users_id = $users_id;

    $gradeDao->create($grade);


} else if ($type === "update") {

    
    $p1 = filter_input(INPUT_POST, "p1");
    $p2 = filter_input(INPUT_POST, "p2");
    $p3 = filter_input(INPUT_POST, "p3");
    $p4 = filter_input(INPUT_POST, "p4");
    $t1 = filter_input(INPUT_POST, "t1");
    $t2 = filter_input(INPUT_POST, "t2");
    $users_id = filter_input(INPUT_POST, "user_id");
    $id = filter_input(INPUT_POST, "id"); 

    $gradeData = $gradeDao->findById($id);


if($gradeData) { 

    $intP1 = intval($p1);
    $intP2 = intval($p2);
    $intP3 = intval($p3);
    $intP4 = intval($p4);
    $intT1 = intval($t1);
    $intT2 = intval($t2);
    
    $p1Weight = $intP1 * 7;
    $p2Weight = $intP2 * 7;
    $p3Weight = $intP3 * 7;
    $p4Weight = $intP4 * 7;
    $t1Weight = $intT1 * 3;
    $t2Weight = $intT2 * 3;
    
    $sumHomeWorks = $t1Weight + $t2Weight;
    $sumTests = $p1Weight + $p2Weight + $p3Weight + $p4Weight;
    $sumTotal = $sumHomeWorks + $sumTests;
    
    $totalWeight = (3 * 2) + (7 * 4);
    $weightedAverage = $sumTotal / $totalWeight;
    $average = number_format($weightedAverage, 2);

    $gradeData->p1 = $p1;
    $gradeData->p2 = $p2;
    $gradeData->p3 = $p3;
    $gradeData->p4 = $p4;
    $gradeData->t1 = $t1;
    $gradeData->t2 = $t2;
    $gradeData->average = $average;

    $gradeDao->update($gradeData);

}

}