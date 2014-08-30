<?php 

$no_items = get_option('evstream_no_items');

$url_val = $_GET['stream'];

$idObj = get_category_by_slug($owncat); 
$category_id = $idObj->term_id;	
$pageLink = get_page_link();

$use_wp = get_option('evstream_use_wp');
$use_vis = get_option('evstream_use_vis');
$use_fli = get_option('evstream_use_fli');
$use_del = get_option('evstream_use_del');
$use_hyp = get_option('evstream_use_hyp');
$use_vim = get_option('evstream_use_vim');
$use_enj = get_option('evstream_use_enj');
$use_twi = get_option('evstream_use_twi');
$use_git = get_option('evstream_use_git');
$use_sco = get_option('evstream_use_sco');

$vis_tag = get_option('evstream_vis_tag');
$vis_id = get_option('evstream_vis_id');
$fli_id = get_option('evstream_fli_id');
$owncat = get_option('evstream_owncat');
$del_id = get_option('evstream_del_id');
$hyp_id = get_option('evstream_hyp_id');
$enj_id = get_option('evstream_enj_id');
$vim_id = get_option('evstream_vim_id');
$sco_id = get_option('evstream_sco_id');
$twi_id = get_option('evstream_twi_id');
$twi_key = get_option('evstream_twi_key');
$twi_secret = get_option('evstream_twi_secret');
$git_id = get_option('evstream_git_id');

if (!function_exists('MagpieRSS')) { 
// Check if another plugin is using RSS, may not work
	include_once (ABSPATH . WPINC . '/rss.php');
	error_reporting(E_ERROR);
}

$allItems = array();
$counter = 0;


$maxitems = (int)$no_items;
if($maxitems < 1) $maxitems = 5;
if($maxitems > 20) $maxitems = 20;
$maxitems *= 4;


if(($use_hyp == 'true' && $url_val == '' ) || $url_val == 'hypem') {

$theURL = 'http://hypem.com/playlist/loved/'.$hyp_id.'/json/1/data.js';
$sJson = file_get_contents($theURL);
if($sJson === false) $sJson = new_file_get_contents($theURL);
file_put_contents('/path/to/file', $sJson);
$oJson = json_decode($sJson);   

$hypMax = $maxitems;
if($hypMax > 20) $hypMax = 20;

for($i=0; $i < $hypMax; $i++) {
	$item = $oJson->{$i};
	$artist = $item->{'artist'};
	$title = $item->{'title'};
	$blogname = $item->{'sitename'};
	$blogurl = $item->{'posturl'};
	$loved = $item->{'loved_count'};
	$dateloved = $item->{'dateloved'} - 60*60*4;
	$date = date('r',$dateloved);
	$timestamp = $dateloved;
	$link = 'http://hypem.com/item/'.$item->{'mediaid'};
	

	$tempItem = new evStream_Item();
	$tempItem->setId($counter);
	$counter++;

	$content = '';
	$content = '<span class="evStream_title"><a href="'.$link.'">&#9829; '.$artist.' - '.$title.'</a></span> ';
	$content .= ' <span class="evStream_text">via <a href="'.$blogurl.'">'.$blogname.'</a></span> ';
	$hlink = 'http://hypem.com/'.$hyp_id;
	$content .= '<span class="evStream_type"><a href="'.$hlink.'">hypem</a></span> ';

	$tempItem->setType('hyp');
	$tempItem->setTime($date);
	$tempItem->setTimeStamp($timestamp);
	$tempItem->setContent($content);
	$allItems[]=$tempItem;
}

}



if(($use_vim == 'true' && $url_val == '') || $url_val == 'vimeo') {

$theURL = 'http://vimeo.com/api/v2/' .$vim_id. '/likes.json';
$sJson = file_get_contents($theURL);
if($sJson === false) $sJson = new_file_get_contents($theURL);
file_put_contents('/path/to/file', $sJson);
$oJson = json_decode($sJson);
//var_dump($oJson);

$vimMax = $maxitems;
if($vimMax > 20) $vimMax = 20;

for($i=0; $i < $vimMax; $i++) {
	
	$item = $oJson[$i];
	//var_dump($item);
	$artist = $item->{'user_name'};
	$title = $item->{'title'};
	$timestamp = strtotime($item->{'liked_on'}) - 60*60*4;
	$date = date('r',$timestamp);
	$link = $item->{'url'};
	$imgurl = $item->{'thumbnail_medium'};
	

	$tempItem = new evStream_Item();
	$tempItem->setId($counter);
	$counter++;

	$content = '';
	$content = '<a href="'.$link.'"><img src="'.$imgurl.'" title="'.$title.'" class="evStream_vim_img"></a> <span class="evStream_title">'.$title.'</span> ';
	$content .= ' <span class="evStream_text">by '.$artist.'</span> ';
	$content .= '<span class="evStream_type"><a href="http://www.vimeo.com/'.$vim_id.'/likes">VIMEO</a></span> ';

	$tempItem->setType('vim');
	$tempItem->setTime($date);
	$tempItem->setTimeStamp($timestamp);
	$tempItem->setContent($content);
	$allItems[]=$tempItem;
}

}





