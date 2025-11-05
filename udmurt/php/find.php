<?
session_start();
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_us = $_SESSION['id'];
    $field = '%' . $_POST['field'] . '%';
    $sql = "SELECT excursions.id, excursions.start_time, excursions.free_seats, route.id AS id_route,
    route.name, route.start_point, route.start_date, route.days, route.seats, route.age, route.price
    FROM excursions
    LEFT JOIN route 
    ON route.id=excursions.id_route
    WHERE route.start_date > NOW() AND excursions.status != 'archieved' AND excursions.id NOT IN (SELECT id_excur FROM zapisi WHERE id_users=$id_us) AND
    (route.name LIKE '$field' OR route.start_point LIKE '$field')
    ";
    if ($result = $conn->query($sql)) {
        $count = $result->num_rows;
        if ($count == 0) {
            ?>
            <script>
                alert('Ничего не найдено((((((((((((((((')
                $('main').load('./html/excur.html')
            </script>
            <?
            die();
        }
        while ($row = $result->fetch_array()){
            $date = explode('-', $row['start_date']);
            $perc = $row['free_seats'] / $row['seats'];
            if (1 - $perc < 0.31 ) {
                $price = $row['price'] * 0.75;
            } else if (1 - $perc >= 0.31 && 1- $perc < 0.5) {
                $price = $row['price'] * 0.9;
            } else {
                $price = $row['price'];
            }
            ?>
<div class="excur-block">
    <div>
        <p class="excur-title"><?echo $row['name'];?></p>
        <p class="excur-text">Место старта: <?echo $row['start_point'];?></p>
        <p class="excur-text">Время начала: <?echo substr($row['start_time'], 0, 5);?></p>
        <p class="excur-text">Дата начала: <?echo $date[2] . '.' . $date[1] . '.' . $date[0]?></p>
        <p class="excur-text">Количество дней: <?echo $row['days']?></p>
        <p class="excur-text">Цена: <?echo $price?>₽</p>
        <p class="excur-text">Занято мест в группе: <?echo $row['seats']-$row['free_seats'] . '/' . $row['seats']?></p>
    </div>
    <div style="display: flex; flex-direction: column; justify-content: space-around;">
        <div style="display: flex; flex-direction: column; align-items: flex-end;">
            <button class="excur-btn1" 
            onclick="$.post('./php/excur_find_appoint.php', {id: <?echo $row['id'];?>, id_route: <?echo $row['id_route']?>}, function (data) {$('main').html(data);})">Записаться</button>
        </div>
    </div>
</div>
            <?
        };
    }
}