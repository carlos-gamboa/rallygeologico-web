<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Site $site
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $site->SiteId],
                ['confirm' => __('Are you sure you want to delete # {0}?', $site->SiteId)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Site'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Rally'), ['controller' => 'Rally', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rally'), ['controller' => 'Rally', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Term'), ['controller' => 'Term', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Term', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="site form large-9 medium-8 columns content">
    <?= $this->Form->create($site) ?>
    <fieldset>
        <legend><?= __('Edit Site') ?></legend>
        <?php
            echo $this->Form->control('Name');
            echo $this->Form->control('PointsAwarded');
            echo $this->Form->control('QrUrl');
            echo $this->Form->control('Details');
            echo $this->Form->control('Description');
            echo $this->Form->control('Latitude');
            echo $this->Form->control('Longitude');
            echo $this->Form->control('ProvinceName');
            echo $this->Form->control('rally._ids', ['options' => $rally]);
            echo $this->Form->control('term._ids', ['options' => $term]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