if(($use_vis == 'true' && $url_val == '') || $url_val == 'vis') {
	// get the VI.SUALIZE.US feed
	$rss_url = 'http://vi.sualize.us/rss/' . $vis_id . '/' . $vis_tag . '/';

	$rss = fetch_rss($rss_url);

	$items = array_slice($rss->items, 0, $maxitems);

	foreach($items as $item) {
		$tempItem = new evStream_Item();
		$tempItem->setId($counter);
		$counter++;

		

		$pattern1 = '@<a href="([^"]*)">via</a>@i';
		if(preg_match( $pattern1, $item['description'], $match)) {
			$oUrl = $match[1];
		}

		$pattern2 = '@<img src="([^"]*)"/>@i';
		if(preg_match( $pattern2, $item['description'], $match)) {
			$thumbUrl = $match[1];
		}

		$pattern3 = '@<img src="([^"]*)"/>@i';
		if(preg_match( $pattern2, $item['description'], $match)) {
			$imgUrl = $match[1];
		}

		$timestamp = strtotime($item['pubdate']) - 60*60*4;
		$pubdate = date('r',$timestamp);
		$title = $item['title'];
		$link = $item['link'];
		$tagline = $item['guid'];
		$tagline2 = explode(":", $tagline);
		$tags = explode(", ",$tagline2[1]);

	 	?>


		<?php

		$content = '<a href="'.$oUrl.'"><img src="'.$thumbUrl.'" title="'.$title.'" class="evStream_vis_img"></a> ';
		$content .= '<span class="evStream_title">'.$title.'</span> ';
		$content .= '<div class="evStream_tags"><ul> ';
			$tagA = array_slice($tags, 0, 20);
			foreach($tagA as $key => $tag) {
				if (($key +1) == count($tagA)) {
					$content .= '<li>'.$tag.'</li> ';
				} else {
					$content .= '<li>'.$tag.' | '.'</li> ';
				}
			}
		$content .= '</ul></div> ';
		$content .= '<span class="evStream_type"><a href="'.$link.'">vi.sualize.us</a></span> ';

		$tempItem->setType('vis');
		$tempItem->setTime($pubdate);
		$tempItem->setContent($content);
		$tempItem->setTimeStamp($timestamp);
		$allItems[]=$tempItem;
	}

}




if(($use_fli == 'true' && $url_val == '') || $url_val == 'fli') {
	// get the FLICKR feed

	$rss_url = 'https://api.flickr.com/services/feeds/photos_public.gne?id='.$fli_id.'&format=rss_200';
	$rss = fetch_rss($rss_url);
	$items = array_slice($rss->items, 0, $maxitems);

	foreach($items as $item) {

		$tempItem = new evStream_Item();
		$tempItem->setId($counter);
		$counter++;

		$title = $item['title'];
		$link = $item['link'];

		preg_match_all("/<IMG.+?SRC=[\"']([^\"']+)/si",$item[ 'description' ],$sub,PREG_SET_ORDER);
		$thumbUrl = str_replace( "_m.jpg", "_m.jpg", $sub[0][1] );

		$timestamp = strtotime($item['pubdate']) - 60*60*4;
		$pubdate = date('r',$timestamp);

		$flickrlink = 'https://www.flickr.com/photos/' .$fli_id;

		$content = '<a href="'.$link.'"><img src="'.$thumbUrl.'" title="'.$title.'" class="evStream_fli_img"></a> ';
		$content .= '<span class="evStream_title">'.$title.'</span> ';
		$content .= '<span class="evStream_type"><a href="'.$flickrlink.'">flickr</a></span> ';

		$tempItem->setType('fli');
		$tempItem->setTime($pubdate);
		$tempItem->setContent($content);
		$tempItem->setTimeStamp($timestamp);
		$allItems[]=$tempItem;
	}

}





