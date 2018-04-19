<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\District $district
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit District'), ['action' => 'edit', $district->Name]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete District'), ['action' => 'delete', $district->Name], ['confirm' => __('Are you sure you want to delete # {0}?', $district->Name)]) ?> </li>
        <li><?= $this->Html->link(__('List District'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New District'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="district view large-9 medium-8 columns content">
    <h3><?= h($district->Name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($district->Name) ?></td>
        </tr>
    </table>
</div>
