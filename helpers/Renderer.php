<?php

namespace Helpers;

class Renderer
{
    private $values = [];
    private $templates = [];

    public function setValue($key, $value)
    {
        $this->values[$key] = $value;

        return $this;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function setTemplate($template)
    {
        $this->templates[] = $template;

        return $this;
    }

    public function render()
    {
        foreach ($this->templates as $template) {
            call_user_func($template, $this->values);
        }
    }
}
