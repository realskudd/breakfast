<?php

class Schedule extends \ActiveRecord\Model
{
    public static $belongs_to = [
        ['member'],
    ];
}