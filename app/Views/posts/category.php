<h1><?= $category->name ?></h1>

<div class="row">
    <div class="col-sm-8">
        <?php foreach ($articles as $article): ?>
            <h2><a href="<?= $article->url ?>"><?= $article->title; ?></a></h2>

            <p><em><?= $article->category; ?></em></p>

            <p><?= $article->extrait; ?></p>
        <?php endforeach; ?>
    </div>

    <div class="div-col-sm-4">
        <ul>
            <?php foreach($categories as $category): ?>
                <li><a href="<?= $category->url; ?>"><?= $category->name; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
