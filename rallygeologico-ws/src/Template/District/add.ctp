<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\District $district
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List District'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="district form large-9 medium-8 columns content">
    <?= $this->Form->create($district) ?>
    <fieldset>
        <legend><?= __('Add District') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
