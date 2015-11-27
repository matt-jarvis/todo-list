<?php

/**
 * A class representing a user.
 *
 * @author mattjarvis
 */
class User
{   
    
    public function getUserId()
    {
        return $this->user_id;
    }
  
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
  
    public function getFirstName()
    {
        return $this->first_name;
    }
    
    public function getLastName()
    {
        return $this->last_name;
    }
  
    public function detDob()
    {
        return $this->dob;
    }
    
}

?>