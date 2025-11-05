<?
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_route = $_POST['id_route'];
    $time = $_POST['time']; 
    $sql = "INSERT INTO excursions (id_route, start_time, free_seats) 
    VALUES ($id_route, '$time', (SELECT seats FROM route WHERE id=$id_route))";
    if ($result = $conn->query($sql)) {
            ?>
            <script>
                alert('Вы успешно добавили новую экскурсию!');
            </script>
            <?
        }
        ?>
        <script>
            $('main').load('./html/admin_add_excur.html');
        </script>
        <?
    }