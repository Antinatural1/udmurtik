<?
session_start();
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_SESSION['id'];
    $id = $_POST['id'];
    $id_route = $_POST['id_route'];
    $sql = "SELECT excursions.id, excursions.start_time, excursions.free_seats,
    route.name, route.start_point, route.start_date, route.days, 
    route.seats, route.age, route.price,
    points.img_point, points.desc_point
    FROM excursions
    LEFT JOIN route
    INNER JOIN points
    ON route.id=points.id_route
    ON route.id=excursions.id_route
    WHERE excursions.id = $id";
    $sql2 = "SELECT points.* 
    FROM points
    LEFT JOIN route
    ON route.id=points.id_route
    WHERE points.id_route = $id_route";
    if ($result = $conn->query($sql)) {
        $row = $result->fetch_array();
        $date = explode('-', $row['start_date']);
        $perc = $row['free_seats'] / $row['seats'];
            if (1 - $perc < 0.31 ) {
                $price = $row['price'] * 0.75;
            } else if (1 - $perc >= 0.31 && 1 - $perc < 0.5) {
                $price = $row['price'] * 0.9;
            } else {
                $price = $row['price'];
            }
            ?>
        <p class="title">Запись на экскурсию “<?echo $row['name']?>”</p>
        <div class="zapis-info-block">
        <?
        if ($result2 = $conn->query($sql2)) {
            while ($row2 = $result2->fetch_array()) {
                ?>
                <img src='./php/zapis-img/<?echo $row2['img_point']?>' style="width: 80%;">
                <p class="zapis-info"><?echo $row2['desc_point']?></p>
                <?
            }
        }
        ?>
            <p class="zapis-info">Место старта: <?echo $row['start_point'];?></p>
            <p class="zapis-info">Количество мест всего: <?echo $row['seats']?></p>
            <p class="zapis-info">Дата начала: <?echo $date[2] . '.' . $date[1] . '.' . $date[0]?></p>
            <p class="zapis-info">Время начала: <?echo substr($row['start_time'], 0, 5);?></p>
            <p class="zapis-info">Занято мест в группе: <?echo $row['seats']-$row['free_seats'] . '/' . $row['seats']?></p>
            <p class="zapis-info">Цена: <?echo $price?>₽</p>
            <?
            if (1 - $perc == 1) {
            ?>
            <button disabled style="background-color: #ff4b42; cursor: not-allowed" class="submit2" onclick="zapis()">Записаться</button>
            <?
        } else {
            ?>
            <button class="submit2" onclick="zapis()">Записаться</button>
            <?
        }
        ?>
            <button class="submit1" onclick="$('main').load('./html/excur.html');">К списку экскурсий</button>
        </div>
            <?
    }
}
?>
<script>
    function zapis() {
        $.post('./php/excur_zapis_add.php', {
            id_user: <? echo $id_user?>, 
            id_excur: <? echo $id?>
        }, function(data) {$('main').html(data)})
        return false
    }
</script>
