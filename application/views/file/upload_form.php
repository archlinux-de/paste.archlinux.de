<div style="margin-top: 100px; text-align:center">
  <?php echo form_open_multipart('file/do_upload'); ?>
    <p>
      File: <input type="file" id="file" name="file" size="30" />
      <input type="submit" value="Upload" id="upload_button" name="process" /><br />
      Optional password (for deletion and search): <input type="password" name="password" size="10" />
    </p>
  </form>
  <script type="text/javascript">
    /* <![CDATA[ */
document.write('\
  <p><b>OR</b></p>\
  <form action="javascript: do_paste()">\
    <p>\
      <textarea id="textarea" name="content" cols="80" rows="20"></textarea><br />\
      <div style="display: none">Email: <input type="text" name="email" size="20" /></div>\
      Optional password (for deletion and search): <input id="textarea_password" type="password" name="password" size="10" /><br />\
      <input  type="submit" value="Paste" name="process" />\
    </p>\
    </form>\
');
  var upload_url = "<?php echo site_url("file/do_upload/dumb"); ?>";
  var max_upload_size = "<?php echo $max_upload_size; ?>";
    /* ]]> */
  </script>
  <script type="text/javascript" src="<?php echo base_url(); ?>data/js/upload_form.js?<?php echo filemtime(FCPATH."/data/js/upload_form.js"); ?>"></script>
</div>
<br />
<p>Uploads/pastes are deleted after <?php echo $upload_max_age; ?> days<?php if($small_upload_size > 0): ?>
  unless they are smaller than <?php echo format_bytes($small_upload_size); ?>
  <?php endif; ?>. Maximum upload size is <?php echo format_bytes($max_upload_size); ?></p>
<p><h2>Features</h2></p>
<p>For shell uploading/pasting and download information for the client go to <a href="<?php echo site_url("file/client"); ?>"><?php echo site_url("file/client"); ?></a></p>
<p>You can use the <?php echo anchor("file/upload_history", "history"); ?> to find old uploads using the password supplied when creating the upload.</p>
<p>How to link your pastes:</p>
<ul>
	<li><span class="example">/&lt;ID&gt;/</span> automatically highlight the paste</li>
	<li><span class="example">/&lt;ID&gt;</span> set the detected MIME type and let the browser do the rest</li>
	<li><span class="example">/&lt;ID&gt;/plain</span> force the MIME type to be text/plain</li>
	<li><span class="example">/&lt;ID&gt;/&lt;file extension&gt;</span> override auto detection and use the supplied file extension or language name for highlighting</li>
	<li><span class="example">/&lt;ID&gt;/qr</span> display a qr code containing a link to <span class="example">/&lt;ID&gt;/</span></li>
	<li><span class="example">/&lt;ID&gt;/rmd</span> convert markdown to HTML</li>
	<li><span class="example">/&lt;ID&gt;/ascii</span> convert text with ANSI (shell) escape codes to HTML</li>
</ul>
<p>If your upload is not detected as text, only <span class="example">/&lt;ID&gt;/qr</span> and <span class="example">/&lt;ID&gt;/plain</span> will work as above and all others will simply return the file with the detected MIME type.</p>
<br />
<?php if($contact_me_url) {?><p>If you experience any problems feel free to <a href="<?php echo $contact_me_url; ?>">contact me</a>.</p>
<br /><?php }; ?>
<div class="small">
  <p>Icons by <a href="http://p.yusukekamiyamane.com/">Yusuke Kamiyamane</a></p>
  <p>This service is provided without warranty of any kind and may not be used to distribute copyrighted content.</p>
</div>
