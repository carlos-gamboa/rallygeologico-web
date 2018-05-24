<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionStatisticsActivity $competitionStatisticsActivity
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $competitionStatisticsActivity->competition_statistics_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $competitionStatisticsActivity->competition_statistics_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Competition Statistics Activity'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Competition Statistics'), ['controller' => 'CompetitionStatistics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Competition Statistic'), ['controller' => 'CompetitionStatistics', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Activity'), ['controller' => 'Activity', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="competitionStatisticsActivity form large-9 medium-8 columns content">
    <?= $this->Form->create($competitionStatisticsActivity) ?>
    <fieldset>
        <legend><?= __('Edit Competition Statistics Activity') ?></legend>
        <?php
            echo $this->Form->control('resolved_date', ['empty' => true]);
            echo $this->Form->control('points_obtained');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
