<?
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $sql = "UPDATE excursions SET status='archieved' WHERE id=$id";
    if ($result = $conn->query($sql)) {
        ?>
        <script>
            alert('Вы успешно поместили экскурсию в архив!')
            $('main').load('./html/admin_excur.html');
        </script>
        <?
    }
}