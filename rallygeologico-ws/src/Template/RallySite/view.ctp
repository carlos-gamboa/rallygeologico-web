<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RallySite $rallySite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Rally Site'), ['action' => 'edit', $rallySite->RallyId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Rally Site'), ['action' => 'delete', $rallySite->RallyId], ['confirm' => __('Are you sure you want to delete # {0}?', $rallySite->RallyId)]) ?> </li>
        <li><?= $this->Html->link(__('List Rally Site'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rally Site'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rallySite view large-9 medium-8 columns content">
    <h3><?= h($rallySite->RallyId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('RallyId') ?></th>
            <td><?= $this->Number->format($rallySite->RallyId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SiteId') ?></th>
            <td><?= $this->Number->format($rallySite->SiteId) ?></td>
        </tr>
    </table>
</div>
