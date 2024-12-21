<?php
class Posts{
    private $pdo;
    public function __construct($pdo){
        $this->pdo = $pdo;

    }

    public function createPost($id,  $target_file,  $title,  $body,  $category,  $visibility)
    {
        $stmt = $this->pdo->prepare("INSERT INTO posts (user_id, img_path, title, body, category_id, visibility) VALUES (? , ? , ?, ?, ?, ?)");
        $stmt->execute([$id,  $target_file,  $title,  $body,  $category,  $visibility]);
        return $stmt->rowCount();
    }

    public function getUserPosts($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE user_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getAllPosts()
    {
        $stmt = $this->pdo->prepare("SELECT posts.*, users.first_name, users.email 
FROM posts
JOIN users ON posts.user_id = users.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


}
