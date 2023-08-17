<?php
// ini_set("display_errors", 1);
// ini_set("display_startup_errors", 1);
// error_reporting(E_ALL);

require_once "../../wp-load.php";
$theme_directory = get_template_directory();
require_once $theme_directory . "/functions.php";

$site_content = file_get_contents("index-sub.html");
$user = wp_get_current_user();
$filtered_user = [];
// insert user id, profile picture, name into filtered_user
$filtered_user["id"] = $user->ID;
$filtered_user["profile_picture"] = get_avatar_url($user->ID);
$filtered_user["first_name"] = get_user_meta($user->ID, "first_name", true);
$filtered_user["last_name"] = get_user_meta($user->ID, "last_name", true);

$nonce = wp_create_nonce("wp_rest");
?>
<script>
var wordpressUser = <?php echo json_encode($filtered_user); ?>;
var nonce = '<?php echo $nonce; ?>';
</script>
<?php echo $site_content;
?>