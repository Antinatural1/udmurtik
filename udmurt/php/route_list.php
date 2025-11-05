<?
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT * FROM route";
    if ($result = $conn->query($sql)) {
        ?>
        <select id="route" name="id_route">
        <?
        while ($row = $result->fetch_array()) {
            ?>
            <option value="<?echo $row['id'];?>"><?echo $row['name']?></option>
            <?
        }
        ?>
        </select>
        <style>
            #route {
                border: none;
                outline: none;
                border-bottom: 3px black solid;
                font-size: 30px;
                padding: 2px;
                width: 100%;
                font-family: RobotoReg;
            }
        </style>
        <?
    }
}