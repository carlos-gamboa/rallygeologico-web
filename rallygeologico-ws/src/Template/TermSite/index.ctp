<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TermSite[]|\Cake\Collection\CollectionInterface $termSite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Term Site'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="termSite index large-9 medium-8 columns content">
    <h3><?= __('Term Site') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('TermId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SiteId') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($termSite as $termSite): ?>
            <tr>
                <td><?= $this->Number->format($termSite->TermId) ?></td>
                <td><?= $this->Number->format($termSite->SiteId) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $termSite->TermId]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $termSite->TermId]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $termSite->TermId], ['confirm' => __('Are you sure you want to delete # {0}?', $termSite->TermId)]) ?>
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
