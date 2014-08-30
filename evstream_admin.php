<?php 
if (isset($_POST['save_evstream_settings'])) {


	$option_no_items = $_POST['evstream_no_items'];
	update_option('evstream_no_items', $option_no_items);

	$option_use_wp = $_POST['evstream_use_wp'];
	update_option('evstream_use_wp', $option_use_wp);

	$option_evstream_owncat = $_POST['evstream_owncat'];
	update_option('evstream_owncat', $option_evstream_owncat);


	$option_use_fli= $_POST['evstream_use_fli'];
	update_option('evstream_use_fli', $option_use_fli);

	$option_fli_id = $_POST['evstream_fli_id'];
	update_option('evstream_fli_id', $option_fli_id);

	$option_use_vis = $_POST['evstream_use_vis'];
	update_option('evstream_use_vis', $option_use_vis);

	$option_vis_id = $_POST['evstream_vis_id'];
	update_option('evstream_vis_id', $option_vis_id);
	
	$option_vis_tag = $_POST['evstream_vis_tag'];
	update_option('evstream_vis_tag', $option_vis_tag);

	$option_use_del = $_POST['evstream_use_del'];
	update_option('evstream_use_del', $option_use_del);

	$option_del_id = $_POST['evstream_del_id'];
	update_option('evstream_del_id', $option_del_id);


	$option_use_hyp = $_POST['evstream_use_hyp'];
	update_option('evstream_use_hyp', $option_use_hyp);

	$option_hyp_id = $_POST['evstream_hyp_id'];
	update_option('evstream_hyp_id', $option_hyp_id);

	$option_use_vim = $_POST['evstream_use_vim'];
	update_option('evstream_use_vim', $option_use_vim);

	$option_vim_id = $_POST['evstream_vim_id'];
	update_option('evstream_vim_id', $option_vim_id);
	
	$option_use_enj = $_POST['evstream_use_enj'];
	update_option('evstream_use_enj', $option_use_enj);

	$option_enj_id = $_POST['evstream_enj_id'];
	update_option('evstream_enj_id', $option_enj_id);


	$option_use_twi = $_POST['evstream_use_twi'];
	update_option('evstream_use_twi', $option_use_twi);

	$option_twi_id = $_POST['evstream_twi_id'];
	update_option('evstream_twi_id', $option_twi_id);

	$option_twi_key = $_POST['evstream_twi_key'];
	update_option('evstream_twi_key', $option_twi_key);

	$option_twi_secret = $_POST['evstream_twi_secret'];
	update_option('evstream_twi_secret', $option_twi_secret);



	$option_use_git = $_POST['evstream_use_git'];
	update_option('evstream_use_git', $option_use_git);

	$option_git_id = $_POST['evstream_git_id'];
	update_option('evstream_git_id', $option_git_id);


	$option_use_sco = $_POST['evstream_use_sco'];
	update_option('evstream_use_sco', $option_use_sco);

	$option_sco_id = $_POST['evstream_sco_id'];
	update_option('evstream_sco_id', $option_sco_id);





  
       ?> 
<div class="updated"><p>evStream settings saved</p></div> <?php
     }

	?>



<div class="wrap">

<h2>evStream Settings</h2>

<form method="post">

<p>Number of items to display per column: <input type="text" name="evstream_no_items" value="<?php echo get_option('evstream_no_items'); ?>" size="5"> ex: 7</p>

<h3>Include own WP Posts</h3>
<p><input name="evstream_use_wp" type="checkbox" id="evstream_use_wp" value="true" <?php if(get_option('evstream_use_wp') == 'true') { echo 'checked="checked"'; } ?> />
<label for="evstream_use_wp">Activate WordPress category stream</label></p>
<p>Category Name: <input type="text" name="evstream_owncat" value="<?php echo get_option('evstream_owncat'); ?>" size="20"> ex: stream</p>
<hr />

<hr />
<h3>flickr Settings</h3>
<p><input name="evstream_use_fli" type="checkbox" id="evstream_use_fli" value="true" <?php if(get_option('evstream_use_fli') == 'true') { echo 'checked="checked"'; } ?> />
<label for="evstream_use_fli">Activate flickr stream</label></p>
<p>Username: <input type="text" name="evstream_fli_id" value="<?php echo get_option('evstream_fli_id'); ?>" size="20"> your flickr username (<a href="http://idgettr.com/">find your ID here</a>)</p>


