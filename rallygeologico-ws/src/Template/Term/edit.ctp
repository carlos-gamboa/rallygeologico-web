<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Term $term
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $term->TermID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $term->TermID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Term'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="term form large-9 medium-8 columns content">
    <?= $this->Form->create($term) ?>
    <fieldset>
        <legend><?= __('Edit Term') ?></legend>
        <?php
            echo $this->Form->control('ImageUrl');
            echo $this->Form->control('VideoUrl');
            echo $this->Form->control('Name');
            echo $this->Form->control('Description');
            echo $this->Form->control('site._ids', ['options' => $site]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
