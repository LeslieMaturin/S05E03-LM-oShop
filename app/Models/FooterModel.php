<?php

abstract class FooterModel extends CoreModel {

    protected $footer_order;

    /**
     * Get the value of footerOrder
     */
    public function getFooterOrder()
    {
        return $this->footer_order;
    }

    /**
     * Set the value of footerOrder
     *
     * @return  self
     */
    public function setFooterOrder($footer_order)
    {
        $this->footer_order = $footer_order;

        return $this;
    }
}