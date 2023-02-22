<?php
/**
* @license
* tdl
* Copyright (c) 2023 Abraham Ukachi
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in all
* copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*
* @project tdl 
* @name App
* @file api/app.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> include __DIR__ . 'api/app.php';
*    -|> $app = new App();
*    
*
*   2-|> $currentView = $app->getCurrentView(App::SETTINGS_VIEW_DEFAULT);
*    -|> echo $currentView;
*     |
*   o=|> 'language' // <- output will differ based on the current view
*   
*
*   3-|> $currentPage = $app->getCurrentPage(App::PAGE_DEFAULT);
*    -|> echo $currentPage;
*     |
*   o=|> 'home' // <- output will differ based on the current page
*
* ============================
* IMPORTANT: I created a to-do list with only one task: 1. Debug the entire universe!!! :)
* ============================
*/


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: I'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/


// start a session 
session_start();


/*
 * The main class of our `tdl` Web App named `App` (3d)
 * NOTE: This class contains all the necessary / major constant variables related to this app.
 */
class App {
  
  // Defining some constants ...
  
  // THEMES
  const THEME_CLASSIC = 'classic';
  const THEME_LIGHT = 'light';
  const THEME_DARK = 'dark';
  // Define the currently supported themes by this app as `THEMES`
  // NOTE: This is a short syntax index array which only contains the name or key of the themes (e.g. 'dark')
  const THEMES = [self::THEME_CLASSIC, self::THEME_LIGHT, self::THEME_DARK];
  // default theme
  const THEME_DEFAULT = self::THEME_DARK;

  // PAGES
  const PAGE_HOME = 'home';
  const PAGE_LOGIN = 'login';
  const PAGE_REGISTER = 'register';
  const PAGE_PROFILE = 'profile';
  const PAGE_SETTINGS = 'settings';
  const PAGE_SPLASH_SCREEN = 'splash-screen';
  const PAGE_ADMIN = 'admin';
  
  // QUERIES
  const QUERY_ROUTE = 'route';
  const QUERY_VIEW = 'view';
  const QUERY_DIALOG = 'dialog';
  const QUERY_STEP = 'step';

  // DIALOGS
  const DIALOG_DELETE_ACCOUNT = 666;

  
  /* ----< VIEWS >---- */

  // settings view
  const VIEW_SETTINGS_DEFAULT = 'home';
  const VIEW_SETTINGS_ABOUT = 'about';
  const VIEW_SETTINGS_LANGUAGE = 'lang';
  const VIEW_SETTINGS_THEME = 'theme';

  /* ---> End of VIEWS <--- */



  /* ----< ROUTES >---- */

  // admin routes
  const ROUTE_ADMIN_USERS = 'users';
  const ROUTE_ADMIN_DASHBOARD = 'dashboard';
  
  /* ---> End of ROUTES <--- */




  // the base directory of this app (from the 'api/' folder)
  const DIR_BASE = '../';
  // defaults
  // TODO: Get the default lang with `substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)` (https://stackoverflow.com/questions/3770513/detect-browser-language-in-php)
  const LANGUAGE_DEFAULT = 'en'; // <- english

  
  // Define the current language variable as `LANGUAGE`
  // Get the currrent language from SESSION as `lang`
  // if it exists, else use 'en' (English) as default
  //const APP_LANGUAGE = isset($_SESSION['lang']) ? $_SESSION['lang'] : self::LANGUAGE_DEFAULT;
  //const APP_LANGUAGE = ;
  //
  // public $language = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';


  // TODO: Create an `APP_THEME` constant for the current theme of the app



  /**
   * The constructor function that is executed every time this `App` class is instantiated.
   */
  public function __construct() {
     // TODO: do something life-changing here ;)
  }


  // PUBLIC GETTERS
  
  /**
   * Returns the current language of the app.
   *
   * @return string
   */
  public function getCurrentLanguage() {
    return isset($_SESSION['lang']) ? $_SESSION['lang'] : self::LANGUAGE_DEFAULT;
  }


  /**
   * Returns the current theme of the app.
   *
   * @return string
   */
  public function getCurrentTheme() {
    return isset($_SESSION['theme']) ? $_SESSION['theme'] : self::THEME_DEFAULT;
  }


