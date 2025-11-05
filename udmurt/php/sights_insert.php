<?
session_start();
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['id'];
    $desc = $_POST['desc'];
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/sights-img/';
        $fileName = basename($_FILES['img']['name']);
        $destination_path = $uploadDir . $fileName;
        move_uploaded_file($_FILES['img']['tmp_name'], $destination_path);
    }
    $sql = "INSERT INTO sights (img, description, id_user, date) VALUES ('$fileName', '$desc', $id, NOW())";
    if ($result = $conn->query($sql)) {
        ?>
        <script>
            alert('Вы успешно опубликовали новую запись о достопримечательности!')
            $('main').load('./html/sights.html')
        </script>
        <?
    }
}