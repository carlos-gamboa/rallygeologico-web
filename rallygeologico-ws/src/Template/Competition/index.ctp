<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Competition[]|\Cake\Collection\CollectionInterface $competition
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Competition'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="competition index large-9 medium-8 columns content">
    <h3><?= __('Competition') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('CompetitionId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('IsActive') ?></th>
                <th scope="col"><?= $this->Paginator->sort('StartingDate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('FinishingDate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('IsPublic') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('RallyId') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($competition as $competition): ?>
            <tr>
                <td><?= $this->Number->format($competition->CompetitionId) ?></td>
                <td><?= h($competition->IsActive) ?></td>
                <td><?= h($competition->StartingDate) ?></td>
                <td><?= h($competition->FinishingDate) ?></td>
                <td><?= h($competition->IsPublic) ?></td>
                <td><?= h($competition->Name) ?></td>
                <td><?= $this->Number->format($competition->RallyId) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $competition->CompetitionId]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $competition->CompetitionId]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $competition->CompetitionId], ['confirm' => __('Are you sure you want to delete # {0}?', $competition->CompetitionId)]) ?>
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