  /**
   * Returns the current page of this app.
   *
   * @param string $defaultPage - The default page of the app (i.e. 'home' or PAGE_DEFAULT)
   * @param bool $EXT - If TRUE, the extension (eg. 'php') of the current page will be added
   *
   * @return string - Current page
   */
  public function getCurrentPage($defaultPage = self::PAGE_HOME, $EXT = false) {

    // Extracting the current page from location's url...

    // TIPS: 
    //  $_SERVER['SERVER_NAME']: The name of the server host under which the current script is executing.   
    //  ^^^^^^^^^^^^^^ returns 'localhost'
    //
    //  $_SERVER['REQUEST_URI']: The URI which was given in order to access this page.
    //  ^^^^^^^^^^^^^^ returns '/tdl/settings.php?view=theme' 
    //
    //  $_SERVER['SCRIPT_FILENAME']: The absolute pathname of the currently executing script.
    //  ^^^^^^^^^^^^^^ returns '/Applications/XAMPP/xamppfiles/htdocs/tdl/settings.php'
    //
    //  $_SERVER['PHP_SELF']: The filename of the currently executing script.
    //  ^^^^^^^^^^^^^^ returns '/tdl/settings.php'


    // Intialize the `currentPage` variable
    $currentPage = '';

    
    // TODO: Remove the try/catch blocks below asap. Not Necessary ?

    try { // <- let's try to extract the current page (eg. 'settings') from PHP's SERVER

      // Get the filename of the current page from PHP's `SERVER` global/reserved variable as `pathname`
      $pathname = $_SERVER['PHP_SELF']; 
      // IDEA: Split the `pathname` with a '/' separator, and use the last item from the list.
      $splitPathname = explode('/', $pathname);
      // Update the $currentPage with the last item from `splitPathname`
      $currentPage = end($splitPathname); // <- returns eg. 'settings.php'

      // If `$EXT` is FALSE (a.k.a no extension needed)...
      if ($EXT === false) {
        // ...split the `$currentPage` with '.' separator (or explode on `.` to an array)
        $currentPageParts = explode('.', $currentPage);
        // remove the last item or extension from `$currentPageParts` array
        array_pop($currentPageParts);
        // Join what's left of `$currentPageParts` and update the `$currentPage` accordingly
        $currentPage = implode('.', $currentPageParts);
      }
        

    }catch (Exception $e) {
      // DEBUG [4dbsmaster]: tell me about this error
      die($e->getMessage());
    }



    return (!empty($currentPage)) ? $currentPage : $defaultPage;
  }


  /**
   * Returns the current view of this settings page from the GET parameters.
   *
   * Example: 
   *    
   *    $app->getCurrentView(App::VIEW_SETTINGS_DEFAULT)
   *
   * @param string $defaultView - The default view of the current page
   * @return string : Current view (eg. 'home', 'language', 'about', ..).
   */
  public function getCurrentView($defaultView = '') {
    // Using our beloved ternary statment, return the value of `view` parameter 
    // from PHP's global variable GET,only if `view` exists,
    // otherwise, just return the given default view
    return isset($_GET['view']) ? $_GET['view'] : $defaultView;
  }



  /**
   * Returns the current route of the page.
   *
   * Example: 
   *    
   *    $app->getCurrentRoute()
   *
   * @param string $defaultRoute - The default route of the current page
   *
   * @return string : Current route (eg. 'users', 'dashboard', ..).
   */
  public function getCurrentRoute($defaultRoute = '') {
    // Using our beloved ternary statment, return the value of `route` parameter 
    // from PHP's global variable GET,only if `route` exists,
    // otherwise, just return the given `defaultRoute`
    return isset($_GET[self::QUERY_ROUTE]) ? $_GET[self::QUERY_ROUTE] : $defaultRoute;
  }




  // PUBLIC SETTERS


  // PUBLIC FUNCTIONS




 

  // PRIVATE GETTERS


  /**
   * Returns an alphabetical color set.
   * NOTE: This is a multidimensional array.
   *
   * @return array
   * @private
   */
  public function getAlphaColorSet() {
    return array(
      'a' => ['bgColor' => 'darkorange', 'fgColor' => 'white'],
      'b' => ['bgColor' => 'darkred', 'fgColor' => 'white'],
      'c' => ['bgColor' => 'darkgreen', 'fgColor' => 'white'],
      'd' => ['bgColor' => 'darkyellow', 'fgColor' => 'white'],
      'e' => ['bgColor' => 'darkblue', 'fgColor' => 'white'],
      'f' => ['bgColor' => '#13005A', 'fgColor' => 'white'],
      'g' => ['bgColor' => '#0A2647', 'fgColor' => 'white'],
      'h' => ['bgColor' => '#1A120B', 'fgColor' => 'white'],
      'i' => ['bgColor' => '#453C67', 'fgColor' => 'white'],
      'j' => ['bgColor' => '#2D033B', 'fgColor' => 'white'],
      'k' => ['bgColor' => '#00005C', 'fgColor' => 'white'],
      'l' => ['bgColor' => '#000000', 'fgColor' => 'white'],
      'm' => ['bgColor' => '#404258', 'fgColor' => 'white'],
      'n' => ['bgColor' => '#3F3B6C', 'fgColor' => 'white'],
      'o' => ['bgColor' => '#4C0033', 'fgColor' => 'white'],
      'p' => ['bgColor' => '#182747', 'fgColor' => 'white'],
      'q' => ['bgColor' => '#16213E', 'fgColor' => 'white'],
      'r' => ['bgColor' => '#472D2D', 'fgColor' => 'white'],
      's' => ['bgColor' => '#2C3333', 'fgColor' => 'white'],
      't' => ['bgColor' => '#2E0249', 'fgColor' => 'white'],
      'u' => ['bgColor' => '#180A0A', 'fgColor' => 'white'],
      'v' => ['bgColor' => '#46244C', 'fgColor' => 'white'],
      'w' => ['bgColor' => '#191919', 'fgColor' => 'white'],
      'x' => ['bgColor' => '#041C32', 'fgColor' => 'white'],
      'y' => ['bgColor' => '#1F1D36', 'fgColor' => 'white'],
      'z' => ['bgColor' => '#420516', 'fgColor' => 'white']
    );
    
  }


  // PRIVATE SETTERS

  // PRIVATE FUNCTIONS

}

?>
