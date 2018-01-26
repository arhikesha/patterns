<?php
abstract class DomainObject{
	public static function create(){
		return new static();
	}
}

class User extends DomainObject{
	public $name = "oleg";
}
class Document extends DomainObject{
}

//var_dump(User::create());


//////////////////////
abstract class DomainObjects{
	private $group;

public function __construct() {
$this->group = static::getGroup ();
}

public static function create (){
return new static();
}

static function getGroup () {
	return "default";
}
}

class Users extends DomainObjects{
}
class Documents extends DomainObjects{
	static function getGroup(){
		return "Document";
	}
}
class SpeadSheet extends Documents{
	
}
print_r(Users::create());
echo "<br>";
print_r(SpeadSheet::create());
?>