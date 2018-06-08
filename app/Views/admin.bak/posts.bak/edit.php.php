<form method="post">
    <?= $form->input('title', 'Titre de l\'article'); ?>
    <?= $form->input('text', 'Content', ['type' => 'textarea']); ?>
    <?= $form->select('category_id', 'Catégorie', $categories); ?>
    <?= $form->submit('Save');?>
</form>
