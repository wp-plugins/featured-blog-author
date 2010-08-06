<?php
/*
**************************************************************************
Plugin Name:	Featured Blog Authors
Plugin URI:	http://dongilbert.net
Description:	Creates a featured blogger / author bio box at the bottom of every post. It pulls the bio box from the Author Bio on the profile screen. Has an updated admin panel that allows for selecting the color that you want for the border and background via javascript.
Author:		Don Gilbert
Version:	1.3
Author URI: 	http://dongilbert.net

**************************************************************************

Copyright (C) 2010 DonGilbert Consulting

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

**************************************************************************/


function ifbd_featured_blog_authors($content='') {
    global $post;
	if (is_single()) {
	    $post_author_name=get_the_author_meta("user_firstname");
	    $post_author_description=get_the_author_meta("description");
	    $post_author_url=get_the_author_meta("user_url");
	    $post_count = get_the_author_posts();
	    $html="<div id='avatar'>\n";
	    $html.="<a href='".$post_author_url."'>\n";
	    $html.="<img width='80' height='80' class='avatar' src='http://www.gravatar.com/avatar.php?gravatar_id=".md5(get_the_author_email())."&default=".urlencode($GLOBALS['defaultgravatar'])."&size=80&r=PG' alt='PG'/>\n";
	    $html.="</a>\n";
	    $html.="<div class='author_bio'>\n";
	    $html.= $post_author_description."";
	    $html.= "<p class='bio_post_count'> ".$post_author_name." has blogged ".$post_count." posts here.</p>";
	    $html.="</div></div>\n";
	    $content .= $html;
	}
	    return $content;
}
add_filter('the_content', 'ifbd_featured_blog_authors');


// We need some CSS to position the paragraph
function ifbd_featured_blog_authors_css() {
	echo '
	<style type="text/css">
	<!--
	.author_bio{padding:10px;border:1px solid #'.get_option('ifbd-fba-border-color').';background-color:#'.get_option('ifbd-fba-background-color').';}
	.avatar {padding: 12px 12px 0pt; float: left;}
	.bio_post_count{text-align:right;margin-bottom:0;}
	-->
	</style>
	';
}

add_action('wp_head', 'ifbd_featured_blog_authors_css');

include 'adminpage.class.php';

$site = new SubPage('settings', 'Featured Blog Authors');
$site->addParagraph('Used to be just upload and activate, now with it\'s own admin panel! Edit the values below to change the border and background colors of your author box. Simply click the input box and then use the color picker to select your color.');
$site->addTitle('Colors');
	$site->addColorPicker(array(
		'id' => 'ifbd-fba-border-color',
		'label' => 'Border Color',
		'desc' => 'Set the Border Color',
		'standard' => 'D7D7D7',
	));
	$site->addColorPicker(array(
		'id' => 'ifbd-fba-background-color',
		'label' => 'Background Color',
		'desc' => 'Set the Background Color',
		'standard' => 'EEEEEE',
	));

?>
