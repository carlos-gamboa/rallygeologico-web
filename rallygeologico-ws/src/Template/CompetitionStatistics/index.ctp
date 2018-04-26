<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionStatistic[]|\Cake\Collection\CollectionInterface $competitionStatistics
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Competition Statistic'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Competition'), ['controller' => 'Competition', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Competition'), ['controller' => 'Competition', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="competitionStatistics index large-9 medium-8 columns content">
    <h3><?= __('Competition Statistics') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('competition_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('starting_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('finishing_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('points') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($competitionStatistics as $competitionStatistic): ?>
            <tr>
                <td><?= $competitionStatistic->has('user') ? $this->Html->link($competitionStatistic->user->id, ['controller' => 'Users', 'action' => 'view', $competitionStatistic->user->id]) : '' ?></td>
                <td><?= $competitionStatistic->has('competition') ? $this->Html->link($competitionStatistic->competition->id, ['controller' => 'Competition', 'action' => 'view', $competitionStatistic->competition->id]) : '' ?></td>
                <td><?= h($competitionStatistic->starting_date) ?></td>
                <td><?= h($competitionStatistic->finishing_date) ?></td>
                <td><?= $this->Number->format($competitionStatistic->points) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $competitionStatistic->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $competitionStatistic->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $competitionStatistic->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $competitionStatistic->user_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
