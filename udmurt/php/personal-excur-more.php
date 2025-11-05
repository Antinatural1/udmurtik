<?
session_start();
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_SESSION['id'];
    $id = $_POST['id'];
    $id_route = $_POST['id_route'];
    $sql5 = "SELECT id_excur FROM zapisi WHERE id=$id";
    $res5 = $conn->query($sql5);
    $row5 = $res5->fetch_array();
    $id_excur = $row5['id_excur'];
    $sql = "SELECT excursions.id, excursions.start_time, excursions.free_seats,
    route.name, route.start_point, route.start_date, route.days, 
    route.seats, route.age, route.price,
    points.img_point, points.desc_point
    FROM excursions
    LEFT JOIN route
    INNER JOIN points
    ON route.id=points.id_route
    ON route.id=excursions.id_route
    WHERE excursions.id = $id_excur";
    $sql2 = "SELECT points.* 
    FROM points
    LEFT JOIN route
    ON route.id=points.id_route
    WHERE points.id_route = $id_route";
    if ($result = $conn->query($sql)) {
        $row = $result->fetch_array();
        $date = explode('-', $row['start_date']);
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
            <p></p>
            <button class="submit1" onclick="$.post('./php/personal.php', {
            id: <?echo $_SESSION['id']?>}, function (data) {
                $('main').html(data);   
            }
        )">Назад</button>
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
