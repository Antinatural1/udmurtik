<?
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM admin WHERE login='$email' AND password='$pass'";
    if ($result = $conn->query($sql)) {
        $row = $result->fetch_array();
        $count = $result->num_rows;
        if ($count == 0) {
            ?>
            <script>
                alert('Ошибка: неверный email или пароль!');
                </script>
            <?
            die();
        }
        ?>
        <script>
            $('header').load('./php/admin_auth_header.php');
            $('main').load('./html/udmurt.html');
        </script>
        <?
    }
}