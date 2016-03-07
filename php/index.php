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
            <a class="checkbox-toggler-8" href="#">Запю</a>
          </th>
          <th>
            <a class="checkbox-toggler-9" href="#">Пров.</a>
          </th>
          <th>
            Статус
          </th>
        </tr>

        <?php



        $sql = 'SELECT ID, folder_name, txt_name, login, password, date_add, date_checked, status, status_accept, status_reject FROM accounts';
        $result = mysql_query($sql, $link);

        if (!$result) {
          echo "Ошибка DB, запрос не удался\n";
          echo 'MySQL Error: ' . mysql_error();
          exit;
        }

        while ($row = mysql_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row['ID']; ?></td>
            <td>
              <?php echo $row['folder_name']; ?>
              <input type="text" name="foldername" class="hidden" value="<?php echo $row['folder_name']; ?>">
            </td>
            <td><?php echo $row['txt_name']; ?></td>
            <td>
              <?php echo $row['login']; ?>
              <input type="text" name="login" class="hidden" value="<?php echo $row['login']; ?>">
            </td>
            <td>
              <?php echo $row['password']; ?>
              <input type="text" name="password" class="hidden" value="<?php echo $row['password']; ?>">
            </td>
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

            <?php
              $status_accept = $row['status_accept'];
              $status_reject = $row['status_reject'];
              if ( $status_accept == '0' and $status_reject == '0' ) {
                $checkbox = 'checked';
                $adclass = ' class="enabled"';
              } else {
                $checkbox = '';
              }
            ?>
            <td<?php echo $adclass; ?>>
              <input type="checkbox" name="check-this" <?php echo $checkbox; ?>>
            </td>

            <?php
              $status = $row['status'];


              if ($status == '0') {
                $status_class = 'status-none';
                $status_title = 'Не проверялось';
              } else if ($status == '1') {
                $status_class = 'status-checked';
                $status_title = 'Проверялось';
              };

              if ($status_accept == '1') {
                $status_class = 'status-found';
                $status_title = 'Найдено';
              };

              if ($status_reject == '1')  {
                $status_class = 'status-reject';
                $status_title = 'Отказано';
              };
            ?>
            <td class="status <?php echo $status_class; ?>">
                <i title="<?php echo $status_title ?>" class="fa fa-info-circle"></i>
            </td>
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
