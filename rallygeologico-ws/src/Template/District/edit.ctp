<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\District $district
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $district->Name],
                ['confirm' => __('Are you sure you want to delete # {0}?', $district->Name)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List District'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="district form large-9 medium-8 columns content">
    <?= $this->Form->create($district) ?>
    <fieldset>
        <legend><?= __('Edit District') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
