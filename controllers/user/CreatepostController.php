<?php
if(!isLogedIn()){

    header('location: /login');
    exit();
}
$user = $db->getUser($_SESSION['user_id']);
$categories = $db->getAllCategories();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors_array = [];
    $visibility = $_POST["visibility"];
    if($_POST['title'] ?? false){
        $title = $_POST['title'];
    }else{
        $errors_array['title_err'] = "Please enter your title";
    }

    if($_POST['body'] ?? false){
        $body = $_POST['body'];
    }else{
        $errors_array['body_err'] = "Please enter your description";
    }
    if(count($errors_array) > 0){
        dd("greska");
    }
    $target_dir = "uploads/";

// Osiguraj da folder postoji
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Generiši jedinstveno ime za sliku koristeći uniqid() i ekstenziju originalne slike
$image_file_type = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
$unique_name = uniqid() . "." . $image_file_type;
$target_file = $target_dir . $unique_name;

// Promenljive za proveru grešaka
$upload_ok = 1;
$error_message = "";

// Proveri da li je fajl slika
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        echo "Fajl je slika - " . $check["mime"] . ".";
        $upload_ok = 1;
    } else {
        $error_message = "Fajl nije slika.";
        $upload_ok = 0;
    }
}

// Ograniči tipove fajlova
if ($image_file_type != "jpg" && $image_file_type != "jpeg" && $image_file_type != "png" && $image_file_type != "gif") {
    $error_message = "Dozvoljeni su samo JPG, JPEG, PNG i GIF fajlovi.";
    $upload_ok = 0;
}

// Proveri veličinu fajla
if ($_FILES["image"]["size"] > 500000) { // 500 KB maksimalna veličina
    $error_message = "Žao nam je, fajl je prevelik.";
    $upload_ok = 0;
}

// Proveri da li je upload validan
if ($upload_ok == 0) {
    echo "Žao nam je, vaša slika nije uploadovana. " . $error_message;
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $post = $po->createPost($user->id,$target_file, $title, $body, $_POST['category'],$visibility);
        if($post){
            header('location: /dashboard');
            exit();
        }else{
            dd("nije sacuvan");
        }
    } else {
        echo "Žao nam je, došlo je do greške pri uploadu.";
    }
}

}else{
    view("create.post", ["user" => $user, "categories" => $categories]);
}

