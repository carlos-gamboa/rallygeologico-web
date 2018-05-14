<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Canton $canton
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Canton'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Province'), ['controller' => 'Province', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Province'), ['controller' => 'Province', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List District'), ['controller' => 'District', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New District'), ['controller' => 'District', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="canton form large-9 medium-8 columns content">
    <?= $this->Form->create($canton) ?>
    <fieldset>
        <legend><?= __('Add Canton') ?></legend>
        <?php
            echo $this->Form->control('province_id', ['options' => $province]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
