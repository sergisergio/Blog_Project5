<?php

namespace Philippe\Blog\Src\Entities;
/**
* Trait Construct which creates objects
* 
*/	
trait Constructor
{
	/**
     * Construct
     * 
     * @param array $datas datas
     *
     * @return array 
     */
    public function __construct($data) 
    {
        $this->hydrate($data);
    }
}