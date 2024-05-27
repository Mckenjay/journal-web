<div class="uk-container uk-margin-small-top">
    <div class="uk-margin-medium-top" uk-grid>
        <div class="uk-width-1">
            <div class="uk-container">
                <div class="uk-grid-small uk-child-width-expand@s" uk-grid>
                    <?php foreach ($articles as $article) : ?>
                        <div class="uk-width-1-4">
                            <a href="<?= base_url('./uploads/'.$article['filename']); ?>" target="_blank" class="uk-display-block uk-card uk-card-body uk-card-default uk-link-toggle uk-width-medium">
                                <h3 class="uk-card-title"><span class="uk-link-heading"><?= strlen($article['title']) > 50? substr($article['title'], 0, 50).'...' : $article['abstract']?></span></h3>
                                <p><?= strlen($article['abstract']) > 200? substr($article['abstract'], 0, 200).'...' : $article['abstract']?></p>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>