<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RallySite $rallySite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rallySite->rally_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rallySite->rally_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Rally Site'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Rally'), ['controller' => 'Rally', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rally'), ['controller' => 'Rally', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rallySite form large-9 medium-8 columns content">
    <?= $this->Form->create($rallySite) ?>
    <fieldset>
        <legend><?= __('Edit Rally Site') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
