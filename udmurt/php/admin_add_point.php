<?
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_route = $_POST['id_route'];
    $desc = $_POST['desc'];
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/zapis-img/';
        $fileName = basename($_FILES['img']['name']);
        $destination_path = $uploadDir . $fileName;
        move_uploaded_file($_FILES['img']['tmp_name'], $destination_path);
    }
    $sql = "INSERT INTO points (id_route, desc_point, img_point) VALUES ($id_route, '$desc', '$fileName')";
    if ($conn->query($sql)) {
    }
}