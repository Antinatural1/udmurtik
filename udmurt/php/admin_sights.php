<?
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT sights.id, sights.img, sights.description, sights.date, users.last_name, users.name, users.patronymic 
    FROM sights LEFT JOIN users ON users.id = sights.id_user";
    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_array()){
            $date = explode('-', $row['date']);
            ?>
        <div class="sights-card">
        <div style="background-image: url('./php/sights-img/<?echo $row['img']; ?>')" class="sights-img"></div>
        <p class="sights-desc"><?echo $row['description'];?></p>
        <div class="sights-card-info">
            <p class="sights-user">Пользователь: <?echo $row['name'] . ' ' . mb_substr($row['last_name'], 0, 1, 'UTF-8') . '. ' . mb_substr($row['patronymic'], 0, 1, 'UTF-8') . '.'?></p>
            <p class="sights-date"><? echo $date[2] . '.' . $date[1] . '.' . $date[0]; ?></p>
        </div>
        </div>
            <?
        };
    }
}