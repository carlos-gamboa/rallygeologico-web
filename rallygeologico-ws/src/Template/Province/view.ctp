<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Province $province
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Province'), ['action' => 'edit', $province->name]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Province'), ['action' => 'delete', $province->name], ['confirm' => __('Are you sure you want to delete # {0}?', $province->name)]) ?> </li>
        <li><?= $this->Html->link(__('List Province'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Province'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Canton'), ['controller' => 'Canton', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Canton'), ['controller' => 'Canton', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="province view large-9 medium-8 columns content">
    <h3><?= h($province->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($province->name) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Canton') ?></h4>
        <?php if (!empty($province->canton)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Province Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($province->canton as $canton): ?>
            <tr>
                <td><?= h($canton->name) ?></td>
                <td><?= h($canton->province_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Canton', 'action' => 'view', $canton->name]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Canton', 'action' => 'edit', $canton->name]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Canton', 'action' => 'delete', $canton->name], ['confirm' => __('Are you sure you want to delete # {0}?', $canton->name)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
