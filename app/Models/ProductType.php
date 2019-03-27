<?php

class ProductType extends FooterModel {

    public function getDisplayName()
    {
        return $this->name.' - '.$this->id;
    }
}