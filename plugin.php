<?php
/*
Plugin Name: Clean UP
Plugin URI: http://mr.hokya.com/clean-up/
Description: Clean junk files or trashes that automatically created due to autosaving while writting new Posts. Deleting these junks will keep your database clean and save a lot of space of your MSQL Database.
Version: 3.00
Author: Julian Widya Perdana
Author URI: http://mr.hokya.com/
*/

function register_clean_up () {
	wp_add_dashboard_widget("Clean_Up","Clean Up","clean_up_widget");
}

function clean_up_widget () {
	global $wpdb;
	
	if($_POST["clean_up"]<>"") {
		$wpdb->query("delete from $wpdb->posts where post_type='revision'");
		$wpdb->query("delete from $wpdb->postmeta where meta_key ='_edit_last' or meta_key = '_edit_lock'");
		echo "<div class='updated fade'>Junk files cleaned !!! Find it <a href='http://mr.hokya.com/donate' target='_blank'>useful</a> ?</div>";
	}
	
	$result = $wpdb->get_results("select * from $wpdb->posts where post_type='revision'");
	$jumlah = count($result);
	$result2 = $wpdb->get_results("select * from $wpdb->postmeta where meta_key ='_edit_last' or meta_key = '_edit_lock' ");
	$jumlah += count($result2);
	echo "<h2 align='center'><font color='#003399'>$jumlah</font> record(s)</h2>";
	echo "<p>Those are the junk files or trashes that automatically created due to autosaving while writting new Posts and also by making changes or editting your old posts Don't feel worried on removing them. Deleting these junks will keep your database clean and surely SAVE a lot of space of your MSQL Database. <a href='http://mr.hokya.com/clean-up' target='_blank'>Learn more</a></p>";
	echo "<div align='center'><form method='post'><input type='submit' name='clean_up' value='Clean Up' class='button-primary' /></form></div>";
}

add_action('wp_dashboard_setup','register_clean_up');

?>