<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TermMultimedia[]|\Cake\Collection\CollectionInterface $termMultimedia
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Term Multimedia'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Term'), ['controller' => 'Term', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Term', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Multimedia'), ['controller' => 'Multimedia', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Multimedia'), ['controller' => 'Multimedia', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="termMultimedia index large-9 medium-8 columns content">
    <h3><?= __('Term Multimedia') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('term_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('multimedia_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($termMultimedia as $termMultimedia): ?>
            <tr>
                <td><?= $this->Number->format($termMultimedia->id) ?></td>
                <td><?= $termMultimedia->has('term') ? $this->Html->link($termMultimedia->term->name, ['controller' => 'Term', 'action' => 'view', $termMultimedia->term->id]) : '' ?></td>
                <td><?= $termMultimedia->has('multimedia') ? $this->Html->link($termMultimedia->multimedia->id, ['controller' => 'Multimedia', 'action' => 'view', $termMultimedia->multimedia->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $termMultimedia->multimedia_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $termMultimedia->multimedia_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $termMultimedia->multimedia_id], ['confirm' => __('Are you sure you want to delete # {0}?', $termMultimedia->multimedia_id)]) ?>
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
