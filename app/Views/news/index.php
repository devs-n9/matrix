<div>
    <h3>News Page</h3>
    <p>This is news index page</p>

    <?php foreach($news as $n): ?>
        <h4>
            <a href="/news/id/<?php echo $n->id; ?>">
                <?php echo $n->title; ?>
            </a>
        </h4>
        <p><?php echo $n->content; ?></p>
    <?php endforeach; ?>
</div>