<?php

interface TheInterface
{
	public function first();
}
class A implements TheInterface
{
	public function first()
	{
		//
	}
}

$a = new A();
var_dump(get_class($a));
var_dump($a instanceof A);
var_dump($a instanceof TheInterface);
