<?
include('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id_route = $_POST['id_route'];
    $s = $_POST['seats'];
    $sql = "SELECT excursions.*, route.id AS id_route, route.name, route.start_point, route.start_date, route.days,
    route.seats, route.age, route.price
    FROM route
    LEFT JOIN excursions
    ON excursions.id_route = route.id
    WHERE excursions.id = $id";
    $sql2 = "SELECT *
    FROM points 
    WHERE id_route = $id_route";
    if ($result = $conn->query($sql)) {
        $row = $result->fetch_array();
?>
<form class="login-block" id="login-form" enctype="multipart/form-data">
    <p class="title">Изменение экскурсии</p>
    <div class="login-fields" style="grid-template-columns: 1fr 3fr;">
        <input type="hidden" name="id_excur" value="<?echo $id?>">
        <input type="hidden" name="id_route" value="<?echo $id?>">
        <p class="login-text">Название:</p>
        <input type="text" name="name" value='<?echo $row['name']?>' required>
        <p class="login-text">Место старта:</p>
        <input type="text" name="start_point" value="<?echo $row['start_point']?>" required>
        <p class="login-text">Дата начала:</p>
        <input type="date" name="start_date" value="<?echo $row['start_date']?>" required>
        <p class="login-text">Время начала:</p>
        <input type="time" name="start_time" value="<?echo $row['start_time']?>" required>
        <p class="login-text">Количество мест:</p>
        <input type="number" min="<?echo $row['seats'] - $row['free_seats']?>" name="seats" value="<?echo $row['seats']?>" required>
        <p class="login-text">Количество дней:</p>
        <input type="number" name="days" value="<?echo $row['days']?>" required>
        <p class="login-text">Возрастное ограничение:</p>
        <input type="text" maxlength="10" name="age" value="<?echo $row['age']?>" required>
        <p class="login-text">Цена:</p>
        <input type="number" name="price" value="<?echo $row['price']?>" required>
    </div>
    <?
    if ($result2 = $conn->query($sql2)) {
        ?>
        <p class="title">Изменение точек</p>
        <?
        $i = 0;
        while ($row2 = $result2->fetch_array()){
            ?>
            <input type="hidden" value="<?echo $row2['id']?>" name="items[<?echo $i;?>][id]">
            <input type="hidden" value="<?echo $row2['img_point']?>" name="items[<?echo $i;?>][img]">
            <input type="file" accept=".jpg, .png" style="opacity: 0; user-select: none"
            class="sight-img sight-img<?echo $row2['id']?>" id="sights-inp<?echo $row2['id']?>" name="items[<?echo $i;?>][img]">
            <div class="sights-block-input" style="margin: 0;">
                <label for="sights-inp<?echo $row2['id']?>" style="background-image: url(./php/zapis-img/<?echo str_replace(' ', '\\ ', $row2['img_point'])?>);" class="sights-input sights-input<?echo $row2['id']?>"></label>
                <textarea name="items[<?echo $i;?>][desc]" class="sights-desc-input" placeholder="Описание..." required><?echo $row2['desc_point']?></textarea>
            </div>
            <script>
                $('.sight-img<?echo $row2['id']?>').on('change', function() {
                    const file = this.files[0];
                    if (file) {
                      const reader = new FileReader();
                    
                      reader.onload = function(e) {
                        $('.sights-input<?echo $row2['id']?>').css(
                            'background-image', 'url(' + e.target.result + ')',
                        )
                        $('.sights-input<?echo $row2['id']?>').html('');
                      };
                      reader.readAsDataURL(file);
                    } 
                    else {
                        $('.sights-input<?echo $row2['id']?>').html('Загрузить фото')
                        $('.sights-input<?echo $row2['id']?>').css('background-image', 'none')
                    }
                })
                $('#sights-reset').click(function() {
                    $('.sights-input<?echo $row2['id']?>').html('Загрузить фото')
                    $('.sights-input<?echo $row2['id']?>').css('background-image', 'none')
                })
            </script>
            <?
            $i += 1;
        }
        ?>
    <div style="display: flex; gap: 50px; justify-content: center;">
        <input type="submit" class="submit2 login-btn" id="add-excur">
        <input type="reset" class="submit1">
    </div>
</form>
<button class="submit1" onclick="$('main').load('./html/admin_excur.html'); $('main').load('./html/admin_excur.html'); $('main').load('./html/admin_excur.html');">Назад</button>
<div id="result-form"></div>
<script>
    $('#login-form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: './php/admin_excur_editing.php',   
            type: 'POST',
            data: formData,
            processData: false, 
            contentType: false, 
            success: function(response) {
                $('#result-form').html(response)
                alert('Вы успешно изменили данные об экскурсии!')
                $('main').load('./html/admin_excur.html');
                $('main').load('./html/admin_excur.html');
                $('main').load('./html/admin_excur.html');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Ошибка:', textStatus, errorThrown);
            }
        })
    })
</script>
<?
        }
    }
}