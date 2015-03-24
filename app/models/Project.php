<?php

class Project extends Eloquent {

	protected $table = 'project';
    /**
	 * Get the comment's content.
	 *
	 * @return string
	 */
	public function name()
	{
		return $this->name;
	}

    public function description()
    {
        return $this->description;
    }

    public function image()
    {
        return $this->image;
    }

	public function address()
	{
		return $this->address;
	}


	public function city()
	{
		return $this->city;
	}

	public function zipCode()
	{
		return $this->zipCode;
	}

	public function maxVolunteers()
	{
		return $this->maxVolunteers;
	}

	public function startDate()
	{
		return $this->startDate;
	}

	public function finishDate()
	{
		return $this->finishDate;
	}
	/**
	 * Get the comment's author.
	 *
	 * @return User
	 */
	public function ngo()
	{
		return $this->belongsTo('Ngo', 'ngo_id');
	}
	public function company()
	{
		return $this->belongsTo('Company', 'company_id');
	}

	public function categories()
	{
		return $this->belongsToMany('Category', 'project_category');
	}




}