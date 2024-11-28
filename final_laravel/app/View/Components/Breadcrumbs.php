<?php
namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class Breadcrumbs extends Component
{
    public $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = $this->generateBreadcrumbs();
    }

    private function generateBreadcrumbs()
    {
        $breadcrumbs = [];
        $segments = request()->segments();
        $url = '';

        foreach ($segments as $segment) {
            $url .= '/' . $segment;
            $breadcrumbs[] = [
                'name' => ucfirst($segment),
                'url' => $url,
            ];
        }

        return $breadcrumbs;
    }

    public function render()
    {
        return view('components.breadcrumbs');
    }
}
