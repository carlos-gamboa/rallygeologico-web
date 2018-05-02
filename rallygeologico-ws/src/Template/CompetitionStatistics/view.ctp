<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionStatistic $competitionStatistic
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Competition Statistic'), ['action' => 'edit', $competitionStatistic->user_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Competition Statistic'), ['action' => 'delete', $competitionStatistic->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $competitionStatistic->user_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Competition Statistics'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition Statistic'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Competition'), ['controller' => 'Competition', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition'), ['controller' => 'Competition', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="competitionStatistics view large-9 medium-8 columns content">
    <h3><?= h($competitionStatistic->user_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $competitionStatistic->has('user') ? $this->Html->link($competitionStatistic->user->id, ['controller' => 'Users', 'action' => 'view', $competitionStatistic->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Competition') ?></th>
            <td><?= $competitionStatistic->has('competition') ? $this->Html->link($competitionStatistic->competition->id, ['controller' => 'Competition', 'action' => 'view', $competitionStatistic->competition->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Points') ?></th>
            <td><?= $this->Number->format($competitionStatistic->points) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Starting Date') ?></th>
            <td><?= h($competitionStatistic->starting_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Finishing Date') ?></th>
            <td><?= h($competitionStatistic->finishing_date) ?></td>
        </tr>
    </table>
</div>
