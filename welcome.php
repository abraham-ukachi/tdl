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
* @name Welcome Page - tdl
* @file welcome.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> open http://localhost/tdl/welcome.php
* 
* 
* ============================
* IMPORTANT: I created a to-do list with only one task: 1. Debug the entire universe!!! :)
* ============================
*/


/**
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: I'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/


// TODO: Rename `steps` to `tips`

// Using our own APIs ;)
require 'api/app.php';
require 'api/internationalization.php';


// Create an instance or object of `App` class
$app = new App();
// get the current language from $app as `currentLanguage`
$currentLanguage = $app->getCurrentLanguage(); // <- returns eg. 'en', 'fr', ...
// get the current theme from $app as `currentTheme`
$currentTheme = $app->getCurrentTheme(); // <- returns eg. 'dark', 'light' or 'classic', ...
// get the current page and view of the from $app as `page` and `view` respectively;
$currentPage = $app->getCurrentPage(App::PAGE_SETTINGS, false); // SUGGESTION: create & use a `setCurrentPage()` instead ? 
$currentView = $app->getCurrentView(App::VIEW_SETTINGS_DEFAULT);


// Create an object of Internationalization named `i18n` with the current language (i.e. $currentLanguage)
$i18n = new Internationalization($currentLanguage);
// get our motto from `i18n`
// $motto = $i18n->getString('motto');


// DEBUG [4dbsmaster]: tell me anout it :)
// echo "currentLanguage => $currentLanguage";
// echo "currentTheme => $currentTheme";
// echo "currentPage => $currentPage";
// echo "currentView => $currentView";
// echo "motto => $motto";
// 
// var_dump($i18n::LANGUAGES);



// Create a short syntax index array as `steps`
// NOTE: This list contains the IDs of each currently available / supported step
$steps = ['account', 'edit', 'tdl', 'language', 'theme', 'delete'];

// Create a multidimensional associative array as `welcomePackage`
$welcomePackage = array();
// account
$welcomePackage["account"] = array(
  "title" => "Create a free account",
  "description" => "In less than 60 seconds, you can open your own secure and always-free `<em>tdl</em>` account, using only a username of your choice, your first and last names, and a password."
);
// edit
$welcomePackage["edit"] = array(
  "title" => "Edit your profile",
  "description" => "Update your username, password, first and last names whenever you want. All your personal data are end-to-end encrypted, which means that `<em>tdl</em>` and third parties can't read them."
);
// delete
$welcomePackage["delete"] = array(
  "title" => "Leave anytime",
  "description" => "Other Apps and make it difficult for to delete your account. Not Us!!! We've created a BIG red button in the settings page that allows you to delete your account whenever you want."
);
// tdl
$welcomePackage["tdl"] = array(
  "title" => "Create a to-do list",
  "description" => "With an unlimited number of to-do lists, take your time to organize your tasks. If not, you can allow others to create them for you."
);
// language
$welcomePackage["language"] = array(
  "title" => "Change your language",
  "description" => "This Web App has currently been translated into 4 different languages (i.e. English, French, Russian and Spanish). Feel free to switch between languages anytime from the settings page."
);
// theme
$welcomePackage["theme"] = array(
  "title" => "Change your theme",
  "description" => "With 3 themes to choose from (<em>Classic</em> for crazy people, <em>Dark</em> for geniuses, and <em>Light</em> for simple folks), you'll never get bored. And, your eyes will thank you :)"
);




// Get the current step number from GET superglobal as `currentStep`
// NOTE: Using 1 as default step number, if there's no 'step' query variable in GET.
$currentStep = isset($_GET[App::QUERY_STEP]) ? (int) $_GET[App::QUERY_STEP] : 1;
// Calculate the previous step number as `prevStep`
$prevStep = $currentStep - 1;
// Calculate the next step number as `nextStep`
$nextStep = $currentStep + 1;
// Calculate the total number of steps as `totalSteps`
$totalSteps = count($steps);

/* 
 * Checks if the current step is the first
 * @return bool - Returns TRUE if the current step is 1
 */
$isFirstStep = $currentStep === 1;

/* 
 * Checks if the current step is the last
 * @return bool - Returns TRUE if the current step is the same as the total number of `steps`
 */
$isLastStep = $currentStep === $totalSteps; 


/**
 * Returns the step id from the given `step` number.
 *
 * @param int $step - The step number, starting with 1 (not 0).
 * @return string - eg.: 'account', 'edit', ...
 */
$getIdByStep = function ($step) use ($steps) {
  // TODO: Check if the given `step` in within range before proceeding
  return $steps[$step - 1];
};

/**
 * Returns the title of the given `step` number.
 *
 * @param int $step - The step number
 * @return string - eg.: "Create a free account"
 */
