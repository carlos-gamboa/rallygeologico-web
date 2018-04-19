<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Competition $competition
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Competition'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="competition form large-9 medium-8 columns content">
    <?= $this->Form->create($competition) ?>
    <fieldset>
        <legend><?= __('Add Competition') ?></legend>
        <?php
            echo $this->Form->control('IsActive');
            echo $this->Form->control('StartingDate', ['empty' => true]);
            echo $this->Form->control('FinishingDate', ['empty' => true]);
            echo $this->Form->control('IsPublic');
            echo $this->Form->control('Name');
            echo $this->Form->control('RallyId');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
