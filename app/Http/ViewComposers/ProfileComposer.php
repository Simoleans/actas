<?php 

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Empresas as Empresas;


class ProfileComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (\Auth::check()) {

            $empresa = Empresas::where('id_user',\Auth::user()->id)->get();

            $view->with('empresa', $empresa->count());
        }
        
    }

}