<?php
/*
**************************************************************************
Plugin Name:	Featured Blog Authors
Plugin URI:	http://blog.ifbdesign.com
Description:	Creates a featured blogger / author bio box at the bottom of every post.
Author:		IFB Design - Don Gilbert
Version:	1.0
Author URI: 	http://ifbdesign.com

**************************************************************************

Copyright (C) 2010 IFBDesign

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
	    $post_count=get_the_author_posts();
	    $html="<div id='avatar'>\n";
	    $html.="<a href='".$post_author_url."'>\n";
	    $html.="<img width='80' height='80' class='avatar' src='http://www.gravatar.com/avatar.php?gravatar_id=".md5(get_the_author_email()). "&default=".urlencode($GLOBALS['defaultgravatar'])."&size=80&r=PG' alt='PG'/>\n";
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
	echo "
	<style type='text/css'>
	.author_bio{padding:10px;border:#D7D7D7 1px solid;background:#EEE;}
	.avatar {padding: 12px 12px 0pt; float: left;}
	.bio_post_count{text-align:right;margin-bottom:0;}
	</style>
	";
}

add_action('wp_head', 'ifbd_featured_blog_authors_css');

?>
