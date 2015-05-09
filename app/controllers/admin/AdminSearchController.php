<?php

class AdminSearchController extends BaseController
{
    protected $name;

    public function __construct()
    {
        parent::__construct();
    }

    public function searchVolunteers()
    {
        $data = array(
            'searchAction' => 'admin/search/findVolunteers',
        );

        Return View::make('admin/users/search')->with($data);
    }

    public function findVolunteersWithSimilarUsername()
    {
        $this->name = Input::get('username');
        $users = Volunteer::whereHas('userAccount', function ($q) {
            $q->where('username', '=', $this->name);
        })->get();


        $data = array(
            'users' => $users,
            'searchAction' => 'admin/search/findVolunteers',
            'searchType' => 'volunteers',
        );

        Input::flash();
        Return View::make('admin/users/search')->with($data);
    }

    public function searchCompanies()
    {
        $data = array(
            'searchAction' => 'admin/search/findCompanies',
        );

        Return View::make('admin/users/search')->with($data);
    }

    public function findCompaniesWithSimilarUsername()
    {
        $this->name = Input::get('username');
        $users = Company::whereHas('userAccount', function ($q) {
            $q->where('username', '=', $this->name);
        })->get();

        $data = array(
            'users' => $users,
            'searchAction' => 'admin/search/findCompanies',
            'searchType' => 'companies',
        );

        Input::flash();
        Return View::make('admin/users/search')->with($data);
    }

    public function searchNGOs()
    {
        $data = array(
            'searchAction' => 'admin/search/findNGOs',
        );

        Return View::make('admin/users/search')->with($data);
    }

    public function findNGOsWithSimilarUsername()
    {
        $this->name = Input::get('username');
        $users = Ngo::whereHas('userAccount', function ($q) {
            $q->where('username', '=', $this->name);
        })->get();

        $data = array(
            'users' => $users,
            'searchAction' => 'admin/search/findNGOs',
            'searchType' => 'NGOs',
        );

        Input::flash();
        Return View::make('admin/users/search')->with($data);
    }

}