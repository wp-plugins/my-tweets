<?php
/*
Plugin Name: My Tweets
Plugin URI: http://www.couponcondo.com/plugins/twitter-plugin/
Description: Displays your latest tweets as a widget.
Version: 1.0.2
Author: CouponCondo.com
Author URI: http://www.couponcondo.com
*/

/*  Copyright 2011 CouponCondo - support@couponcondo.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Hook for adding admin menus
add_action('admin_menu', 'my_twitter_add_pages');
add_action('delete_my_twitter_cache','delete_cache');
add_action('wp_head','my_twitter_delete_cache');
add_action('delete_my_twitter_cache','delete_my_twitter_cache');

if (!function_exists("my_twitter_refresh")) {
function my_twitter_refresh() {
update_option("submitted_tweets", "0");
}
}

// action function for above hook
function my_twitter_add_pages() {
    add_options_page('My Tweets', 'My Tweets', 'administrator', 'twitter', 'my_twitter_options_page');
}

// my_twitter_options_page() displays the page content for the Test Options submenu
function my_twitter_options_page() {

    // variables for the field and option names 
    $opt_name = 'mt_my_twitter_account';
    $opt_name_2 = 'mt_my_twitter_messages';
    $opt_name_3 = 'mt_my_twitter_links';
    $opt_name_4 = 'mt_my_twitter_replies';
    $opt_name_5 = 'mt_my_twitter_plugin_support';
    $opt_name_6 = 'mt_my_twitter_title';
    $opt_name_7 = 'mt_my_twitter_follow';
    $opt_name_8 = 'mt_my_twitter_gravatar';
    $opt_name_9 = 'mt_my_twitter_cache';
	$opt_name_10 = 'mt_my_twitter_date';
	$opt_name_11 = 'mt_my_twitter_colour';
	$opt_name_12 = 'mt_my_twitter_width';
	$opt_name_13 = 'mt_my_twitter_height';
    $hidden_field_name = 'mt_my_twitter_submit_hidden';
    $data_field_name = 'mt_my_twitter_account';
    $data_field_name_2 = 'mt_my_twitter_messages';
    $data_field_name_3 = 'mt_my_twitter_links';
    $data_field_name_4 = 'mt_my_twitter_replies';
    $data_field_name_5 = 'mt_my_twitter_plugin_support';
    $data_field_name_6 = 'mt_my_twitter_title';
    $data_field_name_7 = 'mt_my_twitter_follow';
    $data_field_name_8 = 'mt_my_twitter_gravatar';
    $data_field_name_9 = 'mt_my_twitter_cache';
	$data_field_name_10 = 'mt_my_twitter_date';
	$data_field_name_11 = 'mt_my_twitter_colour';
	$data_field_name_12 = 'mt_my_twitter_width';
	$data_field_name_13 = 'mt_my_twitter_height';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
    $opt_val_2 = get_option($opt_name_2);
    $opt_val_3 = get_option($opt_name_3);
    $opt_val_4 = get_option($opt_name_4);
    $opt_val_5 = get_option($opt_name_5);
    $opt_val_6 = get_option($opt_name_6);
    $opt_val_7 = get_option($opt_name_7);
    $opt_val_8 = get_option($opt_name_8);
    $opt_val_9 = get_option($opt_name_9);
	$opt_val_10 = get_option($opt_name_10);
	$opt_val_11 = get_option($opt_name_11);
	$opt_val_12 = get_option($opt_name_12);
	$opt_val_13 = get_option($opt_name_13);
    
if ($_POST['delcache']=="true") {
update_option("mt_my_twitter_cachey", "");
}

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
        $opt_val_2 = $_POST[$data_field_name_2];
        $opt_val_3 = $_POST[$data_field_name_3];
        $opt_val_4 = $_POST[$data_field_name_4];
        $opt_val_5 = $_POST[$data_field_name_5];
        $opt_val_6 = $_POST[$data_field_name_6];
        $opt_val_7 = $_POST[$data_field_name_7];
        $opt_val_8 = $_POST[$data_field_name_8];
        $opt_val_9 = $_POST[$data_field_name_9];
		$opt_val_10 = $_POST[$data_field_name_10];
		$opt_val_11 = $_POST[$data_field_name_11];
		$opt_val_12 = $_POST[$data_field_name_12];
		$opt_val_13 = $_POST[$data_field_name_13];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
        update_option( $opt_name_2, $opt_val_2 );
        update_option( $opt_name_3, $opt_val_3 );
        update_option( $opt_name_4, $opt_val_4 );
        update_option( $opt_name_5, $opt_val_5 );
        update_option( $opt_name_6, $opt_val_6 ); 
        update_option( $opt_name_7, $opt_val_7 );
        update_option( $opt_name_8, $opt_val_8 );
        update_option( $opt_name_9, $opt_val_9 );
		update_option( $opt_name_10, $opt_val_10 );
		update_option( $opt_name_11, $opt_val_11 );
		update_option( $opt_name_12, $opt_val_12 );
		update_option( $opt_name_13, $opt_val_13 );
		update_option("mt_my_twitter_cachey", "");

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Twitter Plugin Options', 'mt_trans_domain' ) . "</h2>";
?>
<br /><strong>Write the following in the widget options to display: </strong><br /><br />
To display username - %user%<br />
To display no. of Followers - %followers%<br />
To display no. of People Following - %following%<br />
To display no. of Status Updates - %statuses%<br />
Location: %location%<br /><br />
<?php

    // options form
    

    $change1 = get_option("mt_my_twitter_links");
    $change2 = get_option("mt_my_twitter_replies");
    $change3 = get_option("mt_my_twitter_plugin_support");
    $change4 = get_option("mt_my_twitter_follow");
    $change5 = get_option("mt_my_twitter_gravatar");
    $change6 = get_option("mt_my_twitter_cache");
	$change7 = get_option("mt_my_twitter_date");
	$change8 = get_option("mt_my_twitter_colour");

if ($change1=="Yes" || $change1=="") {
$change1="checked";
$change11="";
} else {
$change1="";
$change11="checked";
}

if ($change2=="Yes" || $change2=="") {
$change2="checked";
$change21="";
} else {
$change2="";
$change21="checked";
}

if ($change3=="Yes" || $change3=="") {
$change3="checked";
$change31="";
} else {
$change3="";
$change31="checked";
}

if ($change4=="Yes" || $change4=="") {
$change4="checked";
$change41="";
} else {
$change4="";
$change41="checked";
}

if ($change5=="Yes" || $change5=="") {
$change5="checked";
$change51="";
} else {
$change5="";
$change51="checked";
}

if ($change6=="Yes" || $change6=="") {
$change6="checked";
$change61="";
} else {
$change6="";
$change61="checked";
}

switch ($change7) {
case "None":
$change7="checked";
$change71="";
$change72="";
$change73="";
break;
case "Day":
$change7="";
$change71="checked";
$change72="";
$change73="";
break;
case "Date":
$change7="";
$change71="";
$change72="checked";
$change73="";
break;
case "Full":
$change7="";
$change71="";
$change72="";
$change73="checked";
break;
}

    ?>
	
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Twitter Widget Title:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_6; ?>" value="<?php echo $opt_val_6; ?>" size="50">
</p><hr />

<p><?php _e("Twitter.com Username:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="20">
</p><hr />

<p><?php _e("Number of Twitter Messages to Show:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_2; ?>" value="<?php echo $opt_val_2; ?>" size="3">
</p><hr />

<p><?php _e("Check for new messages every... (Recommended: 30)", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_9; ?>" value="<?php echo $opt_val_9; ?>" size="4"> Minutes
</p><hr />

<p><?php _e("Change widget title into a link to your profile?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_7; ?>" value="Yes" <?php echo $change4; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_7; ?>" value="No" <?php echo $change41; ?>>No
</p><hr />

<p><?php _e("Show the time posted in format: ", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_10; ?>" value="None" <?php echo $change7; ?>>Don't show time posted
<input type="radio" name="<?php echo $data_field_name_10; ?>" value="Day" <?php echo $change71; ?>>Show the day
</p><hr />

<p><?php _e("Display your Twitter profile image?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_8; ?>" value="Yes" <?php echo $change5; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_8; ?>" value="No" <?php echo $change51; ?>>No
</p><hr />

<p><?php _e("Profile image dimensions (Leave blank for default):", 'mt_trans_domain' ); ?>
<input type="text" name="<?php echo $data_field_name_12; ?>" value="<?php echo $opt_val_12; ?>" />px width by
<input type="text" name="<?php echo $data_field_name_13; ?>" value="<?php echo $opt_val_13; ?>" />px height.
</p><hr />

<p><?php _e("Change URLs in Twitter into Hyperlinks?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_3; ?>" value="Yes" <?php echo $change1; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_3; ?>" value="No" <?php echo $change11; ?>>No
</p><hr />

<p><?php _e("Change @Replies into Hyperlinks? (Eg. @CouponCondo):", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_4; ?>" value="Yes" <?php echo $change2; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_4; ?>" value="No" <?php echo $change21; ?>>No
</p><hr />

<p><?php _e("Support our Plugin?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="Yes" <?php echo $change3; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="No" <?php echo $change31; ?> >No
</p><hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p><hr />

</form>

<form action="" method="post"><input type="hidden" name="delcache" value="true" /><input type="submit" value="Delete Cache" /></form><br /><br />
<?php
 
}

function my_twitter_delete_cache() {
$optiontwittercache = get_option("mt_my_twitter_cache");

$optiontwittercache=$optiontwittercache*60;

$schedule=wp_next_scheduled("delete_my_twitter_cache");

if ($schedule=="") {
wp_schedule_single_event(time()+$optiontwittercache, 'delete_my_twitter_cache'); 
}
}

function delete_my_twitter_cache() {
update_option("mt_my_twitter_cachey", "");
}


function show_twitter($args) {
extract($args);

  $widget_title = get_option("mt_my_twitter_title"); 
  $max_tweets = get_option("mt_my_twitter_messages"); 
  $optiontwitter = get_option("mt_my_twitter_account");
  $turnlinks = get_option("mt_my_twitter_links");
  $turnreplies = get_option("mt_my_twitter_replies");
  $turnfollow = get_option("mt_my_twitter_follow");
  $enablegravatar = get_option("mt_my_twitter_gravatar");
  $supportplugin = get_option("mt_my_twitter_plugin_support"); 
  $optiontwitcache = get_option("mt_my_twitter_cache");
  $turndate = get_option("mt_my_twitter_date");
  $twittercolour = get_option("mt_my_twitter_colour");
  $twitterwidth = get_option("mt_my_twitter_width");
  $twitterheight = get_option("mt_my_twitter_height");

if (!$optiontwitter=="") {

$xmldata = simplexml_load_file('http://twitter.com/users/show/'.$optiontwitter.'.xml');

$gravatar=$xmldata->profile_image_url;
$followers=$xmldata->followers_count . ' Followers';
$following=$xmldata->friends_count . ' Friends';
$statuses=$xmldata->statuses_count . ' Statuses';

$location=$xmldata->location;

if ($xmldata-->followers_count=="") {
$followers="0 Followers";
}

if ($xmldata-->friends_count=="") {
$following="0 Friends";
}

if ($xmldata-->location=="") {
$location="Unknown Location";
}

$widget_title=str_replace("%user%", $optiontwitter, $widget_title);
$widget_title=str_replace("%followers%", $followers, $widget_title);
$widget_title=str_replace("%following%", $following, $widget_title);
$widget_title=str_replace("%statuses%", $statuses, $widget_title);
$widget_title=str_replace("%location%", $location, $widget_title);

$doc = new DOMDocument();
 
if($doc->load('http://twitter.com/statuses/user_timeline/'.$optiontwitter.'.rss')) {
 
  $i = 1;

if ($enablegravatar=="" || $enablegravatar=="Yes") {
$breaky="<br /><br />";
} else {
$breaky="";
}

$cachey = get_option("mt_my_twitter_cachey");

if (!$cachey=="") {
echo $cachey;

my_twitter_delete_cache();

} else {
$twitterdisp="";

if ($twitterwidth!="" && $twitterheight!="") {
$extracode='width="'.$twitterwidth.'" height="'.$twitterheight.'"';
} else {
$extracode="";
}

if ($enablegravatar=="" || $enablegravatar=="Yes") { $twitterdisp .= '<img src="'.$gravatar.'" alt="'.$optiontwitter.'" '.$extracode.' align="left" style="padding: 3px;"/>'; }
  $twitterdisp .= $before_widget.$before_title; 

  if ($turnfollow=="" || $turnfollow=="Yes") { $twitterdisp .= '<a href="http://twitter.com/'.$optiontwitter.'">'; }
  $twitterdisp .= $widget_title.'</a>'.$after_title.$breaky;
  
$j=0;

  foreach ($doc->getElementsByTagName('item') as $node) {

    $t_tweet = $node->getElementsByTagName('title')->item(0);
	$tweet = $t_tweet->nodeValue;	
    $tweet = substr($tweet, stripos($tweet, ':') + 1); 
 
    //Change URLs into links?
if ($turnlinks=="Yes" || $turnlinks=="") {
    $tweet = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', 
          '<a href="$1" rel="nofollow">$1</a>', $tweet);
}
 
if ($turnreplies=="Yes" || $turnreplies=="") {
    $tweet = preg_replace("/@([0-9a-zA-Z]+)/", 
          "<a href=\"http://twitter.com/$1\" rel='nofollow'>@$1</a>", 
          $tweet);
}

if ($j=0) {
if ($tweet=="") {
$donotsave="true";
}
$j ++;
}

if ($turndate=="Day") {
$t_date=$node->getElementsByTagName('pubDate')->item(0);
$date=$t_date->nodeValue;	
$date = substr($date,0,3);
$date = $date . ' - ';
}
 
    $twitterdisp .= '<li>'.$date.'" '.$tweet.'"</li>';
 
    if($i++ >= $max_tweets) break;
  }

if ($supportplugin=="Yes" || $supportplugin=="") {
$twitterdisp .= '<p>Twitter Plugin made by <a href="http://www.open-office-download.net">Open Office</a></p>';
}

$twitterdisp .= $after_widget;
echo $twitterdisp;

if ($donotsave != "true") {
update_option("mt_my_twitter_cachey", $twitterdisp);
}

}

}

}

}


function init_my_twitter_widget() {
register_sidebar_widget("My Tweets", "show_twitter");
}

add_action("plugins_loaded", "init_my_twitter_widget");

?>
