<?php

namespace Philippe\Blog\Src\Entities;
/**
 * Trait that allowes each entity to be hydrated
 */
trait Hydrator
{
	/**
     * Hydrate
     * 
     * @param array $data datas
     * 
     * @return array
     */	
	public function hydrate($data)
	{
		foreach ((array)$data as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}
}