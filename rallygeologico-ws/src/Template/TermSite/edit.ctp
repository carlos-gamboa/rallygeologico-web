<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TermSite $termSite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $termSite->TermId],
                ['confirm' => __('Are you sure you want to delete # {0}?', $termSite->TermId)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Term Site'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="termSite form large-9 medium-8 columns content">
    <?= $this->Form->create($termSite) ?>
    <fieldset>
        <legend><?= __('Edit Term Site') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
