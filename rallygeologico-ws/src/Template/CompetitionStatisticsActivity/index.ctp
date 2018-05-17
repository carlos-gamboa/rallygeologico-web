<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionStatisticsActivity[]|\Cake\Collection\CollectionInterface $competitionStatisticsActivity
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Competition Statistics Activity'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Competition Statistics'), ['controller' => 'CompetitionStatistics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Competition Statistic'), ['controller' => 'CompetitionStatistics', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Activity'), ['controller' => 'Activity', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="competitionStatisticsActivity index large-9 medium-8 columns content">
    <h3><?= __('Competition Statistics Activity') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('competition_statistics_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('activity_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($competitionStatisticsActivity as $competitionStatisticsActivity): ?>
            <tr>
                <td><?= $competitionStatisticsActivity->has('competition_statistic') ? $this->Html->link($competitionStatisticsActivity->competition_statistic->id, ['controller' => 'CompetitionStatistics', 'action' => 'view', $competitionStatisticsActivity->competition_statistic->id]) : '' ?></td>
                <td><?= $competitionStatisticsActivity->has('activity') ? $this->Html->link($competitionStatisticsActivity->activity->id, ['controller' => 'Activity', 'action' => 'view', $competitionStatisticsActivity->activity->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $competitionStatisticsActivity->competition_statistics_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $competitionStatisticsActivity->competition_statistics_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $competitionStatisticsActivity->competition_statistics_id], ['confirm' => __('Are you sure you want to delete # {0}?', $competitionStatisticsActivity->competition_statistics_id)]) ?>
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
