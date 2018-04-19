<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Canton $canton
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $canton->Name],
                ['confirm' => __('Are you sure you want to delete # {0}?', $canton->Name)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Canton'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="canton form large-9 medium-8 columns content">
    <?= $this->Form->create($canton) ?>
    <fieldset>
        <legend><?= __('Edit Canton') ?></legend>
        <?php
            echo $this->Form->control('DistrictName');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