if(($use_del == 'true' && $url_val == '') || $url_val == 'del') {

// get the DEL.ICIO.US feed
$rss_url = 'http://feeds.delicious.com/v2/rss/' . $del_id . '?count=' . $maxitems;

$rss = fetch_rss($rss_url);

$items = array_slice($rss->items, 0, $maxitems, TRUE);


foreach($items as $item) {
	$tempItem = new evStream_Item();
	$tempItem->setId($counter);
	$counter++;

	$title = $item['title'];
	$link = $item['link'];
	$description = $item['description'];


	$content = '<span class="evStream_title"><a href="'.$link.'">'.$title.'</a></span> ';
	$content .= ' <span class="evStream_text">'.$description.'</span> ';

	
	$content .= '<span class="evStream_type"><a href="http://del.icio.us/'.$del_id.'">del.icio.us</a></span> ';

	$time = strtotime($item['pubdate'])  - 60*60*4;
	$tempItem->setType('del');
	$tempItem->setTime(substr(date('r',$time),0,25));
	$tempItem->setContent($content);
	$tempItem->setTimeStamp($time);

	$allItems[]=$tempItem;
}


}




if(($use_enj == 'true' && $url_val == '') || $url_val == 'enj') {

	// get the ENJOYTHIN.GS feed
	$rss_url = 'http://' . $enj_id . '.enjoysthin.gs/things.xml';

	$rss = fetch_rss($rss_url);

	$items = array_slice($rss->items, 0, $maxitems, TRUE);


	foreach($items as $item) {
		$tempItem = new evStream_Item();
		$tempItem->setId($counter);
		$counter++;

		$title = $item['title'];
		$link = $item['link'];
		
		$description = '';


		$content = '<span class="evStream_title"><a href="'.$link.'">&#171; '.$title.' &#187;</a></span> ';
		$content .= ' <span class="evStream_text">'.$description.'</span> ';

		
		$content .= '<span class="evStream_type"><a href="http://'.$enj_id.'.enjoysthin.gs">enjoysthin.gs</a></span> ';

		$time = strtotime($item['published'])  - 60*60*4;
		$tempItem->setType('enj');
		$tempItem->setTime(substr(date('r',$time),0,25));
		$tempItem->setContent($content);
		$tempItem->setTimeStamp($time);

		$allItems[]=$tempItem;
	}
}




if(($use_twi == 'true' && $url_val == '') || $url_val == 'twi') {

	require_once('twitteroauth.php');
	// get the TWITTER feed
	// $rss_url = 'https://twitter.com/statuses/user_timeline/' . $twi_id . '.rss';
	$connection = new TwitterOAuth($twi_key, $twi_secret);
	$tweets_json = $connection->get('https://api.twitter.com/1.1/statuses/user_timeline.json', array('screen_name'=>$twi_id, 'count'=>$maxitems, 'include_rts'=>false));

	foreach($tweets_json as $item) {

		$tempItem = new evStream_Item();
		$tempItem->setId($counter);
		$counter++;

		$title = $item->text;
		// take away username from title:
		// $title = substr($fulltitle, strlen($twi_id) + 1);
		$link = 'http://www.twitter.com/'.$twi_id.'/status/'.$item->id_str;
		
		$description = '';


		$content = '<span class="evStream_title"><a href="'.$link.'">'.$title.'</a></span> ';
		$content .= ' <span class="evStream_text">'.$description.'</span> ';

		
		$content .= '<span class="evStream_type"><a href="http://www.twitter.com/'.$twi_id.'">twitter</a></span> ';

		$timestamp = strtotime($item->created_at) - 60*60*4;
		$pubdate = date('r',$timestamp);
		$tempItem->setType('twi');
		$tempItem->setTime($pubdate);
		$tempItem->setContent($content);
		$tempItem->setTimeStamp($timestamp);

		$allItems[]=$tempItem;
	}
}






if(($use_sco == 'true' && $url_val == '') || $url_val == 'sco') {

// get the TWITTER feed
$rss_url = 'http://www.scoop.it/t/' . $sco_id . '/rss.xml';

$rss = fetch_rss($rss_url);

$items = array_slice($rss->items, 0, $maxitems, TRUE);


foreach($items as $item) {
	$tempItem = new evStream_Item();
	$tempItem->setId($counter);
	$counter++;

	$title = $item['title'];
	$link = $item['link'];
	
	$description = $item['description'];


	$content = '<span class="evStream_title"><a href="'.$link.'">'.$title.'</a></span> ';
	$content .= ' <span class="evStream_text">'.$description.'</span> ';

	
	$content .= '<span class="evStream_type"><a href="http://www.scoop.it/t/'.$sco_id.'">scoop.it</a></span> ';

	$timestamp = strtotime($item['pubdate']) - 60*60*4;
	$pubdate = date('r',$timestamp);
	$tempItem->setType('sco');
	$tempItem->setTime($pubdate);
	$tempItem->setContent($content);
	$tempItem->setTimeStamp($timestamp);

	$allItems[]=$tempItem;
}
}





