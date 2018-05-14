<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionStatisticsSite $competitionStatisticsSite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Competition Statistics Site'), ['action' => 'edit', $competitionStatisticsSite->user_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Competition Statistics Site'), ['action' => 'delete', $competitionStatisticsSite->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $competitionStatisticsSite->user_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Competition Statistics Site'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition Statistics Site'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
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
            <th scope="row"><?= __('Site') ?></th>
            <td><?= $competitionStatisticsSite->has('site') ? $this->Html->link($competitionStatisticsSite->site->name, ['controller' => 'Site', 'action' => 'view', $competitionStatisticsSite->site->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Competition Statistics Id') ?></th>
            <td><?= $this->Number->format($competitionStatisticsSite->competition_statistics_id) ?></td>
        </tr>
    </table>
</div>
