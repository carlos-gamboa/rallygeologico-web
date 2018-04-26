<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rally $rally
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Rally'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Competition'), ['controller' => 'Competition', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Competition'), ['controller' => 'Competition', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rally form large-9 medium-8 columns content">
    <?= $this->Form->create($rally) ?>
    <fieldset>
        <legend><?= __('Add Rally') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('points_awarded');
            echo $this->Form->control('image_url');
            echo $this->Form->control('description');
            echo $this->Form->control('site._ids', ['options' => $site]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
