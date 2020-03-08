<?php

$json_file = AM__PLUGIN_DIR.'/data/settings.json';

if (isset($_POST['submit'])) {

  $json_string = array(
    'active' => $_POST['visitor_show'],
    'welcome_title' => $_POST['welcome_title'],
    'welcome_message' => $_POST['welcome_message'],
    'confirmation_title' => $_POST['confirmation_title'],
    'confirmation_message' => $_POST['confirmation_message'],
    'visitor_display'  => $_POST['visitor_display'],
    'visitor_page'  => $_POST['visitor_page'],
    'active'  => $_POST['active'],
    'admin_page'  => $_POST['admin_page']
  );

  $json_encode = json_encode($json_string);

  file_put_contents($json_file, $json_encode);


}

$json_data['visitor_page'] = get_posts(
 array(
  'numberposts' => -1,
  'post_status' => 0,
  'post_type' => get_post_types('', 'names'),
  'post_type' => 'page',
 )
);

$display_visitor_pages = get_posts(
 array(
  'numberposts' => -1,
  'post_status' => 0,
  'post_type' => get_post_types('', 'names'),
 )
);

$display_admin_pages = get_posts(
 array(
  'numberposts' => -1,
  'post_status' => 5,
  'post_type' => get_post_types('', 'names'),
  'post_type' => 'page',
 )
);

$json = file_get_contents($json_file);

$json_data = json_decode($json,true);


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <h1 style="font-size:2rem" class="blog-post-title">Settings</h1>
    <p>Here you can set basic parameters and controls for the plugin!</p>
    <br>
    <br>

    <form style="margin-left:20px" class="" action="" method="post">

      <h2 style="font-size:1.5rem">Visitors</h2>

        <table>
            <tr>
              <th style="width:200px;"><label for="welcome_title">Welcome-title:</label></th>
              <th style="font-weight: normal;"><input type="text" name="welcome_title" value="<?php print_r($json_data['welcome_title']); ?>" size="80"></th>
            </tr>

            <tr>
              <th><br></th>
            </tr>

            <tr>
              <th style="width:200px;"><label for="welcome_message">Welcome-message:</label></th>
              <th style="font-weight: normal;"><textarea name="welcome_message" rows="12" cols="80" size="80" ><?php print_r($json_data['welcome_message']); ?></textarea></th>
            </tr>

            <tr>
              <th><br></th>
            </tr>
        </table>

        	<br><br>

        <table>
            <tr>
              <th style="width:200px;"><label for="confirmation_title">Confirmation-title:</label></th>
              <th style="font-weight: normal;"><input type="text" name="confirmation_title" value="<?php print_r($json_data['confirmation_title']); ?>" size="80"></th>
            </tr>

            <tr>
              <th><br></th>
            </tr>

            <tr>
              <th style="width:200px;"><label for="confirmation_message">Confirmation-message:</label></th>
              <th style="font-weight: normal;"><textarea name="confirmation_message" rows="12" cols="80" size="80" ><?php print_r($json_data['confirmation_message']); ?></textarea></th>
            </tr>
        </table>

        <br><br>

        <table>
          <tr>
            <th style="width:200px;"><label for="visitor_display">Display:</label></th>
            <th style="font-weight: normal;">
              <select class="" name="visitor_display">
                <?php

                  if ($json_data['visitor_display'] == 1) {
                    echo '<option value="1" selected="selected">Show</option>';
                    echo '<option value="0">Hide</option>';
                  }
                  elseif ($json_data['visitor_display'] == 0) {
                    echo '<option value="1">Show</option>';
                    echo '<option value="0" selected="selected">Hide</option>';
                  }

                ?>
              </select>
            </th>
          </tr>

          <tr>
            <th><br></th>
          </tr>

          <tr>
            <th style="width:200px;"><label for="visitor_page">Display-page:</label></th>
            <th style="font-weight: normal;">
              <select class="" name="visitor_page">
                <?php

                if (!isset($json_data['visitor_page'])){
                  echo '<option value="" selected="selected">Choose page</option>';
                }


                foreach ($display_visitor_pages as $display_visitor_page) {
                  if (isset($json_data['visitor_page'])) {

                    if($display_visitor_page->ID == $json_data['visitor_page']){

                      echo '<option value="'.$display_visitor_page->ID.'" selected="selected">'.$display_visitor_page->post_title.'</option>';

                    }else{

                      echo '<option value="'.$display_visitor_page->ID.'">'.$display_visitor_page->post_title.'</option>';

                    }
                  }else{

                    echo '<option value="'.$display_visitor_page->ID.'">'.$display_visitor_page->post_title.'</option>';

                  }
                }

                 ?>
              </select>
            </th>
          </tr>
        </table>

      <br><br><br>

      <h2 style="font-size:1.5rem">Administrator</h2>

      <table>
        <tr>
          <th style="width:200px;"><label for="active">Active:</label></th>
          <th style="font-weight: normal;">
            <select class="" name="active">
              <?php

                if ($json_data['active'] == 1) {
                  echo '<option value="1" selected="selected">Yes</option>';
                  echo '<option value="0">No</option>';
                }
                elseif ($json_data['active'] == 0) {
                  echo '<option value="1">Yes</option>';
                  echo '<option value="0" selected="selected">No</option>';
                }

              ?>
            </select>
          </th>
        </tr>

        <tr>
          <th><br></th>
        </tr>

        <tr>
          <th style="width:200px;"><label for="admin_page">Display-page:</label></th>
          <th style="font-weight: normal;">
            <select class="" name="admin_page">
              <?php

              if (!isset($json_data['admin_page'])){
                echo '<option value="" selected="selected">Choose page</option>';
              }


              foreach ($display_admin_pages as $display_admin_page) {
                if (isset($json_data['admin_page'])) {

                  if($display_admin_page->ID == $json_data['admin_page']){

                    echo '<option value="'.$display_admin_page->ID.'" selected="selected">'.$display_admin_page->post_title.'</option>';

                  }else{

                    echo '<option value="'.$display_admin_page->ID.'">'.$display_admin_page->post_title.'</option>';

                  }
                }else{

                  echo '<option value="'.$display_admin_page->ID.'">'.$display_admin_page->post_title.'</option>';

                }
              }

               ?>
            </select>
          </th>

      </table>

      <br>
      <br>
      <br>

      <button style="padding:5px; width:75px; border-radius:5px; border-style:none; background-color:#1989c1; color:#fff" type="submit" name="submit">Spara</button>

    </form>
  </body>
</html>
