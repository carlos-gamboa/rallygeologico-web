<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RallySite $rallySite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rallySite->RallyId],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rallySite->RallyId)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Rally Site'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="rallySite form large-9 medium-8 columns content">
    <?= $this->Form->create($rallySite) ?>
    <fieldset>
        <legend><?= __('Edit Rally Site') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
