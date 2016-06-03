<div>
    <a href="<?php echo ROOT_PATH;?>/Shares/add" class="btn btn-success btn-share">Share Something</a>
    <?php foreach ($viewmodel as $item): ?>
        <div class="well">
            <h3>
                <?php
                echo $item['title'];
                ?>
            </h3>
        </div>
    <?php endforeach; ?>
</div>