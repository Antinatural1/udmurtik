<?
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $point = $_POST['point']; 
    $date = $_POST['date'];
    $days = $_POST['days'];
    $age = $_POST['age'];
    $price = $_POST['price'];
    $seats = $_POST['seats'];
    $sql = "INSERT INTO route (name, start_point, start_date, days, seats, age, price) 
    VALUES ('$name', '$point', '$date', $days, $seats, '$age', $price)";
    if ($result = $conn->query($sql)) {
            ?>
            <script>
                alert('Вы успешно добавили новый маршрут!');
            </script>
            <?
        }
        ?>
        <script>
            $('main').load('./html/admin_add_route.html');
        </script>
        <?
    }