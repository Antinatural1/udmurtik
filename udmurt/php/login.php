<?
include('connectdb.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$pass'";
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
            $('header').load('./php/auth_header.php');
            $('main').load('./html/udmurt.html');
        </script>
        <?
        $id = $row['id'];
        $_SESSION['id'] = $id;
    }
}