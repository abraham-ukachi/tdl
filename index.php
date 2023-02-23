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
* @name Home Page - tdl
* @file index.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> open http://localhost/tdl/index.php
* 
*
* ============================
*     >>> DESCRIPTION <<<
* ~~~~~~~~ (French) ~~~~~~~~~
* 
* - Une page d’accueil qui présente votre site (index.php) 
*
* ~~~~~~~~ (English) ~~~~~~~~~
* 
* - A homepage that presents your site (index.php)
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


?><!DOCTYPE html>

<!-- HTML -->
<html lang="en">

  <!-- HEAD -->
  <head>
    <!-- Our 4 VIP metas -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="Home page of tdl">
    
    <!-- Title -->
    <title>Welcome to tdl | by Abraham Ukachi</title>


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
    <link rel="stylesheet" href="assets/stylesheets/home-styles.css">
    
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
        tdl.onReady('home');
        
        
      });

      
    </script>
    
    <!-- Double Psych!!! Some more script for ya! #LOL -->
    <script src="script/app.js"></script>
    
  </head>
  <!-- End of HEAD -->
  
  
  <!-- BODY | Default Theme: light -->
  <body class="theme light" fullbleed>

    <!-- App Layout -->
    <div id="appLayout" class="flex-layout horizontal" fit>
      
      <!-- PHP: Include the vertical & responsive `nav-bar` component here -->
      <?php 
        $_GET['navbar_type'] = 'vertical'; 
        $_GET['navbar_page'] = 'home'; 
        $_GET['navbar_init'] = 'au'; 
        $_GET['navbar_connected'] = 'false'; 
        $_GET['navbar_res'] = 'true'; 
      ?>

      <?php include 'components/nav-bar.php'; ?>

      <!-- MAIN - App Layout -->
      <main class="flex-layout vertical">

        <!-- App Header -->
        <div id="appHeader">

          <!-- App Bar -->
          <div id="appBar" class="app-bar">
            
            <span flex></span>

            <!-- Settings - Icon Button -->
            <a id="settingsIconButton" role="icon-button" tabindex="0" href="settings.php" title="Settings">
              <span class="material-icons icon">settings</span>
            </a>
            <!-- End of Settings - Icon Button -->

          </div>
          <!-- End of App Bar -->

        </div>
        <!-- End of App Header -->

        <!-- Content - App Layout -->
        <!-- NOTE: This is arguably the most important content ever!!! -->
        <!-- TODO: (scrollableTarget) - Make it the only scrollable `content` -->
        <div id="content">


          <!-- [online] Container -->
          <div class="container vertical flex-layout" online hidden>

            <!-- Home Title -->
            <h3 class="home-title txt capitalize">&#9728;&#65039; Good morning, <span>Abraham</span></h3>

            <!-- Home Description -->
            <p class="home-description">Nice to see you again :)</p>

            <!-- Home-Menu -->
            <!-- TODO: Rename to Dashboard ? -->
            <menu class="home-menu">

              <!-- Profile -->
              <li><a href="profil.php?edit">
                <!-- Doodle Wrapper -->
                <div class="doodle-wrapper">
                  <!-- Doodle -->
                  <span class="doodle edit-doodle"></span>
                </div>

                <!-- Label -->
                <span class="label">Edit your profile</span>
              </a></li> 


              <!-- To-do List -->
              <li><a href="todolist.php">
                <!-- Doodle Wrapper -->
                <div class="doodle-wrapper">
                  <!-- Doodle -->
                  <span class="doodle tdl-doodle"></span>
                </div>

                <!-- Label -->
                <span class="label">Create a to-do list</span>
              </a></li> 

              <!-- Language -->
              <li><a href="settings.php?view=lang">
                <!-- Doodle Wrapper -->
                <div class="doodle-wrapper">
                  <!-- Doodle -->
                  <span class="doodle language-doodle"></span>
                </div>

                <!-- Label -->
                <span class="label">Change your language</span>
              </a></li>


              <!-- Theme -->
              <li><a href="settings.php?view=theme">
                <!-- Doodle Wrapper -->
                <div class="doodle-wrapper">
                  <!-- Doodle -->
                  <span class="doodle theme-doodle"></span>
                </div>

                <!-- Label -->
                <span class="label">Change your theme</span>
              </a></li> 

              <!-- Dividers -->
              <div class="dividers" fit>
                <span class="divider horizontal top left"></span>
                <span class="divider vertical top left"></span>
              </div>
              
            </menu>
            <!-- End of Home-Menu -->

          </div>
          <!-- End of [online] Container -->


          
          <!-- [offline] Container -->
          <div class="container vertical flex-layout centered slide-from-down" offline>

            <!-- Home Image -->
            <span class="home-image"></span>

            <!-- Home Title -->
            <h3 class="home-title">Welcome to tdl</h3>

            <!-- Home Description -->
            <p class="home-description">The fastest and easiest way to create / delete an account, modify your profile, create an unlimited number of <em>to-do list</em> with tasks and more... Get started by logging into your account.</p>
           
            <!-- Register - Button -->
            <a id="registerButton" role="button" tabindex="0" href="register.php" contained>Register</a>

            <!-- Login - Button -->
            <a id="loginButton" role="button" tabindex="0" href="login.php">Log In</a>
            
          </div>
          <!-- End of [offline] Container -->


        </div>
        <!-- End of Content - App Layout -->

        <!-- PHP: Include the horizontal `nav-bar` component here -->
        <?php 
          $_GET['navbar_type'] = 'horizontal'; 
          $_GET['navbar_page'] = 'home'; 
          $_GET['navbar_init'] = 'au'; 
          $_GET['navbar_connected'] = 'false'; 
          $_GET['navbar_res'] = 'true'; 
        ?>

        <?php include 'components/nav-bar.php'; ?>
        
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


    <!-- Backdrop -->
    <div id="backdrop" hidden></div>


    <!-- Dialogs Container -->
    <div id="dialogsContainer" hidden></div>
    <!-- End of Dialogs Container -->


    <!-- Toast -->
    <div id="toast" hidden></div>
    <!-- End of Toast -->

  </body>
  <!-- End of BODY -->

</html>
<!-- End of HTML -->
