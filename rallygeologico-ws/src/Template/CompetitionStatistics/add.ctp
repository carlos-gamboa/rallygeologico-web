<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionStatistic $competitionStatistic
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Competition Statistics'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Competition'), ['controller' => 'Competition', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Competition'), ['controller' => 'Competition', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="competitionStatistics form large-9 medium-8 columns content">
    <?= $this->Form->create($competitionStatistic) ?>
    <fieldset>
        <legend><?= __('Add Competition Statistic') ?></legend>
        <?php
            echo $this->Form->control('starting_date', ['empty' => true]);
            echo $this->Form->control('finishing_date', ['empty' => true]);
            echo $this->Form->control('points');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
