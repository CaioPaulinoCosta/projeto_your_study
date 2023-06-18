<?php 

    class lesson {

        public $id;
        public $title;
        public $description;
        public $content;
        public $image;
        public $video;
        public $category;
        public $users_id;
        public $reviews_id;

        public function imageGenerateName() {
            return bin2hex(random_bytes(60)) . "jpg";
        }
    }

    interface LessonDAOInterface {

        public function buildLesson($data);
        public function findAll();
        public function getLatestLessons();
        public function getlessonsByCategory($category);
        public function getLessonsByUserId($id);
        public function findById($id);
        public function findByTitle($title);
        public function create(lesson $lesson);
        public function update(lesson $lesson);
        public function destroy($id);
    }