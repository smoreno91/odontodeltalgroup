<?php
/**
 * Generate fields in General tab.
 *
 * @author 		Jax Porter
 * @version     1.0.0
 */

?>
<table class="form-table editcomment" >
   <tbody>
        <tr>
            <td>
                <h3>
                <img  src="<?php echo userpress()->acess_url.'images/facebook.png' ?>" title="Google" alt="Google">
                    Facebook
                </h3>
                <a href="https://developers.facebook.com/">Where do I get this info?</a>
            </td>
             <?php
                $this->option_text(array(
                    'id'=>'user_press_face_api_key',
                    'title'=> esc_html__('Facebook API ID', 'user-press'),
                    'default' => '',
                    'placeholder' => 'Example: qBQQF5Cmantse0ptg413Mw'
                ));
                ?>
        </tr>
  </tbody>
</table>

<table class="form-table google" >
   <tbody>
    
            <tr class="user-press-option-google">
                <td>
                    <h3>
                            <label class="wp-neworks-label">
                                <img  src="<?php echo userpress()->acess_url.'images/google.png' ?>" title="Google" alt="Google">
                            Google
                            </label>
                    </h3>
                    <a href="https://console.cloud.google.com">Where do I get this info?</a>
                </td>
                     <?php 
                        $this->option_text(array(
                            'id'=>'user_press_google_api_key',
                            'title'=> esc_html__('Google Client ID', 'user-press'),
                            'default' => '',
                            'placeholder' => 'qBQQF5Cmantse0ptg413Mw'
                        ));
                        ?>
               
                        <?php
                         $this->option_switch(array(
                            'id'=>'user_press_status_google',
                            'title'=> esc_html__('Status login google', 'user-press'),
                            'default' => '1'
                        ));
                        ?>
             </tr>
      </tbody>
</table>

<table class="form-table google" >
    <tbody>
    <tr class="user-press-option-google">
        <td>
            <h3>
                <label class="wp-neworks-label">
                    <img src="<?php echo userpress()->acess_url .'images/twitter.png' ?>" title="Twitter" alt="Twitter" width="16px" height="16px">
                    Twitter
                </label>
            </h3>
            <a href="https://dev.twitter.com/apps/new">Where do I get this info?</a>
        </td>
        <?php
        $this->option_text(array(
            'id'=>'up_twitter_consumer_key',
            'title'=> esc_html__('Consumer Key', 'user-press'),
            'default' => '',
            'placeholder' => 'qBQQF5Cmantse0ptg413Mw'
        ));
        ?>

        <?php
        $this->option_text(array(
            'id'=>'up_twitter_consumer_secret',
            'title'=> esc_html__('Consumer Secret', 'user-press')
        ));
        $this->option_text(array(
            'id'=>'up_twitter_callback_url',
            'title'=> esc_html__('Callback URL', 'user-press')
        ));
        ?>
    </tr>
    </tbody>
</table>