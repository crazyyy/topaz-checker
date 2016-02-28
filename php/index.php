<?php include 'template/header.php';?>

  <article class="main-block">

    <form action="" class="main-form">
      <table>
        <tr>
          <th>
            ID
          </th>
          <th>
            Название папки
          </th>
          <th>
            и файла
          </th>
          <th>
            Логин
          </th>
          <th>
            Пароль
          </th>
          <th>
            Добавленно
          </th>
          <th>
            Проверенно
          </th>
          <th>
            Записать
          </th>
          <th>
            Статус
          </th>
        </tr>

        <?php



        $sql = 'SELECT ID, folder_name, txt_name, login, password, date_add, date_checked, status FROM accounts';
        $result = mysql_query($sql, $link);

        if (!$result) {
          echo "Ошибка DB, запрос не удался\n";
          echo 'MySQL Error: ' . mysql_error();
          exit;
        }

        while ($row = mysql_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['folder_name']; ?></td>
            <td><?php echo $row['txt_name']; ?></td>
            <td><?php echo $row['login']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['date_add']; ?></td>
            <td><?php echo $row['date_checked']; ?></td>
            <td>

              <?php
                if(strlen(trim($row['login'])) == 0){
                  $checked = 'checked';
                } else {
                  $checked = '';
                }
              ?>
              <input type="checkbox" name="fiilformed" <?php echo $checked; ?> value="<?php echo $row['folder_name']; ?>@<?php echo $row['txt_name']; ?>">


            </td>
            <td><?php echo $row['status']; ?></td>

          </tr>
        <? } ?>

      </table>
      <button class="fill-the-form">Заполнить выбранные строчки</button>
      <button class="check-the-from">Проверить форму</button>
    </form><!-- /.main-form -->
















        <div class="result-checker">

        </div><!-- /.result-checker -->


      </article>

<?php include 'template/footer.php';?>
