<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rally $rally
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rally->RallyId],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rally->RallyId)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Rally'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rally form large-9 medium-8 columns content">
    <?= $this->Form->create($rally) ?>
    <fieldset>
        <legend><?= __('Edit Rally') ?></legend>
        <?php
            echo $this->Form->control('Name');
            echo $this->Form->control('PointsAwarded');
            echo $this->Form->control('ImageUrl');
            echo $this->Form->control('Description');
            echo $this->Form->control('site._ids', ['options' => $site]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
