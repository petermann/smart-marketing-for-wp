<?php

if ( ! defined( 'ABSPATH' ) ) {
    die();
}

if(isset($_POST['action'])){
    if (
        ($_POST['egoi_webpush']['track'] == 1 || $_POST['egoi_webpush']['track'] === 0) &&
        (trim($_POST['egoi_webpush']['cod']) != '')
    ) {
        if (!get_option('egoi_webpush')) {
            add_option('egoi_webpush', $_POST['egoi_webpush']);
        } else {
            update_option('egoi_webpush', $_POST['egoi_webpush']);
        }

        echo '<div class="e-goi-notice updated notice is-dismissible"><p>';
        _e('Web Push Updated!', 'egoi-for-wp');
        echo '</p></div>';

    } else {
        echo '<div class="error notice is-dismissible"><p>';
        _e('ERROR!', 'egoi-for-wp');
        echo '</p></div>';
    }
}
$options = get_option('egoi_webpush');
?>

<h1 class="logo">Smart Marketing - <?php _e( 'Web Push', 'egoi-for-wp' ); ?></h1>
<p class="breadcrumbs">
    <span class="prefix"><?php echo __( 'You are here: ', 'egoi-for-wp' ); ?></span>
    <strong>Smart Marketing</a> &rsaquo;
        <span class="current-crumb"><?php _e( 'Web Push', 'egoi-for-wp' ); ?></strong></span>
</p>
<hr/>

<?php
    $locale = get_locale();

    if (strpos($locale, 'pt') !== false) {
        $link_money = 'https://www.e-goi.pt/precos/';
        $link_tutorial = 'https://helpdesk.e-goi.com/765004-Criar-web-push';
    } else if (strpos($locale, 'es') !== false) {
        $link_money = 'https://www.e-goi.pt/precos/';
        $link_tutorial = 'https://helpdesk.e-goi.com/092775-Crear-mensaje-web-push';
    } else {
        $link_money = 'https://www.e-goi.pt/precos/';
        $link_tutorial = 'https://helpdesk.e-goi.com/135733-Creating-a-web-push-message';
    }
?>

<div class="notice notice-info" style="margin: 5px 15px 10px 0;">
    <p><?php _e('To use E-goi Web Push you need to join a paid plan.', 'egoi-for-wp'); ?></p>
    <p>
        <?php _e('If you not joined to a E-goi paid plan, click', 'egoi-for-wp'); ?>
        <a href="<?php echo $link_money; ?>" target="_blank"><?php _e('here', 'egoi-for-wp'); ?></a>.
    </p>
</div>

<div class="notice notice-info" style="margin: 5px 15px 10px 0;">
    <p><?php _e('To configure E-goi Web Push, you need a web push code.', 'egoi-for-wp'); ?> </p>
    <p>
        <a href="<?php echo $link_tutorial; ?>" target="_blank"><?php _e('Here', 'egoi-for-wp'); ?></a>
        <?php _e('show how to get a Web Push code.', 'egoi-for-wp'); ?>
        <?php _e('You only need to copy the code marked in black as in the example below.', 'egoi-for-wp'); ?>
    </p>
    <?php
        $wpcode = plugin_dir_url() . 'smart-marketing-for-wp/admin/img/webpushcode.png';
    ?>
    <img src="<?=$wpcode?>" style="margin-bottom: 5px;">
</div>

<div style="max-width:80%; padding: 5px 5px 5px;">

    <form method="post" action="#">
        <?php
            settings_fields( Egoi_For_Wp_Admin::OPTION_NAME );
            settings_errors();
        ?>

        <table class="form-table">
            <tr>
                <th scope="row"><?php _e( 'Activate Web Push', 'egoi-for-wp' ); ?></th>
                <td class="nowrap">
                    <label><input id="yes" type="radio" name="egoi_webpush[track]" <?php checked( $options['track'], 1 ); ?> value="1" required><?php _e( 'Yes', 'egoi-for-wp' ); ?></label> &nbsp;
                    <label><input id="no" type="radio" name="egoi_webpush[track]" <?php checked( $options['track'], 0 ); ?> value="0"><?php _e( 'No', 'egoi-for-wp' ); ?></label>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php _e( 'Web Push Code', 'egoi-for-wp' ); ?></th>
                <td>
                    <input class="e-goi-form-title--input" type="text" name="egoi_webpush[cod]" size="40" id="egoi_webpush_cod"
                           autocomplete="off" placeholder="<?php echo __( "Write here the code of your Web Push", 'egoi-for-wp' ); ?>"
                           required pattern="[a-zA-Z0-9\s]+" value="<?php echo $options['cod'];?> "/>
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>

</div>