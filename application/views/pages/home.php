<div class="uk-container uk-margin-medium-top">
    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
        <div class="uk-flex-last@s uk-card-media-right uk-cover-container">
            <img src="<?= base_url('assets/img/light.jpg') ?>" alt="" uk-cover>
            <canvas width="600" height="400"></canvas>
        </div>
        <div>
            <div class="uk-card-body">
                <h3 class="uk-card-title" style="color: #437EF7; font-size: 40px; font-weight: bold;">About</h3>
                <p>The Journal of Science is a peer-reviewed multidisciplinary journal that publishes research articles in natural sciences, mathematics, engineering, and social sciences from various contributors. It accepts original research articles, short communications, technical notes, review articles, and perspectives across all disciplines. The journal follows ethical and scientific publishing standards, and is open-access.</p>
            </div>
        </div>
    </div>
    <div class="uk-margin-medium-top" uk-grid>
        <div class="uk-width-3-4">
            <div class="uk-card uk-card-default uk-card-body">
                <?php foreach ($volumes as $volume) : ?>
                    <h2><?= $volume['vol_name'] ?></h2>
                    <p><?= $volume['description'] ?></p>
                    <?php foreach ($volume['articles'] as $article) : ?>
                        <div class="uk-background-muted uk-padding uk-panel uk-margin-medium-top">
                            <!-- <div class="uk-card-badge uk-label">Badge</div> -->
                            <img class="uk-align-left uk-margin-remove-adjacent" src="<?= base_url('assets/images/volumes/'. $volume['coverImg']) ?>" width="225" height="200" alt="Example image">
                            <h1 class="uk-margin-medium-top uk-margin-small-bottom" style="font-family: Poppins; font-size: 16px; font-weight: bold;"><?= $article['title'] ?></h1>
                            <p><?= strlen($article['abstract']) > 230? substr($article['abstract'], 0, 230).'...' : $article['abstract']?></p>
                            <p class="uk-text-small">Author(s): <span style="font-style: italic;"><?= $article['author_names'] ?></span></p>
                            <p class="uk-text-small uk-link-muted">doi: <a href="<?= base_url('./uploads/'.$article['filename']); ?>" target="_blank" style="font-style: italic;"><?= $article['doi'] ?></a></p>
                            <!-- <p class="uk-text-small"><?= $article['date_published'] ?></p> -->

                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="uk-width-1-4">
            <div class="uk-card uk-card-default uk-card-body uk-background-muted">
                <div class="uk-container uk-margin-small-bottom">
                   <h3 style="color: #437EF7; font-size: 20px; font-weight: bold;">Announcement</h3>
                   <div>
                        <ul class="uk-list uk-list-disc">
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                        </ul>
                    </div>
                </div>
                <div class="uk-container uk-margin-small-bottom uk-margin-medium-top">
                <h3 style="color: #437EF7; font-size: 20px; font-weight: bold;">Volumes</h3>
                <table class="uk-table uk-table-hover uk-table-divider">
                    <tbody>
                        <?php foreach ($volumes as $volume) : ?>
                            <tr>
                                <td><?= $volume['vol_name'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>