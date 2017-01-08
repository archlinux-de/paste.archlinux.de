<?php echo form_open("file/handle_history_submit") ?>
	<div class="nav-history">
		<div class="container">
			<div class="pull-right">
				<button class="btn btn-danger" name="process" value="delete">Delete checked</button>
				<button class="btn btn-primary" name="process" value="multipaste">Add checked to multipaste queue</button>
			</div>
		<?php include 'nav_history.php'; ?>
		</div>
	</div>
    <div class="table-responsive">
        <table id="upload_history" class="table table-striped tablesorter {sortlist: [[4,1]]}">
            <thead>
                <tr>
                    <th class="{sorter: false}"><input type="checkbox" name="all-ids" id="history-all"></th>
                    <th>ID</th>
                    <th>Filename</th>
                    <th>Mimetype
                    <th>Date</th>
                    <th>Size</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $key => $item): ?>
                    <tr>
                        <td><input type="checkbox" name="ids[<?php echo $item["id"] ?>]" value="<?php echo $item["id"] ?>" class="delete-history"></td>
                        <td><a href="<?php echo site_url("/".$item["id"]) ?>/" data-content="<?php if (isset($item['preview_text'])) {echo htmlentities($item['preview_text'], ENT_QUOTES);} ?>"><?php echo $item["id"] ?></a></td>
                        <td class="wrap"><?php echo htmlspecialchars($item["filename"]); ?></td>
                        <td><?php echo $item["mimetype"] ?></td>
                        <td class="nowrap" data-sort-value="<?=$item["date"]; ?>"><?php echo date("r", $item["date"]); ?></td>
                        <td><?php echo $item["filesize"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</form>

<p>Total sum of your distinct uploads: <?php echo $total_size; ?>.</p>
