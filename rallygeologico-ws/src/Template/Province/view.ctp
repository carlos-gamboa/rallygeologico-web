<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Province $province
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Province'), ['action' => 'edit', $province->Name]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Province'), ['action' => 'delete', $province->Name], ['confirm' => __('Are you sure you want to delete # {0}?', $province->Name)]) ?> </li>
        <li><?= $this->Html->link(__('List Province'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Province'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="province view large-9 medium-8 columns content">
    <h3><?= h($province->Name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($province->Name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CantonName') ?></th>
            <td><?= h($province->CantonName) ?></td>
        </tr>
    </table>
</div>
