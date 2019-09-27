<?php

namespace App\Traits;

trait HasStatus
{
    /**
     * @return string
     */
    public function getformattedStatusAttribute()
    {
        switch ($this->status) {
            case "prograssing":
                $attrs =  ['icon' => 'sl sl-icon-refresh', 'class' => 'is-info'];
                break;
            case "failed":
                $attrs =  ['icon' => 'sl sl-icon-close', 'class' => 'is-danger'];
                break;
            case "completed":
                $attrs =  ['icon' => 'sl sl-icon-check', 'class' => 'is-success'];
                break;
            default:
                $attrs =  ['icon' => 'sl sl-icon-refresh', 'class' => 'is-info'];
                break;
        }

        $attrs['name'] = $this->status;

        return $attrs;
    }
}
