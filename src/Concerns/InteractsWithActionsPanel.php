<?php

namespace EightyNine\Reports\Concerns;

use EightyNine\Reports\Components\ActionsPanel;

trait InteractsWithActionsPanel
{
    public function getActionsPanel(): ActionsPanel
    {
        return $this->setUpActionsPanel(ActionsPanel::make($this));
    }

    public function setUpActionsPanel(ActionsPanel $actionsPanel): ActionsPanel
    {
        return $actionsPanel;
    }
}
