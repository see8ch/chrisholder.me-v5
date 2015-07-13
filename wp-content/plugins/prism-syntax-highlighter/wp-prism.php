<?php
/*
Plugin Name: Prism Syntax Highlighter
Plugin URI: http://dev7studios.com/wp-prism
Description: A WordPress plugin for the Prism syntax highlighter (<a href="http://prismjs.com">http://prismjs.com</a>)
Version: 1.0
Author: Dev7studios
Author URI: http://dev7studios.com
License: GPL2
*/

class WPPrism {

    private $plugin_path;
    private $plugin_url;

    function __construct() 
    {	
        $this->plugin_path = plugin_dir_path( __FILE__ );
        $this->plugin_url = plugin_dir_url( __FILE__ );
        load_plugin_textdomain( 'wp-prism', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
        
        add_action( 'init', array(&$this, 'init') );
        add_action( 'admin_init', array(&$this, 'admin_init') );
        add_action( 'admin_menu', array(&$this, 'admin_menu') );
    }
    
    function init()
    {
        $options = get_option( 'prism_settings' );
		if( !isset($options['theme']) ) $options['theme'] = 'default.css';
		if( !isset($options['plugin_linehighlight']) ) $options['plugin_linehighlight'] = 0;
		if( !isset($options['plugin_showinvisibles']) ) $options['plugin_showinvisibles'] = 0;
		if( !isset($options['plugin_autolinker']) ) $options['plugin_autolinker'] = 0;
		
		if( $options['theme'] ){
            wp_register_style( 'prismjs', $this->plugin_url .'prism/'. $options['theme'], array(), '1.0' );
            wp_enqueue_style( 'prismjs' );
        }
        wp_register_script( 'prismjs', $this->plugin_url .'prism/prism.js', array(), '1.0', true );  
        wp_enqueue_script( 'prismjs' ); 
        
        // Include plugins
        if( $options['plugin_linehighlight'] ){
            wp_register_script( 'prismjs-linehighlight', $this->plugin_url .'prism/prism-line-highlight.js', array('prismjs'), '1.0', true );  
            wp_enqueue_script( 'prismjs-linehighlight' ); 
        }
        if( $options['plugin_showinvisibles'] ){
            wp_register_script( 'prismjs-showinvisibles', $this->plugin_url .'prism/prism-show-invisibles.js', array('prismjs'), '1.0', true );  
            wp_enqueue_script( 'prismjs-showinvisibles' ); 
        }
        if( $options['plugin_autolinker'] ){
            wp_register_script( 'prismjs-autolinker', $this->plugin_url .'prism/prism-autolinker.js', array('prismjs'), '1.0', true );  
            wp_enqueue_script( 'prismjs-autolinker' ); 
        }
    }
    
    function admin_init()
    {
        register_setting( 'prism-settings', 'prism_settings', array(&$this, 'settings_validate') );
		add_settings_section( 'prism-settings', '', array(&$this, 'settings_intro'), 'prism-settings' );
		add_settings_field( 'theme', __( 'Theme', 'wp-prism' ), array(&$this, 'setting_theme'), 'prism-settings', 'prism-settings' );
		add_settings_field( 'plugins', __( 'Plugins', 'wp-prism' ), array(&$this, 'setting_plugins'), 'prism-settings', 'prism-settings' );
    }
    
    function admin_menu()
    {
        add_options_page( __( 'Prism Settings', 'wp-prism' ), __( 'Prism Settings', 'wp-prism' ), 'manage_options', 'wp-prism', array(&$this, 'settings_page') );
    }
    
    function settings_page()
    {
        ?>
    	<div class="wrap">
    		<div id="icon-options-general" class="icon32"></div>
			<h2><?php _e( 'Prism Settings', 'wp-prism' ); ?></h2>
			<form action="options.php" method="post">
				<?php settings_fields('prism-settings'); ?>
				<?php do_settings_sections('prism-settings'); ?>
				<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e( 'Save Changes', 'wp-prism' ); ?>"></p>
			</form>
		</div>
    	<?php
    }
    
    function setting_theme()
    {
        $options = get_option( 'prism_settings' );
		if( !isset($options['theme']) ) $options['theme'] = 'default.css';
		
		echo '<select name="prism_settings[theme]">
			<option value="default.css"'. (($options['theme'] == 'default.css') ? ' selected="selected"' : '') .'>Default</option>
			<option value="dark.css"'. (($options['theme'] == 'dark.css') ? ' selected="selected"' : '') .'>Dark</option>
			<option value="funky.css"'. (($options['theme'] == 'funky.css') ? ' selected="selected"' : '') .'>Funky</option>
			<option value=""'. (($options['theme'] == '') ? ' selected="selected"' : '') .'>Custom CSS (no styles)</option>
		</select>';
    }
    
    function setting_plugins()
    {
        $options = get_option( 'prism_settings' );
		if( !isset($options['plugin_linehighlight']) ) $options['plugin_linehighlight'] = 0;
		if( !isset($options['plugin_showinvisibles']) ) $options['plugin_showinvisibles'] = 0;
		if( !isset($options['plugin_autolinker']) ) $options['plugin_autolinker'] = 0;
		
        echo '<input type="hidden" name="prism_settings[plugin_linehighlight]" value="0" />
        <label><input type="checkbox" name="prism_settings[plugin_linehighlight]" value="1"'. (($options['plugin_linehighlight']) ? ' checked="checked"' : '') .' /> 
        <a href="http://prismjs.com/plugins/line-highlight" target="_blank">Line Highlight</a></label><br />';
        echo '<input type="hidden" name="prism_settings[plugin_showinvisibles]" value="0" />
        <label><input type="checkbox" name="prism_settings[plugin_showinvisibles]" value="1"'. (($options['plugin_showinvisibles']) ? ' checked="checked"' : '') .' /> 
        <a href="http://prismjs.com/plugins/show-invisibles" target="_blank">Show Invisibles</a></label><br />';
        echo '<input type="hidden" name="prism_settings[plugin_autolinker]" value="0" />
        <label><input type="checkbox" name="prism_settings[plugin_autolinker]" value="1"'. (($options['plugin_autolinker']) ? ' checked="checked"' : '') .' /> 
        <a href="http://prismjs.com/plugins/autolinker" target="_blank">Autolinker</a></label><br />';
    }
    
    function settings_validate( $input ) { return $input; }
       
    function settings_intro() 
    {
        echo '<p>For more information on how to use Prism, check out <a href="http://prismjs.com" target="_blank">the official documentation</a>.</p>';
    }

}
new WPPrism();

?>