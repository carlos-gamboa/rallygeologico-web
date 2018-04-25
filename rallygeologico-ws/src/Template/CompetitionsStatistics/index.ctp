<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionsStatistic[]|\Cake\Collection\CollectionInterface $competitionsStatistics
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Competitions Statistic'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="competitionsStatistics index large-9 medium-8 columns content">
    <h3><?= __('Competitions Statistics') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('UserId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CompetitionId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('StartingDate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('FinishingDate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Points') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($competitionsStatistics as $competitionsStatistic): ?>
            <tr>
                <td><?= $this->Number->format($competitionsStatistic->UserId) ?></td>
                <td><?= $this->Number->format($competitionsStatistic->CompetitionId) ?></td>
                <td><?= h($competitionsStatistic->StartingDate) ?></td>
                <td><?= h($competitionsStatistic->FinishingDate) ?></td>
                <td><?= $this->Number->format($competitionsStatistic->Points) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $competitionsStatistic->FacebookId]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $competitionsStatistic->FacebookId]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $competitionsStatistic->FacebookId], ['confirm' => __('Are you sure you want to delete # {0}?', $competitionsStatistic->FacebookId)]) ?>
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
