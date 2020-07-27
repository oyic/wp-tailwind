<?php 
namespace Emma;


class Migration{
  public function __construct()
  {
    if($this->is_migrated())
    {
      
    }
  }
  public function is_migrated()
  {
    return "NOT YET";
  }

}