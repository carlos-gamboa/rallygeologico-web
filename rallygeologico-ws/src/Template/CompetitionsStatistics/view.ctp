<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionsStatistic $competitionsStatistic
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Competitions Statistic'), ['action' => 'edit', $competitionsStatistic->FacebookId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Competitions Statistic'), ['action' => 'delete', $competitionsStatistic->FacebookId], ['confirm' => __('Are you sure you want to delete # {0}?', $competitionsStatistic->FacebookId)]) ?> </li>
        <li><?= $this->Html->link(__('List Competitions Statistics'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competitions Statistic'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="competitionsStatistics view large-9 medium-8 columns content">
    <h3><?= h($competitionsStatistic->FacebookId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('UserId') ?></th>
            <td><?= $this->Number->format($competitionsStatistic->UserId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CompetitionId') ?></th>
            <td><?= $this->Number->format($competitionsStatistic->CompetitionId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Points') ?></th>
            <td><?= $this->Number->format($competitionsStatistic->Points) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('StartingDate') ?></th>
            <td><?= h($competitionsStatistic->StartingDate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('FinishingDate') ?></th>
            <td><?= h($competitionsStatistic->FinishingDate) ?></td>
        </tr>
    </table>
</div>
