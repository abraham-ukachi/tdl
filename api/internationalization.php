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
* @name Internationalization
* @file api/internationalization.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> require __DIR__ . '/api/internationalization.php';
*    -|> $i18n = new Internationalization('en');
*    -|> $motto = $i18n->getString('motto');
*    -|>
*    -|> echo $motto;
*    -|
*   o=|> "I'll always do more"
* 
* 
* ============================
* IMPORTANT: A Web App without an API is like coffee without water :)
* ============================
*/


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: I'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */


// TODO: Create a `Language` or `Lang` parent class 
//       with at least a `changeLanguage()` or `updateLanguage()` method

// Declare a class named `Internationalization`
class Internationalization {
  
  // Defining some constants...

  // Define the currently supported lanugages by this app as `LANGUAGES`
  // NOTE: This is a short-syntax multi dimensional array which contains an `id` (e.g 'en'),
  // `greeting` (e.g 'English'), and default `text` (e.g 'Red is my favorite color')
  const LANGUAGES = [
    'en' => ['greeting' => "Hi!", 'text' => "Red is my favorite color" ],
    'fr' => ['greeting' => "Salut!", 'text' => "Le rouge est ma couleur préférée"],
    'ru' => ['greeting' => "Привет!", 'text' => "Красный мой любимый цвет"],
    'es' => ['greeting' => "Hola!", 'text' => "Res es mi color favorito"]
  ];

  // LANG constants 
  // Usage example => i18n::LANG_ENGLISH
  // TODO: Remove the `LANG_` part of these constant variables (i.e. LANG_ENGLISH -> ENGLISH)
  const LANG_ENGLISH = 'en';
  const LANG_FRENCH = 'fr';
  const LANG_RUSSIAN = 'ru';
  const LANG_SPANISH = 'es';

  // Path to 'locale' folder or directory
  const LOCALE_DIR = 'assets/locale';


  // Defining some private properties...
  // NOTE: These are properties that can only by accessed by this `Internationalization` class.

  private $lang;
  private $stringData;


  // TODO: Create a `numberData` private property
  

  /**
   * Create a constructor to initialize the properties of an object upon creation.
   * NOTE: PHP will automatically call this constructor whenever an object of `Internationalization` is created.
   *
   * @param string $lang : 'en' <- default language
   */
  public function __construct($lang = 'en') {
    // TODO: Make sure the given `lang` is supported before proceeding ;)

    // Initialize our properties
    $this->lang = $lang;
    $this->stringData = [];


    // load the String data
    $this->_loadStringData(); 
    // TODO: Create a `_loadNumberData()` function and call it here
    
    // DEBUG [4dbsmaster]: tell me about it :)
    //  var_dump($this->getSupportedLanguages());
    // echo $this::LANGUAGES['fr']['greeting'];

  }


  // PUBLIC METHODS

  /**
   * Returns the text value of the given `key` in `$stringData`
   *
   * @param string $key
   * @return string 
   */
  public function getString($key) {
    // TODO: Use a try/catch statement to handle errors
    return $this->stringData[$key];
  }

  /**
   * Returns a list or indexed array of all currently supported languages
   *
   * @return array $supportedLanguages
   */
  public function getSupportedLanguages() {
    // Initialize the `supportedLanguages` variable with an empty short syntax array
    $supportedLanguages = [];

    // For each language id & data in our predefined `LANGUAGES` constant...
    foreach ($this::LANGUAGES as $langId => $langData) {
      // ..append only the id (e.g 'en') to the `supportedLanguages` list
      $supportedLanguages[] = $langId;
    }
    
    // return the `supportedLanguages` list
    return $supportedLanguages;
  }





  // PRIVATE METHODS


  /**
   * Method used to load or update the `stringData` list.
   * @private
   */
  private function _loadStringData() {
    // Get the json file of the current language as `localeFile`,
    // using the value of `LOCALE_PATH` and `lang`
    $localeFile = $this::LOCALE_DIR . "/" . $this->lang . '.json';

    // DEBUG [4dbsmaster](1): tell me about it :) 
    // echo "localFile => " . $localeFile . "<br>";
    
    // get the json data of the locale file
    $jsonData = file_get_contents($localeFile);

    // Convert or decode the json data to an `array`
    $array = json_decode($jsonData, true);

    // update the `stringData` with the `array`
    $this->stringData = $array;

    // DEBUG [4dbsmaster](2): tell me about it :)
    // var_dump($jsonData);
     
  }

}

?>


