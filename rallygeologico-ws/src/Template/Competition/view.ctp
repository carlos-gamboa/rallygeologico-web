<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Competition $competition
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Competition'), ['action' => 'edit', $competition->CompetitionId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Competition'), ['action' => 'delete', $competition->CompetitionId], ['confirm' => __('Are you sure you want to delete # {0}?', $competition->CompetitionId)]) ?> </li>
        <li><?= $this->Html->link(__('List Competition'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="competition view large-9 medium-8 columns content">
    <h3><?= h($competition->CompetitionId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('IsActive') ?></th>
            <td><?= h($competition->IsActive) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IsPublic') ?></th>
            <td><?= h($competition->IsPublic) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($competition->Name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CompetitionId') ?></th>
            <td><?= $this->Number->format($competition->CompetitionId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('RallyId') ?></th>
            <td><?= $this->Number->format($competition->RallyId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('StartingDate') ?></th>
            <td><?= h($competition->StartingDate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('FinishingDate') ?></th>
            <td><?= h($competition->FinishingDate) ?></td>
        </tr>
    </table>
</div>
