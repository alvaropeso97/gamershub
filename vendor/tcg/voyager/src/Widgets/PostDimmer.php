<?php

namespace TCG\Voyager\Widgets;

use App\Articulo;
use Arrilot\Widgets\AbstractWidget;
use TCG\Voyager\Facades\Voyager;

class PostDimmer extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = Articulo::count();
        $string = $count == 1 ? 'artículo' : 'artículos';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-pen',
            'title'  => "{$count} {$string}",
            'text'   => "Hay {$count} {$string} publicados. Pulsa el botón inferior para ver todos.",
            'button' => [
                'text' => 'Ver todos los artículos',
                'link' => route('voyager.pages.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/03.png'),
        ]));
    }
}