$getTitleByStep = function ($step) use ($steps, $welcomePackage) {
  // get the step index from `$steps`, with the given `step` number
  $stepIndex = $steps[$step - 1];
  // retrieve the title from `$welcomePackage`, positioned at `$stepIndex`
  $title = $welcomePackage[$stepIndex]['title'];
  // return the $title
  return $title;
};


/**
 * Returns the description of the given `step` number.
 *
 * @param int $step - The step number
 * @return string
 */
$getDescByStep = function ($step) use ($steps, $welcomePackage) {
  // get the step index from `$steps`, with the given `step` number
  $stepIndex = $steps[$step - 1];
  // retrieve the description from `$welcomePackage`, positioned at `$stepIndex`
  $description = $welcomePackage[$stepIndex]['description'];
  // return the $description
  return $description;
};


// DEBUG [4dbsmaster]: tell me about it :)
// var_dump($isFirstStep);
// var_dump($isLastStep);

?><!DOCTYPE html>

<!-- HTML -->
<html lang="en">

  <!-- HEAD -->
  <head>
    <!-- Our 4 VIP metas -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="Welcome page of tdl">
    
    <!-- Title -->
    <title>Welcome - tdl | Abraham Ukachi</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Mulish - Font -->
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Material Icons - https://github.com/google/material-design-icons/tree/master/font -->
    <!-- https://material.io/resources/icons/?style=baseline -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    
    <!-- Base -->
    <base href="tdl">

    <!-- Logo - Icon -->
    <link rel="icon" href="assets/images/favicon.ico">

    <!-- See https://goo.gl/OOhYW5 -->
    <link rel="manifest" href="manifest.json">

    <!-- See https://goo.gl/qRE0vM -->
    <meta name="theme-color" content="#A67C52">

    <!-- Add to homescreen for Chrome on Android. Fallback for manifest.json -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="tdl">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="tdl">

    <!-- Homescreen icons -->
    <link rel="apple-touch-icon" href="assets/images/manifest/icon-48x48.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/images/manifest/icon-72x72.png">
    <link rel="apple-touch-icon" sizes="96x96" href="assets/images/manifest/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/images/manifest/icon-144x144.png">
    <link rel="apple-touch-icon" sizes="192x192" href="assets/images/manifest/icon-192x192.png">




    <!-- Theme -->
    <!-- TODO: Rename `styles.css` to `style.css` -->
    <link rel="stylesheet" href="assets/theme/color.css">
    <link rel="stylesheet" href="assets/theme/typography.css">
    <link rel="stylesheet" href="assets/theme/styles.css">
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/stylesheets/welcome-styles.css">
    
    <!-- Animations -->
    <!-- <link rel="stylesheet" href="assets/animations/fade-in-animation.css"> -->
    <!-- <link rel="stylesheet" href="assets/animations/slide-from-down-animation.css"> -->


    <!-- Script -->
    <!-- ^^^^^^ Like previously stated, "A little JS doesn't hurt ;)" -->
    <script>
      /*
       * Once again, I'm well aware that this project doesn't require a script but
       * I couldn't help myself. So.... Bite me twice!! ;)
       */

      // Create `tdl` object variable with a `isReady` key 
      var tdl = {
        page: 'welcome',
        isReady: false,
        onReady: () => {} 
      }; // <- `false` 'cause duh!! We ain't ready yet!! 


      // Let's do some stuff when this page loads...
      // NOTE: This is again, just a simulation!
      window.addEventListener('load', (event) => { 
        // ...get the document as doc
        let doc = event.target;


        // Get the app layout element as `appLayoutEl`
        let appLayoutEl = doc.getElementById('appLayout');


        // if the browser supports it...
        if (typeof(Storage) !== 'undefined') {
          // ...get the theme from local storage as `theme`
          let theme = localStorage.getItem('theme');
          // DEBUG [4dbsmaster]: tell me about it :)
          console.log(`[_progressHandler]: theme => ${theme}`);
         
          // if a theme was found in storage...
          if (typeof(theme) == 'string') {
            // ...remove all the themes in body
            doc.body.classList.remove('classic', 'light', 'dark');
            // update the theme
            doc.body.classList.add(theme);
          }
        
        }


        // tdl is READY!!!
        tdl.isReady = true;

        // call the `onReady` function of `tdl`
        tdl.onReady();
        
        
      });
 
    </script>
    
    <!-- Double Psych!!! Some more script for ya! #LOL -->
    <script src="script/app.js"></script>
    
  </head>
  <!-- End of HEAD -->
  
  
  <!-- BODY | Default Theme: light -->
  <!-- TODO: replace 'light' with `currentTheme` PHP variable (eg. < ?= $currentTheme ? >) -->
  <body class="theme light" fullbleed>

    <!-- App Layout -->
    <div id="appLayout" class="flex-layout horizontal" fit>

      <!-- MAIN - App Layout -->
      <main class="flex-layout vertical">

        <!-- App Header -->
        <div id="appHeader">

          <!-- App Bar -->
          <div id="appBar" class="app-bar">

            <!-- PHP: If the current step is not the first... -->
            <?php if (!$isFirstStep) : ?> 
            <!-- PHP: ...show the Back Icon Button -->

            <!-- Back Icon Button -->
            <a href="welcome.php?step=<?= $prevStep ?>" title="Back">
              <button tabIndex="-1" id="backIconButton" class="icon-button">
                <span class="material-icons icon">arrow_back_ios</span>
              </button>
            </a>

            <!-- End of PHP: If the current page is not the first -->
            <?php endif; ?>

            <!-- Title Wrapper -->
            <div class="title-wrapper"></div>
            <!-- End of Title Wrapper -->


            <!-- PHP: If the current step *IS NOT* the last... -->
            <?php if (!$isLastStep) : ?>
            <!-- PHP: ...show the Skip button -->

            <!-- Skip Button -->
            <a id="skipButton" role="button" tabindex="0" href="welcome.php?step=<?= $totalSteps ?>" title="Skip">Skip</a>

            <!-- End of PHP: If the current step *IS NOT* the last -->
            <?php endif; ?>

          </div>
          <!-- End of App Bar -->

        </div>
        <!-- End of App Header -->

        <!-- Content - App Layout -->
        <!-- NOTE: This is arguably the most important content ever!!! -->
        <!-- TODO: (scrollableTarget) - Make it the only scrollable `content` -->
        <div id="content">

          <!-- Container -->
          <div class="container centered vertical flex-layout">
            
            <!-- Doodle -->
            <span class="<?= $getIdByStep($currentStep) ?>-doodle doodle"></span>

            <!-- Display-Title -->
            <h2 class="display-title"><?= $getTitleByStep($currentStep) ?></h2>

            <!-- Display-Subtitle -->
            <p class="display-subtitle"><?= $getDescByStep($currentStep) ?></p>

          </div>
          <!-- End of Container -->

        </div>
        <!-- End of Content - App Layout -->


        <!-- Dots - NAV -->
        <nav id="dots" class="horizontal flex-layout centered">
          <!-- PHP: For each step (index / id) in $steps... -->
          <?php foreach ($steps as $stepIndex => $stepId) : ?>
          <!-- PHP: ...show a corresponding navigation button / link -->
          
          <a id="<?= $stepId ?>Nav" title="<?= $getTitleByStep($stepIndex + 1) ?>" <?= ($stepIndex + 1) !== $currentStep ?: 'active' ?>
             href="welcome.php?step=<?= $stepIndex + 1 ?>" 
             role="button" 
             tabindex="0">
          </a>

          <!-- End of PHP: For each step id in $steps -->
          <?php endforeach; ?>
        </nav>
        <!-- End of Dots - NAV -->

        <!-- FOOTER -->
        <footer class="vertical flex-layout centered">
          <!-- Footer Container -->
          <div class="container">
            <!-- PHP: If the current step *IS* the last... -->
            <?php if ($isLastStep) : ?>
            <!-- PHP: ...show the Get-Started button -->
            <!-- Get Started - BUTTON -->
            <a href="index.php" tabIndex="-1" naked><button contained shrinks>Get Started</button></a>

            <!-- PHP (else): If it *IS NOT* the last step... -->
            <?php else: ?>
            <!-- PHP (else): ...show the Next button -->

            <!-- Next - BUTTON -->
            <a href="welcome.php?step=<?= $nextStep ?>" tabIndex="-1" naked><button contained shrinks>Next</button></a>

            <!-- End of PHP: If the current step *IS* the last -->
            <?php endif; ?>


          </div>
          <!-- End of Footer Container -->
        </footer>
        <!-- End of FOOTER -->


      </main>
      <!-- End of MAIN - App Layout -->

      <!-- Details Container | ASIDE -->
      <aside id="detailsContainer" class="vertical flex-layout centered">
        <!-- Outlined App Logo -->
        <span class="app-logo" outlined></span>

        <!-- Divider @ Vertical Left -->
        <span class="divider vertical left"></span>
      </aside>
      <!-- Details Container | ASIDE -->

    </div>
    <!-- End of App Layout -->



    <!-- Main Backdrop -->
    <div id="backdrop"></div>


    <!-- Main Dialogs Container -->
    <div id="dialogsContainer"></div>

    <!-- Toast -->
    <div id="toast" hidden></div>
    <!-- End of Toast -->

  </body>
  <!-- End of BODY -->

</html>
<!-- End of HTML -->
