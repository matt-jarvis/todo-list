<?php

/**
 * A class representing an item to do.
 *
 * @author mattjarvis
 */
class Item
{
    
    public function getItemId()
    {
        return $this->item_id;
    }
  
    public function getUserId()
    {
        return $this->user_id;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
  
    public function getDescription()
    {
        return $this->description;
    }
    
    public function getDatetimeCreated()
    {
        return $this->datetime_created;
    }
  
    public function getDatetimeLastUpdated()
    {
        return $this->datetime_last_updated;
    }
    
}

?>