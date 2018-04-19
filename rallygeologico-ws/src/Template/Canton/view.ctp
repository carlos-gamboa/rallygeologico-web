<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Canton $canton
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Canton'), ['action' => 'edit', $canton->Name]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Canton'), ['action' => 'delete', $canton->Name], ['confirm' => __('Are you sure you want to delete # {0}?', $canton->Name)]) ?> </li>
        <li><?= $this->Html->link(__('List Canton'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Canton'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="canton view large-9 medium-8 columns content">
    <h3><?= h($canton->Name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($canton->Name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DistrictName') ?></th>
            <td><?= h($canton->DistrictName) ?></td>
        </tr>
    </table>
</div>
