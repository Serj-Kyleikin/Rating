<?php

    $count = count($page[0]['static']);
    $previous = $page[0]['pagination']['previous'];
    $next = $page[0]['pagination']['next'];
?>

<div class="articles">
    <?php for($i=0; $i<$count; $i++): ?>
        <?php $article = $page[0]['static'][$i]; ?>
        <?php $rating = $page[0]['dynamic']['content'][$i]; ?>
        <div class="article" data-article="<?= $article['id']; ?>">
            <?= $article['text']; ?>
            <div class="rating">
            <div class="ratingDefault"></div>
            <div class="ratingResult" style="width: <?php echo 160 / 5 * $rating['rating'] / 100 . 'px'; ?>"></div>
            <div class="ratingVote">
                <p data-vote="1"></p>
                <p data-vote="2"></p>
                <p data-vote="3"></p>
                <p data-vote="4"></p>
                <p data-vote="5"></p>
            </div>
            <div class="voters">Проголосовало: <? echo ($rating['voters']) ? $rating['voters'] : 0; ?></div>
            <?php if(isset($rating['vote']) and $rating['vote'] != null): echo "<p class='user_vote'>Ваша оценка: " . $rating['vote'] . '</p>'; endif; ?>
        </div>
        </div>
    <?php endfor; ?>
</div>

<div class="pagination">
    <?php if(isset($previous) and $previous): echo "<a href='/" . $previous . "'>Назад</a>"; endif; ?>
    <?php if(isset($next) and $next): echo "<a href='/" . $next . "'>Вперёд</a>"; endif; ?>
</div>