<h3>vi.sualize.us Settings</h3>
<p><input name="evstream_use_vis" type="checkbox" id="evstream_use_vis" value="true" <?php if(get_option('evstream_use_vis') == 'true') { echo 'checked="checked"'; } ?> />
<label for="evstream_use_vis">Activate vi.sualize.us stream</label></p>
<p>Username: <input type="text" name="evstream_vis_id" value="<?php echo get_option('evstream_vis_id'); ?>" size="20"> your vi.sualize.us username</p>
<p>Tag: <input name="evstream_vis_tag" type="text" id="evstream_vis_tag" value="<?php echo get_option('evstream_vis_tag'); ?>" size="20" /> Display only images tagged with ..., leave empty to display all</p>

<hr />
<h3>del.icio.us Settings</h3>
<p><input name="evstream_use_del" type="checkbox" id="evstream_use_del" value="true" <?php if(get_option('evstream_use_del') == 'true') { echo 'checked="checked"'; } ?> />
<label for="evstream_use_del">Activate del.icio.us stream</label></p>
<p>Username: <input type="text" name="evstream_del_id" value="<?php echo get_option('evstream_del_id'); ?>" size="20"> your del.icio.us username</p>

<hr />
<h3>The Hype Machine Settings</h3>
<p><input name="evstream_use_hyp" type="checkbox" id="evstream_use_hyp" value="true" <?php if(get_option('evstream_use_hyp') == 'true') { echo 'checked="checked"'; } ?> />
<label for="evstream_use_hyp">Activate hypem stream</label></p>
<p>Username: <input type="text" name="evstream_hyp_id" value="<?php echo get_option('evstream_hyp_id'); ?>" size="20"> your hypem username</p>


<hr />
<h3>Vimeo Settings</h3>
<p><input name="evstream_use_vim" type="checkbox" id="evstream_use_vim" value="true" <?php if(get_option('evstream_use_vim') == 'true') { echo 'checked="checked"'; } ?> />
<label for="evstream_use_vim">Activate vimeo stream</label></p>
<p>Username: <input type="text" name="evstream_vim_id" value="<?php echo get_option('evstream_vim_id'); ?>" size="20"> your vimeo username</p>


<hr />
<h3>Enjoysthin.gs Settings</h3>
<p><input name="evstream_use_enj" type="checkbox" id="evstream_use_enj" value="true" <?php if(get_option('evstream_use_enj') == 'true') { echo 'checked="checked"'; } ?> />
<label for="evstream_use_enj">Activate enjoythin.gs stream</label></p>
<p>Username: <input type="text" name="evstream_enj_id" value="<?php echo get_option('evstream_enj_id'); ?>" size="20"> your enjoysthin.gs username</p>


<hr />
<h3>Twitter Settings</h3>
<p><input name="evstream_use_twi" type="checkbox" id="evstream_use_twi" value="true" <?php if(get_option('evstream_use_twi') == 'true') { echo 'checked="checked"'; } ?> />
<label for="evstream_use_twi">Activate twitter stream</label></p>
<p>Username: <input type="text" name="evstream_twi_id" value="<?php echo get_option('evstream_twi_id'); ?>" size="20"> your twitter username</p>
<p>App key: <input type="text" name="evstream_twi_key" value="<?php echo get_option('evstream_twi_key'); ?>" size="20"> your app key</p>
<p>App secret: <input type="text" name="evstream_twi_secret" value="<?php echo get_option('evstream_twi_secret'); ?>" size="20"> your app secret</p>


<hr />
<h3>Github Settings</h3>
<p><input name="evstream_use_git" type="checkbox" id="evstream_use_git" value="true" <?php if(get_option('evstream_use_git') == 'true') { echo 'checked="checked"'; } ?> />
<label for="evstream_use_git">Activate github stream</label></p>
<p>Username: <input type="text" name="evstream_git_id" value="<?php echo get_option('evstream_git_id'); ?>" size="20"> your github username</p>

<hr />
<h3>Scoop.it Settings</h3>
<p><input name="evstream_use_sco" type="checkbox" id="evstream_use_sco" value="true" <?php if(get_option('evstream_use_sco') == 'true') { echo 'checked="checked"'; } ?> />
<label for="evstream_use_sco">Activate scoop.it topic stream</label></p>
<p>Topic: <input type="text" name="evstream_sco_id" value="<?php echo get_option('evstream_sco_id'); ?>" size="20"> your scoop.it topic name</p>


<hr />
<p class="submit">
<input type="submit" name="save_evstream_settings" value="<?php _e('Save Settings', 'save_evstream_settings' ) ?>" />
</p>

</form>


</div>
	