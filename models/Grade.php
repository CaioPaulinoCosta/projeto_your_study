<?php 

    class Grade {

        public $id;
        public $p1;
        public $p2;
        public $p3;
        public $p4;
        public $t1;
        public $t2;
        public $average;
        public $users_id;
    }

    interface GradeDAOInterface {

        public function buildGrade($data);
        public function findAll();
        public function getGradesByUserId($id);
        public function findById($id);
        public function create(Grade $grade);
        public function update(Grade $grade);
        public function destroy($id);
    }