<?
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT * FROM info";
    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_array()){
            ?>
<div class="main-block">
    <div>
        <p class="title2"><?echo $row['title']?></p>
        <p class="main-block-text"><?echo $row['description']?></p>
    </div>
    <img src="./img/<?echo $row['img']?>" class="main-block-img">
</div>
<?
        }
    }
}