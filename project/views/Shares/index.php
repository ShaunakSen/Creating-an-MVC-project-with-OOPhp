<div>
    <a href="<?php echo ROOT_URL;?>/Shares/add" class="btn btn-success btn-share">Share Something</a>
    <br/><br/>
    <?php foreach ($viewmodel as $item): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong><?php echo $item['title'] ?></strong>
                <br/>
                <small><?php echo $item['create_date'] ?></small>
            </div>
            <div class="panel-body">
                <?php echo $item['body'] ?>
            </div>
            <div class="panel-footer">
                <a href="<?php echo $item['link'] ?>" class="btn btn-default" target="_blank">Visit Website</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>