<?
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $start_point = $_POST['start_point'];
    $start_date = $_POST['start_date'];
    $start_time = $_POST['start_time'];
    $seats = $_POST['seats'];
    $days = $_POST['days'];
    $age = $_POST['age'];
    $price = $_POST['price'];
    $id_excur = $_POST['id_excur'];
    $id_route = $_POST['id_route'];
    if (isset($_POST['items']) && is_array($_POST['items'])) {
        foreach ($_POST['items'] as $key => $item) {
            if (isset($item['id']) && isset($item['desc'])) {
                $id = (int)$item['id'];
                $desc = $item['desc'];
                if (isset($_FILES['items']['name'][$key]['img']) && $_FILES['items']['name'][$key]['img'] != "") {
                    $img = $_FILES['items']['name'][$key]['img'];
                    $desc = $item['desc'];
                    $uploadDir = __DIR__ . '/zapis-img/';
                    $fileName = basename($_FILES['items']['name'][$key]['img']);
                    $destination_path = $uploadDir . $fileName;
                    if (move_uploaded_file($_FILES['items']['tmp_name'][$key]['img'], $destination_path)) {
                        $imgPath = $destination_path;
                    } else {
                        $imgPath = null;
                    }
                    $sql = "UPDATE route
                    LEFT JOIN points ON route.id = points.id_route
                    LEFT JOIN excursions ON excursions.id_route = route.id
                    SET 
                        route.name = '$name',
                        route.start_point = '$start_point',
                        route.start_date = '$start_date',
                        route.seats = $seats,
                        route.days = $days,
                        route.age = '$age',
                        route.price = $price,
                        excursions.start_time = '$start_time',
                        excursions.free_seats = route.seats - (SELECT COUNT(*) FROM zapisi WHERE id_excur = $id_route),
                        points.img_point = '$img',
                        points.desc_point = '$desc'
                    WHERE excursions.id = $id_excur AND points.id = $id"; 
                } else {
                    $imgPath = null;
                    $sql = "UPDATE route
                    LEFT JOIN points ON route.id = points.id_route
                    LEFT JOIN excursions ON excursions.id_route = route.id
                    SET 
                        route.name = '$name',
                        route.start_point = '$start_point',
                        route.start_date = '$start_date',
                        route.seats = $seats,
                        route.days = $days,
                        route.age = '$age',
                        route.price = $price,
                        excursions.start_time = '$start_time',
                        excursions.free_seats = route.seats - (SELECT COUNT(*) FROM zapisi WHERE id_excur = $id_route),
                        points.desc_point = '$desc'
                    WHERE excursions.id = $id_excur AND points.id = $id"; 
                }
                $conn->query($sql);
            
            }
        }
    }
    // $sql2 = "UPDATE excursions 
    //         SET free_seats = (SELECT seats FROM route LEFT JOIN excursions ON route.id = excursions.id_route WHERE excursions.id = $id_excur) - (SELECT COUNT(*) FROM zapisi WHERE id_excur = $id_excur)
    //         WHERE id = $id_excur";
    // $conn->query($sql2);
}
?>