<?php
    /**
     * @param $email
     * @return bool
     */
	function fs_validateEmail($email)
	{
		if(is_email($email)){
			return true;
		}
		return false;
	}
    
    /**
     * @param $slug
     * @return bool
     */
	function fs_validateSlug($slug)
	{
		$re = '/^[0-9a-zA-Z](-?[0-9a-zA-Z]|_?[0-9a-zA-Z]+)*$/';
		
		if(!preg_match($re, $slug)){
			return false;
		}
		return true;		
	}
    
    /**
     * @param $phone
     * @return bool
     */
	function fs_validatePhone($phone)
	{
		$re = '/^[0-9]{8,20}$/';
		if(!preg_match($re, $phone)){
			return false;
		}
		return true;
	}
    
    /**
     * @param $name
     * @return bool
     */
	function fs_validateName($name)
	{
        $re = '/\w+\s+\w+/';
        if(!preg_match($re, $name)){
            return false;
        }
        return true;
	}

	function fs_validateURL($email)
	{
		
	}

 ?>