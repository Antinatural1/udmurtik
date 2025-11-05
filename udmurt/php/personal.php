<?
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM users WHERE id='$id'";
    if ($result = $conn->query($sql)) {
        $row = $result->fetch_array();
        $count = $result->num_rows;
        $date = explode('-', $row['birth_date']);
        if ($count == 0) {
            ?>
            <script>
                alert('Ошибка: неверный email или пароль!');
            </script>
            <?
            die();
        }
        ?>
        <div class="personal">
            <p class="title">Личный кабинет</p>
            <div class="personal-data">
                <p class="personal-textb">ФИО:</p><p class="personal-text">
                    <?echo $row['last_name'] . ' ' . $row['name'] . ' ' . $row['patronymic']?>
                </p>
            </div>
            <div class="personal-data">
                <p class="personal-textb">Email:</p><p class="personal-text">
                    <?echo $row['email']?>
                </p>
            </div>
            <div class="personal-data">
                <p class="personal-textb">Дата рождения:</p><p class="personal-text">
                    <?echo $date[2] . '.' . $date[1] . '.' . $date[0]?>
                </p>
            </div>
            <button class="submit2 logout">Выйти</button>
        </div>

        <?
        $sql2 = "SELECT points.img_point, route.name, route.start_date, excursions.start_time, zapisi.date, zapisi.id, route.id AS id_route
        FROM zapisi
        LEFT JOIN users ON zapisi.id_users = users.id
        LEFT JOIN excursions ON zapisi.id_excur = excursions.id
        LEFT JOIN route ON excursions.id_route = route.id
        LEFT JOIN points ON points.id = (
            SELECT MIN(p2.id)
            FROM points p2
            WHERE p2.id_route = route.id
        )
        WHERE users.id = $id AND route.start_date >= NOW() AND excursions.status != 'archieved'";
        $result = $conn->query($sql2);
        if ($result->num_rows > 0) {
            ?>
            <p class="title">Мои записи</p>
            <div class="my-zapisi">
            <?
            while($row2 = $result->fetch_array()){
                $date = explode('-', $row2['start_date']);
                $date2 = explode('-', $row2['date']);
        ?>
            <div class="my-zapis">
                <div class="my-zapis-img" style="background-image: url('./php/zapis-img/<?echo $row2['img_point'];?>');"></div>
                <p class="my-zapis-title"><?echo $row2['name']?></p>
                <p class="my-zapis-text">Дата и время начала: <?echo $date[2] . '.' . $date[1] . '.' . $date[0] . ', ' . substr($row2['start_time'], 0, 5)?></p>
                <p class="my-zapis-text">Дата записи: <?echo $date2[2] . '.' . $date2[1] . '.' . $date2[0]?></p>
                <div class="my-zapis-btns">
                    <div class="submit1" onclick="$.post('./php/personal-excur-more.php', {id: <?echo $row2['id']?>, id_route: <?echo $row2['id_route']?>}, function (data) {$('main').html(data);})">Подробнее...</div>
                    <div class="submit2" id="cancel"
                    onclick="if (confirm('Вы уверены, что хотите отменить запись?')) {$.post('./php/zapis-cancel.php', {id: <?echo $row2['id']?>}, function(data) {$('main').html(data)})}">Отменить запись</div>
                </div>
            </div>
            <?
            }
        }
        ?>
        </div>

        <?
        $sql3 = "SELECT points.img_point, route.name, route.start_date, excursions.start_time, zapisi.date
        FROM zapisi
        LEFT JOIN users ON zapisi.id_users = users.id
        LEFT JOIN excursions ON zapisi.id_excur = excursions.id
        LEFT JOIN route ON excursions.id_route = route.id
        LEFT JOIN points ON points.id = (
            SELECT MIN(p2.id)
            FROM points p2
            WHERE p2.id_route = route.id
        )
        WHERE users.id = $id AND (route.start_date < NOW() OR excursions.status = 'archieved')";
        $result = $conn->query($sql3);
        if ($result->num_rows > 0) {
            ?>
            <p class="title">Мои архивные записи</p>
            <div class="my-zapisi">
            <?
            while($row3 = $result->fetch_array()){
                $date = explode('-', $row3['start_date']);
                $date2 = explode('-', $row3['date']);
        ?>
            <div class="my-zapis">
                <div class="my-zapis-img" style="background-image: url('./php/zapis-img/<?echo $row3['img_point'];?>');"></div>
                <p class="my-zapis-title"><?echo $row3['name']?></p>
                <p class="my-zapis-text">Дата и время начала: <?echo $date[2] . '.' . $date[1] . '.' . $date[0] . ', ' . substr($row3['start_time'], 0, 5)?></p>
                <p class="my-zapis-text">Дата записи: <?echo $date2[2] . '.' . $date2[1] . '.' . $date2[0]?></p>
            </div>
            <?
            }
        }
        ?>
        </div>
        <script>
        $('.logout').click(function() {
            $('main').load('./html/login.html');
            $('header').load('./html/noauth_header.html')
         })
        </script>
        <?
    }
}