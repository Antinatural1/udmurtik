<?
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];
    $id_excur = $_POST['id_excur'];
    $sql = "INSERT INTO zapisi (id_users, id_excur, date) VALUES ($id_user, $id_excur, NOW())";
    $sql2 = "UPDATE excursions 
    SET free_seats = 
    (SELECT seats FROM route WHERE id IN (SELECT id_route FROM excursions WHERE id=$id_excur))
    - 
    (SELECT COUNT(*) AS n FROM zapisi WHERE id_excur = $id_excur) 
    WHERE id=$id_excur";
    if ($result = $conn->query($sql)) {
        $conn->query($sql2);
        ?>
        <script>
            alert('Вы успешно записались на экскурсию!')
            $('main').load('./html/excur.html')
        </script>
        <?
    }
}