<div class="panel panel-default">
    <div class="panel-heading">Share your thoughts</div>
    <div class="panel-body">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label for="">Share Title</label>
                <input type="text" name="title" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="">Share Body</label>
                <textarea name="body" id="" rows="3" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="">Share Link</label>
                <input type="text" name="link" class="form-control"/>
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="Submit"/>
            <a href="<?php echo ROOT_URL ?>/Shares" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>