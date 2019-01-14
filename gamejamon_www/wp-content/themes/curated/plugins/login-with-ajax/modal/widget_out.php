<?php
/*
 * This is the page users will see logged out. 
 * You can edit this, but for upgrade safety you should copy and modify this file into your template folder.
 * The location from within your template folder is plugins/login-with-ajax/ (create these directories if they don't exist)
 */
?>		
<a href="#" class="open-login-form" title="Login" data-reveal-id="cur-login" data-animation="fade" data-dismissmodalclass="login-reveal-modal">Login</a>
<div id="cur-modal" class="lwa-modal mh-custom-modal">
<?php if (!empty($lwa_data['remember'])): ?>
    <div id="cur-remember" class="reveal-modal">
        <form class="lwa-form" action="<?php echo esc_attr(LoginWithAjax::$url_remember) ?>" method="post">

            <h3><?php _e('PASSWORD RESET', 'curated'); ?></h3>
            <span class="lwa-status"></span>
            <input placeholder="email" type="text" name="user_login" class="lwa-user-remember" value="" />
                   <?php do_action('lostpassword_form'); ?>

            <div class="cur-btn">
                <input type="submit" value="<?php esc_attr_e("Get New Password", 'curated'); ?>" class="lwa-button-remember i-button dark medium" />                        
                <input type="hidden" name="login-with-ajax" value="remember" />
            </div>
            <?php if (get_option('users_can_register') && !empty($lwa_data['registration'])) : ?>
                <div class="col-sm-4 tleft"><a class="remember-modal-closer" data-reveal-id="cur-register" data-animation="fade" data-dismissmodalclass="register-reveal-modal" ><?php esc_html_e('Register acount', 'curated') ?></a></div>
                <?php endif; ?>	            
            <div class="col-sm-4 tright">
                <a class="remember-modal-closer"  title="Login" data-reveal-id="cur-login" data-animation="fade"><?php _e('Back to Login', 'curated'); ?></a>
            </div> 
        </form>
    </div>
<?php endif; ?>

<?php if (get_option('users_can_register') && !empty($lwa_data['registration'])): ?>
    <div id="cur-register" class="reveal-modal">        
            <form class="lwa-form" action="<?php echo esc_attr(LoginWithAjax::$url_register); ?>" method="post">
                <h3><?php esc_html_e('REGISTER', 'curated') ?></h3>   
                <span class="lwa-status"></span>
                <input type="text" name="user_login" id="user_login" placeholder="username" class="input" size="20" tabindex="102" /><br>
                <input type="text" name="user_email" id="user_email" placeholder="email" class="input" size="25" tabindex="103" />
                <?php do_action('register_form'); ?>
                <?php do_action('lwa_register_form'); ?>

                <div class="cur-btn">                
                    <input type="submit" class="i-button dark medium" name="wp-submit" id="wp-submit" class="button-primary" value="<?php esc_attr_e('Register', 'curated'); ?>" tabindex="104" />
                    <input type="hidden" name="login-with-ajax" value="register" />
                </div>
                <?php if (!empty($lwa_data['remember'])): ?>
                    <div class="col-sm-4 tleft"><a class="lwa-links-remember register-modal-closer" data-reveal-id="cur-remember" data-animation="fade" data-dismissmodalclass="remember-reveal-modal" title="<?php esc_attr_e('Password Lost and Found', 'curated') ?>"><?php esc_attr_e('Forgot Password', 'curated') ?></a></div>
                <?php endif; ?>                
                <div class="col-sm-4 tright">
                    <a class="register-modal-closer"  title="Login" data-reveal-id="cur-login" data-animation="fade"><?php _e('Back to Login', 'curated'); ?></a>
                </div>            

            </form>
    </div>
<?php endif; ?>

<div id="cur-login" class="reveal-modal" data-redirect="force">
        <form name="lwa-form" class="lwa-form" action="<?php echo esc_attr(LoginWithAjax::$url_login); ?>" method="post">
            <h3>LOG IN</h3>
            <span class="lwa-status"></span>
            <input type="text" name="log" id="lwa_user_login" class="input" placeholder="username" tabindex="111" /><br>
            <input type="password" name="pwd" id="lwa_user_pass" class="input" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;" tabindex="112" /><br>

            
            <div class="cur-btn">
                <input type="submit" class="i-button dark medium" name="wp-submit" id="lwa_wp-submit" value="<?php esc_attr_e('Log In', 'curated'); ?>" tabindex="113" />
                <input type="hidden" name="lwa_profile_link" value="<?php echo!empty($lwa_data['profile_link']) ? 1 : 0 ?>" />
                <input type="hidden" name="login-with-ajax" value="login" />
            </div>
            <?php if (!empty($lwa_data['remember'])): ?>
                <div class="col-sm-4 tleft"><a class="lwa-links-remember login-modal-closer" data-reveal-id="cur-remember" data-animation="fade" data-dismissmodalclass="remember-reveal-modal" title="<?php esc_attr_e('Password Lost and Found', 'curated') ?>"><?php esc_attr_e('Forgot Password', 'curated') ?></a></div>
            <?php endif; ?>
            <?php if (get_option('users_can_register') && !empty($lwa_data['registration'])) : ?>
                <div class="col-sm-4 tright"><a class="login-modal-closer" data-reveal-id="cur-register" data-animation="fade" data-dismissmodalclass="register-reveal-modal" ><?php esc_html_e('Register new acount', 'curated') ?></a></div>
                <?php endif; ?>	                  
        </form>

</div>
</div>