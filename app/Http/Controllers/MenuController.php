<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function SandsMenu()
    {
        $pageTitle = 'Sands Restaurant | Menu';
        $icon = 'img/logo/sands.svg';
        return view('menu.sands', compact('pageTitle', 'icon'));
    }

    public function KunyitMenu()
    {
        $pageTitle = 'Kunyit Restaurant | Menu';
        $icon = 'img/logo/kunyit.svg';
        return view('menu.kunyit', compact('pageTitle', 'icon'));
    }

    public function Beverage()
    {
        $pageTitle = 'Beverage List';
        $icon = 'https://cdn-63b265c1c1ac19e320d16437.closte.com/wp-content/themes/wcl/images/logo-theanvaya.svg';
        return view('menu.beverage', compact('pageTitle', 'icon'));
    }


}
