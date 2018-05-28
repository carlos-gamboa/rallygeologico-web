<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Multimedia $multimedia
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $multimedia->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $multimedia->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Multimedia'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Activity'), ['controller' => 'Activity', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Term'), ['controller' => 'Term', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Term', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="multimedia form large-9 medium-8 columns content">
    <?= $this->Form->create($multimedia) ?>
    <fieldset>
        <legend><?= __('Edit Multimedia') ?></legend>
        <?php
            echo $this->Form->control('media_type');
            echo $this->Form->control('media_url');
            echo $this->Form->control('name');
            echo $this->Form->control('activity._ids', ['options' => $activity]);
            echo $this->Form->control('term._ids', ['options' => $term]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