if(($use_git == 'true' && $url_val == '') || $url_val == 'git') {

// get the TWITTER feed
$rss_url = 'https://github.com/' . $git_id . '.atom';

$rss = fetch_rss($rss_url);

$items = array_slice($rss->items, 0, $maxitems, TRUE);


foreach($items as $item) {
	$tempItem = new evStream_Item();
	$tempItem->setId($counter);
	$counter++;

	$title = $item['title'];
	$link = $item['link'];
	
	$description = '';


	$content = '<span class="evStream_title"><a href="'.$link.'">'.$title.'</a></span> ';
	$content .= ' <span class="evStream_text">'.$description.'</span> ';

	
	$content .= '<span class="evStream_type"><a href="http://github.com/'.$git_id.'">github</a></span> ';

	$timestamp = strtotime($item['published']) - 60*60*4;
	$pubdate = date('r',$timestamp);
	$tempItem->setType('git');
	$tempItem->setTime($pubdate);
	$tempItem->setContent($content);
	$tempItem->setTimeStamp($timestamp);

	$allItems[]=$tempItem;
}
}






if(($use_wp == 'true' && $url_val == '') || $url_val != '') {

$WPposts = new WP_Query('category_name='.$owncat.'&showposts=40'); 

while($WPposts->have_posts()) : $WPposts->the_post();
	
	$tempItem = new evStream_Item();
	$tempItem->setId($counter);
	$counter++;
	
	$content = ' <span class="evStream_title">'.get_the_title().'</span> ';

	$content .= ' <span class="evStream_text">'.get_the_content().'</span> ';
	$content .= '<span class="evStream_editLink"><a href="'.get_edit_post_link().'">edit</a></span> ';

	
	$type = 'default';
	$tempItem->setType('default');
	$custom_field_keys = get_post_custom_keys();
	foreach ( $custom_field_keys as $key => $value ) {
    		$valuet = trim($value);
      			if ( '_' == $valuet{0} )
      			continue;
    		if($value == 'streamLine') {
			$streamLine_value = get_post_meta(get_the_ID(), 'streamLine',true);
			$type = $streamLine_value;
			$tempItem->setType($type);
			
		}
  	}

	$content .= ' <span class="evStream_type"><a href="';

	$content .= $pageLink.'?stream='.$type;
	$content .= '">wp | '.$owncat;
	if($type != 'default') $content .= ' | '.$type;
	$content .= '</a></span> ';


	$tempItem->setContent($content);
	$tempItem->setTimeStamp(strtotime(get_the_time('r')));
	$tempItem->setTime(get_the_time('r'));

	if($url_val=='' | $url_val=='default' | $url_val==$type) $allItems[]=$tempItem;

endwhile; 

}

foreach ($allItems as $key => $row) {
    $orderByDate[$key]  = $row->timestamp;
}

array_multisort($orderByDate, SORT_DESC, $allItems);

?>
<div class='evStream_column'>
<?php

for($i=0; $i<$maxitems && $i<sizeOf($allItems); $i+=4) {
	$item = $allItems[$i];
	echo '<div class="evStream_item evStream_item_'.$item->type.'">'.$item->content;
	echo ' <span class="evStream_time">'.substr($item->time,0,25).'</span>';
	echo ' </div>';
}
?>
</div>
<div class='evStream_column'>
<?php

for($i=1; $i<$maxitems && $i<sizeOf($allItems); $i+=4) {
	$item = $allItems[$i];
	echo '<div class="evStream_item evStream_item_'.$item->type.'">'.$item->content;
	echo ' <span class="evStream_time">'.substr($item->time,0,25).'</span>';
	echo ' </div>';
}
?>
</div>
<div class='evStream_column'>
<?php

for($i=2; $i<$maxitems && $i<sizeOf($allItems); $i+=4) {
	$item = $allItems[$i];
	echo '<div class="evStream_item evStream_item_'.$item->type.'">'.$item->content;
	echo ' <span class="evStream_time">'.substr($item->time,0,25).'</span>';
	echo ' </div>';
}
?>
</div>
<div class='evStream_column'>
<?php

for($i=3; $i<$maxitems && $i<sizeOf($allItems); $i+=4) {
	$item = $allItems[$i];
	echo '<div class="evStream_item evStream_item_'.$item->type.'">'.$item->content;
	echo ' <span class="evStream_time">'.substr($item->time,0,25).'</span>';
	echo ' </div>';
}
?>
</div>
<?php



?>