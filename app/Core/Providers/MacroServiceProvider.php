<?php

namespace App\Core\Providers;

//use App\Core\Logic\Macros\Macros;
use Collective\Html\HtmlServiceProvider;

/**
 * Class MacroServiceProvider
 * @package App\Core\Providers
 */
class MacroServiceProvider extends HtmlServiceProvider
{
	/**
	* Register the application services.
	*
	* @return void
	*/
	public function register()
	{
	    // Macros must be loaded after the HTMLServiceProvider's
	    // register method is called. Otherwise, csrf tokens
	    // will not be generated
		parent::register();

	    // Load HTML Macros
	    require app_path('Core/Logic/Macros/HtmlMacros.php');
        //require base_path() . '/app/Core/Logic/Macros/HtmlMacros.php';



	}
}
