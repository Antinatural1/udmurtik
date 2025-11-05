<?
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $last_name = $_POST['last_name'];
    $name = $_POST['first_name'];
    $patronymic = $_POST['patronymic'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];
    $birth_date = $_POST['birth_date'];
    if ($pass != $pass2) {
        ?>
        <script>
            alert('Ошибка: пароли не совпадают!');
        </script>
        <?
        die();
    }
    $sql = "SELECT * FROM users WHERE email='$email'";
    if ($result = $conn->query($sql)) {
        $count = $result->num_rows;
        if ($count > 0) {
            ?>
            <script>
                alert('Ошибка: пользователь с такими данными уже существует!')
            </script>
            <?
            die();
        }
    }
    $sql2 = "INSERT INTO users (last_name, name, patronymic, email, password, birth_date) 
    VALUES ('$last_name', '$name', '$patronymic', '$email', '$pass', '$birth_date')";
    if ($result = $conn->query($sql2)) {
        ?>
        <script>
            alert('Вы успешно зарегистрировались!')
            $('main').load('./html/login.html')
        </script>
        <?
        die();
    } else {
        ?>
        <script>
            alert('Произошла ошибка на серверной части. Попробуйте позже.');
        </script>
        <?
    }
}