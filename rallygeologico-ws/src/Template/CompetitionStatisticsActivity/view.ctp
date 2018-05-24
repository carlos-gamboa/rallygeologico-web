<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionStatisticsActivity $competitionStatisticsActivity
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Competition Statistics Activity'), ['action' => 'edit', $competitionStatisticsActivity->competition_statistics_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Competition Statistics Activity'), ['action' => 'delete', $competitionStatisticsActivity->competition_statistics_id], ['confirm' => __('Are you sure you want to delete # {0}?', $competitionStatisticsActivity->competition_statistics_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Competition Statistics Activity'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition Statistics Activity'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Competition Statistics'), ['controller' => 'CompetitionStatistics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition Statistic'), ['controller' => 'CompetitionStatistics', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activity'), ['controller' => 'Activity', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="competitionStatisticsActivity view large-9 medium-8 columns content">
    <h3><?= h($competitionStatisticsActivity->competition_statistics_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Competition Statistic') ?></th>
            <td><?= $competitionStatisticsActivity->has('competition_statistic') ? $this->Html->link($competitionStatisticsActivity->competition_statistic->id, ['controller' => 'CompetitionStatistics', 'action' => 'view', $competitionStatisticsActivity->competition_statistic->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activity') ?></th>
            <td><?= $competitionStatisticsActivity->has('activity') ? $this->Html->link($competitionStatisticsActivity->activity->id, ['controller' => 'Activity', 'action' => 'view', $competitionStatisticsActivity->activity->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Points Obtained') ?></th>
            <td><?= $this->Number->format($competitionStatisticsActivity->points_obtained) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Resolved Date') ?></th>
            <td><?= h($competitionStatisticsActivity->resolved_date) ?></td>
        </tr>
    </table>
</div>
