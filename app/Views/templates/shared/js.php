<?php if (isset($res)) : ?>
    <?php if (array_key_exists('js', $res)) : ?>
        <?php foreach ($res['js'] as $filename) : ?>
            <script src="/js/<?= $filename; ?>"></script>
        <?php endforeach; ?>
    <?php endif ?>
<?php endif ?>