<?
include('connectdb.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $sql3 = "SELECT id_excur FROM zapisi WHERE id=$id";
    $res = $conn->query($sql3);
    $r = $res->fetch_array();
    $id_excur = $r['id_excur'];
    $sql5 = "SELECT id FROM zapisi WHERE id IN (SELECT zapisi.id
    FROM excursions 
    LEFT JOIN zapisi 
    ON zapisi.id_excur = excursions.id 
    LEFT JOIN route
    ON excursions.id_route=route.id
    WHERE DATEDIFF(route.start_date, NOW()) > 7)";
    $sql = "DELETE FROM zapisi WHERE id=$id AND $id IN (SELECT id FROM zapisi WHERE id IN (SELECT zapisi.id
    FROM excursions 
    LEFT JOIN zapisi 
    ON zapisi.id_excur = excursions.id 
    LEFT JOIN route
    ON excursions.id_route=route.id
    WHERE DATEDIFF(route.start_date, NOW()) > 7))";
    $res5 = $conn->query($sql5);
    $count = $res5->num_rows;
    if ($result = $conn->query($sql)) {
        if ($count > 0) {
            ?>
            <script>
                alert('Запись успешно отменена.');
            $.post('./php/personal.php', {
            id: <?echo $_SESSION['id']?>}, function (data) {
                $('main').html(data);   
            }
            )
        </script>
        <?
        } else {
            ?>
            <script>
            alert('Ошибка: запись можно удалить не менее чем за неделю до начала экскурсии!');
            $.post('./php/personal.php', {
            id: <?echo $_SESSION['id']?>}, function (data) {
                $('main').html(data);   
            }
            )
            </script>
            <?
        }
    }
    $sql2 = "UPDATE excursions 
    SET free_seats = 
    (SELECT seats FROM route WHERE id IN (SELECT id_route FROM excursions WHERE id=$id_excur))
    - 
    (SELECT COUNT(*) AS n FROM zapisi WHERE id_excur = $id_excur) 
    WHERE id=$id_excur";
    $conn->query($sql2);
}