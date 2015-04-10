<?php

class Project extends Eloquent
{

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

    public function country()
    {
        return $this->country;
    }

    public function maxVolunteers()
    {
        return $this->maxVolunteers;
    }

    public function startDate()
    {
        return $this->date(startDate);
    }

    public function finishDate()
    {
        return $this->date(finishDate);
    }

    public function date($date = null)
    {
        if (is_null($date)) {
            $date = $this->created_at;
        }

        return String::date($date);
    }

    /**
     * Returns the date of the blog post creation,
     * on a good and more readable format :)
     *
     * @return string
     */
    public function created_at()
    {
        return $this->date($this->created_at);
    }

    /**
     * Returns the date of the blog post last update,
     * on a good and more readable format :)
     *
     * @return string
     */
    public function updated_at()
    {
        return $this->date($this->updated_at);
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

    public function volunteers()
    {
        return $this->belongsToMany('Volunteer', 'project_volunteer');
    }

    public function applications()
    {
        return $this->hasMany('Application');
    }
    public function categories()
    {
        return $this->belongsToMany('Category', 'project_category');
    }


}