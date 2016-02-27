<?php include 'template/header.php';?>

      <article class="main-block block-add">

        <p>Эта страничка позволяет проверить папку uploads на новое содержимое, добавить новые папки (если есть), проверить старые на новое содержимое. Ну и выводит статус всех добавленных папок в сервис</p>

        <?php
          $path = 'uploads';

          $dirs = array();
          $files = array();

          // directory handle
          $dir = dir($path);

          while (false !== ($entry = $dir->read())) {
            if ($entry != '.' && $entry != '..') {
               if (is_dir($path . '/' .$entry)) {
                  $dirs[] = $entry;
               } else {
                  $files[] = $entry;
               }
            }
          }

          $folders_new = array();
          $folders_old = array();

          foreach ($dirs as $directory) {

            $sql = 'SELECT ID FROM uploads WHERE directory_name = "'.$directory.'"';
            // check MySQL query
            $result = mysql_query($sql, $link);

            if ( $result == true ) {
              // mysql connect ok
              // echo '<br>T R U E <br>';
            } else {
              echo '<br>MySQL connections problem<br>';
            }

            $num_rows = mysql_num_rows($result);

            // check if folder in uploads dir added to DB or not
            if ($num_rows > 0) {
              array_push($folders_old, $directory);
            } else {
              // $query = "INSERT INTO uploads (directory_name, directory_status, date_add) VALUES ('$directory', '0', NOW())";
              // echo '<br>query to add this folder to DB '.$query.'<br><br>';
              array_push($folders_new,$directory);
              // $add_folder_name = mysql_query($query, $link);
              // echo '<br>folder '.$directory.' added to DB';
            }

          }

          if( empty($folders_new) ) { ?>

            <h1 class="title title-orange">Новых дирректорий не обнаружено</h1>

          <?php } else { ?>

            <h1 class="title title-green">Были обнаруженны следующие новые директории:</h1>
            <form class="refresh-new-folder" action="">
              <table>
                <tr>
                  <th>Имя новой папки</th>
                  <th>Действие</th>
                </tr>
                <?php foreach ($folders_new as $newfolder) { ?>
                  <tr>
                    <td>
                      <input type="text" name="foldername" value="<?php echo $newfolder; ?>">
                      <?php echo $newfolder; ?>
                    </td>
                    <td>
                      <label for="add">
                        <input type="checkbox" name="add" id="add" checked="checked"><span>Добавить</span>
                      </label>
                      <label for="ignore">
                        <input type="checkbox" name="ignore" id="ignore"><span>Игорировать</span>
                      </label>
                    </td>
                  </tr>
                <?php } ?>
              </table>
              <button type="submit">Добавить выбранные</button>
            </form>

          <?php } ?>

          <?php if( empty($folders_new) ) { ?>
            <h1 class="title title-orange">В базе нет ничего</h1>
          <?php } else { ?>

            <h1 class="title title-green">В базе уже есть следующие директории</h1>
            <p></p>

            <form action="" class="refresh-old-folders">
              <table>
                <tr>
                  <th>
                    <i class="fa fa-chevron-right"></i> ID</i>
                  </th>
                  <th>
                    <i class="fa fa-calendar"></i> DATE</i>
                  </th>
                  <th>
                    <i class="fa fa-folder-open-o"> NAME</i>
                  </th>
                  <th>
                    <i class="fa fa-file-text-o"></i> TXT</i>
                  </th>
                  <th>
                    <i class="fa fa-file-pdf-o"></i> PDF</i>
                  </th>
                  <th>
                    <i class="fa fa-file-pdf-o"></i> PDF 2</i>
                  </th>
                  <th>
                    <i class="fa fa-plus-circle"></i> ADD</i>
                  </th>
                </tr>


                <?php
                  $sql    = 'SELECT ID, date_add, directory_name, directory_txt,directory_pdf, directory_pdf2, directory_status FROM uploads';
                  $result = mysql_query($sql, $link);

                  while ($row = mysql_fetch_assoc($result)) { ?>

                  <tr>
                    <td>
                      <?php echo $row['ID']; ?>
                    </td>
                    <td>
                      <?php echo $row['date_add']; ?>
                    </td>
                    <td>
                      <?php echo $row['directory_name']; ?>
                    </td>
                    <td>
                      <?php echo $row['directory_txt']; ?>
                    </td>
                    <td>
                      <?php echo $row['directory_pdf']; ?>
                    </td>
                    <td>
                      <?php echo $row['directory_pdf2']; ?>
                    </td>
                    <td>
                      <span class="hidden"><?php echo $row['directory_status']; ?></span>
                      <input type="checkbox" value="<?php echo $row['directory_name']; ?>">

                    </td>
                  </tr>
                <? } ?>

              </table>
            </form>
          <?php } ?>
      </article>

<?php include 'template/footer.php';?>
