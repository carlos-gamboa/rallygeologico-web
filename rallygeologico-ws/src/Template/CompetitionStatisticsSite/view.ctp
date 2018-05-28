<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionStatisticsSite $competitionStatisticsSite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Competition Statistics Site'), ['action' => 'edit', $competitionStatisticsSite->competition_statistics_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Competition Statistics Site'), ['action' => 'delete', $competitionStatisticsSite->competition_statistics_id], ['confirm' => __('Are you sure you want to delete # {0}?', $competitionStatisticsSite->competition_statistics_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Competition Statistics Site'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition Statistics Site'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Competition Statistics'), ['controller' => 'CompetitionStatistics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition Statistic'), ['controller' => 'CompetitionStatistics', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="competitionStatisticsSite view large-9 medium-8 columns content">
    <h3><?= h($competitionStatisticsSite->user_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Competition Statistic') ?></th>
            <td><?= $competitionStatisticsSite->has('competition_statistic') ? $this->Html->link($competitionStatisticsSite->competition_statistic->id, ['controller' => 'CompetitionStatistics', 'action' => 'view', $competitionStatisticsSite->competition_statistic->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Site') ?></th>
            <td><?= $competitionStatisticsSite->has('site') ? $this->Html->link($competitionStatisticsSite->site->name, ['controller' => 'Site', 'action' => 'view', $competitionStatisticsSite->site->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Visited Date') ?></th>
            <td><?= h($competitionStatisticsSite->visited_date) ?></td>
        </tr>
    </table>
</div>
