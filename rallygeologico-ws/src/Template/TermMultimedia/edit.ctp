<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TermMultimedia $termMultimedia
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $termMultimedia->multimedia_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $termMultimedia->multimedia_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Term Multimedia'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Term'), ['controller' => 'Term', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Term', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Multimedia'), ['controller' => 'Multimedia', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Multimedia'), ['controller' => 'Multimedia', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="termMultimedia form large-9 medium-8 columns content">
    <?= $this->Form->create($termMultimedia) ?>
    <fieldset>
        <legend><?= __('Edit Term Multimedia') ?></legend>
        <?php
            echo $this->Form->control('id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
