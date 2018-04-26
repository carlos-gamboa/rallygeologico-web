<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionStatisticsSite[]|\Cake\Collection\CollectionInterface $competitionStatisticsSite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Competition Statistics Site'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Competition Statistics'), ['controller' => 'CompetitionStatistics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Competition Statistic'), ['controller' => 'CompetitionStatistics', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="competitionStatisticsSite index large-9 medium-8 columns content">
    <h3><?= __('Competition Statistics Site') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('competition_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('site_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($competitionStatisticsSite as $competitionStatisticsSite): ?>
            <tr>
                <td><?= $competitionStatisticsSite->has('user') ? $this->Html->link($competitionStatisticsSite->user->id, ['controller' => 'Users', 'action' => 'view', $competitionStatisticsSite->user->id]) : '' ?></td>
                <td><?= $competitionStatisticsSite->has('competition_statistic') ? $this->Html->link($competitionStatisticsSite->competition_statistic->user_id, ['controller' => 'CompetitionStatistics', 'action' => 'view', $competitionStatisticsSite->competition_statistic->user_id]) : '' ?></td>
                <td><?= $competitionStatisticsSite->has('site') ? $this->Html->link($competitionStatisticsSite->site->name, ['controller' => 'Site', 'action' => 'view', $competitionStatisticsSite->site->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $competitionStatisticsSite->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $competitionStatisticsSite->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $competitionStatisticsSite->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $competitionStatisticsSite->user_id)]) ?>
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
