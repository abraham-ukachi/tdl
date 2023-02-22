# `tdl`
> IMPORTANT: This is a working progress and subject to major changes until the specified deadline below.

A school project to create a simple **to-do list** Web App using `PHP` and `JavaScript`.

For this project, I decided to create a MySQL Database named **`tdl`** obv. 😜 with the following tables (including a couple of TRIGGERS):

- *`users`*: All currently registered users.
- *`todolists`*: All created to-do lists by registered users.
- *`tasks`*: All tasks created by a user in relation to a previously created `todolists`.
- *`tasks_audit`*: To keep changes made to the `tasks` table.
- *`todolists_priv`* (Privileges) : All permissions that allow a user to **CREATE**, **UPDATE** and/or **DELETE** a to-do list for another user.

> NOTE: For more info, [read the Database section](#Database) of this *README*. 


## Description 
> Original text in French: Les jobs étant plus longs et plus compliqués, votre emploi du temps devient de plus en plus chargé et certaines tâches risquent de passer à la trappe. C’est un souci ...
En tant que programmeur, la solution est toujours de développer les outils permettant de pallier aux défaillances de faibles humains. C’est pourquoi ce Job consiste à développer votre propre ToDoList. 

The jobs being longer and more complicated, your schedule becomes more and more busy and some tasks may fall by the wayside. It's a concern...

As a programmer, the solution is always to develop the tools to overcome the shortcomings of weak humans.
That's why this Job is about developing your own ToDoList.

## Requirements

These are a couple of the main requirements for this school project:

1. The site must include an **index.php** page allowing any user to create an account and connect to it. Once logged in, the site user should be redirected to a **todolist.php** page. This page should contain:

- A list of tasks to do accompanied by their creation date. It must be possible, with a button or otherwise, to specify that a task has been completed or cancelled. This task should be removed from the list
- A list of completed tasks where each task is accompanied by the date it was completed.
- An input allowing to create a task.
- A disconnect button to... disconnect.

**With the exception of the logout button, none of the possible actions on the _`todolist.php`_ page should cause the page to reload.**
 
2. _(Optional)_ For people who want help planning their tasks (and who are brave developers), add to your todolist.php page:
- An input allowing to give planning rights to a user other than yourself.
- A drop-down menu containing the list of users for whom you can schedule tasks (including yourself). This drop-down menu will allow you to choose who to schedule a new task to.


## Jobs
> MOTTO: I'll always do [**more**](#More) 😜

The official deadline of the jobs below - according to [intra](https://intra.laplateforme.io) - was **25-02-2023 at 08:28 A.M**. Here is a list of all the `php` files to be submitted as well as their corresponding / current **status** for this

| No. | Name | File | Status |
|:----|:-----|:-----|:-------|
| 1 | *`Home - Page`* | **index.php** | Pending |
| 2 | *`Todolist - Page`* | **todolist.php** | Pending |
| 3 | *`Todolist - Database - SQL`* | **tdl.sql** | Pending |

> NOTE: (\*) = still needs to be updated



## Structure

The folder & file structure of this project:
 
- [**api**](./api)
- - *Database.php*
- - *User.php*
- - *TodoList.php*
- - ...
- [**assets**](./assets/)
- - [**logos**](./assets/logos/)
- - [**images**](./assets/images/)
- - ...
- - [**animations**](./assets/animations/)
- - * *fade-in-animation.css*
- - * *pop-in-animation.css*
- - * *slide-from-down-animation.css*
- - [**theme**](./assets/theme/)
- - * *color.css*
- - * *typography.css*
- - * *styles.css*
- - [**stylesheets**](./assets/stylesheets)
- - * *home-styles.css*
- - * *splash-screen-styles.css*
- - * *login-styles.css*
- - * *register-styles.css*
- - * *profile-styles.css*
- [**components**](./components)
- [**script**](./script/)
- - *app.js*
- ...
- LICENSE
- README.md
- manifest.json
- ...
- **index.php**
- **todolist.php**
- **tdl.sql**

> NOTE: This is just a snippet.



## Database
> HEADS-UP: I do love me some TRIGGERS, so do not be shocked to see a couple in this database #LOL

The following tables were created in a MySQL database named **`tdl`** via [PDO](https://www.php.net/manual/en/class.pdo.php) on [phpmyadmin](http://localhost/phpmyadmin):

> NOTE: **`⨁`** = _FOREIGN_KEY_

### `users` - MySQL Table

| No. | Name | Type | Length | Null | Default | Extra |
|:----|:-----|:-----|:-------|:-----|:--------|:-------|
| 1 | *`id`* 🔑 | **INT** | 10 | No | NULL | **AUTO_INCREMENT** | 
| 2 | *`login`* | **VARCHAR** | 30 | No | NULL | - | 
| 3 | *`password`* | **VARCHAR** | 255 | No | NULL | - | 
| 4 | *`firstname`* | **VARCHAR** | 30 | No | NULL | - | 
| 5 | *`lastname`* | **VARCHAR** | 30 | No | NULL | - | 
| 6 | *`created_at`* | **DATETIME** | - | Yes | NULL | - |  



### `todolists` - MySQL Table

| No. | Name | Type | Length | Null | Default | Extra |
|:----|:-----|:-----|:-------|:-----|:--------|:-------|
| 1 | *`id`* 🔑  | **INT** | 10 | No | NULL | **AUTO_INCREMENT** |
| 2 | *`name`* | **VARCHAR** | 60 | No | NULL | - |
| 3 | *`user_id`* ⨁ | **INT** | 10 | No | NULL | - |
| 4 | *`owner_id`* ⨁ | **INT** | 10 | No | NULL | - |
| 5 | *`created_at`* | **DATETIME** | - | Yes | NULL | - |



### `tasks` - MySQL Table
> ⚠️  WARNING: This table contains one or more TRIGGERs

| No. | Name | Type | Length | Null | Default | Extra |
|:----|:-----|:-----|:-------|:-----|:--------|:-------|
| 1 | *`id`* 🔑  | **INT** | 10 | No | NULL | **AUTO_INCREMENT** |
| 2 | *`description`* | **VARCHAR** | 255 | No | NULL | - |
| 3 | *`todolist_id`* ⨁ | **INT** | 10 | No | NULL | - |
| 4 | *`completed`* | **BOOLEAN** | 1 | Yes | NULL | - |
| 5 | *`completed_at`* | **DATETIME** | - | Yes | NULL | - |
| 6 | *`created_at`* | **DATETIME** | - | Yes | NULL | - |



### `tasks_audit` - MySQL Table
> ⚠️  WARNING: This table is used by one or more TRIGGERs from the `tasks` table.

| No. | Name | Type | Length | Null | Default | Extra |
|:----|:-----|:-----|:-------|:-----|:--------|:-------|
| 1 | *`id`* 🔑  | **INT** | 10 | No | NULL | **AUTO_INCREMENT** |
| 2 | *`task_id`* ⨁ | **INT** | 10 | No | NULL | - |
| 3 | *`task_description`* ⨁ | **VARCHAR** | 255 | No | NULL | - |
| 4 | *`task_completed`* ⨁ | **BOOLEAN** | 1 | Yes | NULL | - |
| 5 | *`changed_at`* | **DATETIME** | - | Yes | NULL | - |
| 6 | *`action`* | **VARCHAR** | 30 | Yes | NULL | - |



### `todolists_priv` - MySQL Table

| No. | Name | Type | Length | Null | Default | Extra |
|:----|:-----|:-----|:-------|:-----|:--------|:-------|
| 1 | *`grantor_id`* ⨁ | **INT** | 10 | No | NULL | - |
| 2 | *`user_id`* ⨁ | **INT** | 10 | No | NULL | - |
| 3 | *`timestamp`* | **TIMESTAMP** | - | Yes | NULL | - |
| 4 | *`create_priv`* | **TINYINT** | 0 | Yes | NULL | - |
| 5 | *`update_priv`* | **TINYINT** | 0 | Yes | NULL | - |
| 6 | *`delete_priv`* | **TINYINT** | 0 | Yes | NULL | - |

> NOTE: `grantor_id` is the id number of the person granting the permissions to the grantee. ;)


## Installation
> IMPORTANT: Make sure you have [`XAMPP`](https://www.apachefriends.org/) already installed on your computer before proceeding.

1. Clone this project's repository
```sh
git clone https://github.com/abraham-ukachi/tdl.git
```

> NOTE: There's no need to change the current working directory to **tdl**


2. Now, create a symbolic link of **tdl** in the `XAMPP`'s **htdocs** folder:

-   **On Mac**

```sh
ln -s "$(pwd)/tdl" /Applications/XAMPP/htdocs/tdl
```

-   **On Linux**

```sh
ln -s "$(pwd)/tdl" /opt/lampp/htdocs/tdl
```

3. Open the **tdl** folder in your default browser:

```sh
open http://localhost/tdl
```



---

## Testing

| Browser | Version | Status | Date | Time
|:--------|:--------|:-------|:-----|:-----
| *`Brave`* | **1.45.127** | [Tested](http://localhost/tdl/welcome.php) | 21-02-2023 | 21:52:50
| *`Chrome`* | **-** | *Pending* | - | -
| *`Firefox`* | **-** | *Pending* | - | -
| *`Safari`* | **-** | *Pending* | - | -
| *`Opera`* | **-** | *Pending* | - | -
| *`Edge`* | **-** | *Pending* | - | -
| *`IE`* | **-** | *Pending* | - | -

> NOTE: *`IE`* = Internet Explorer = 👎🏽


## More 

These are some of the things I did or plan to do, in addition to this project's [job requirements](#Requirements):

| No. | Name | File | Status |
|:----|:-----|:-----|:-------|
| 1 | *`Register - Page`* | **register.php** | Pending |
| 2 | *`Login - Page`* | **login.php** | Pending |
| 3 | *`Profile - Page`* | **profile.php** | Pending |
| 4 | *`Admin - Page`* | **admin.php** | Pending | 
| 5 | *`SplashScreen - Page`* | **splash-screen.php** | [Done](splash-screen.php)\* |
| 6 | *`Logout - Page`* | **logout.php** | Pending |
| 7 | *`Database - API`* | **Database.php** | Pending |
| 8 | *`User - API`* | **User.php** | Pending |
| 9 | *`ResponseHandler - API`* | **ResponseHandler.php** | Pending |
| 10 | *`TodoList - API`* | **TodoList.php** | Pending |
| 11 | *`Pop In - Animation`* | **pop-in-animation.css** | [Done](assets/animations/pop-in-animation.css) |
| 12 | *`Fade In - Animation`* | **fade-in-animation.css** | [Done](assets/animations/fade-in-animation.css) |
| 13 | *`Slide From Down - Animation`* | **slide-from-down-animation.css** | [Done](assets/animations/slide-from-down-animation.css) |
| 14 | *`Language Update - API`* | **lang_update.php** | Pending |
| 15 | *`Theme Update - API`* | **theme_update.php** | Pending |
| 16 | *`Internationalization - API`* | **internationalization.php** | Pending |
| 17 | *`Settings - Page`* | **settings.php** | Pending |
| 18 | *`Welcome - Page`* | **welcome.php** | Pending |
| 19 | *`Goodbye - Page`* | **goodbye.php** | Pending |
| 20 | *`Slide From Up - Animation`* | **slide-from-up-animation.css** | [Done](assets/animations/slide-from-up-animation.css) |
| 21 | *`Welcome - Stylesheet`* | **welcome-styles.css** | Pending |
| 22 | *`Home - Stylesheet`* | **home-styles.css** | Pending |
 

> NOTE: (\*) = still needs to be updated. <br>
> There's certainly a couple of file I must've forgot or not added yet,so I'll keep the above list updated obv. :)

## TODOs

- [ ] ? Rename this project from `tdl` to `tdl-web-app`
- [ ] Add a **log out button** in the **narrow layout** of *`Settings - Page`* 
- [ ] Show a toast after a preference change or settings update.
- [ ] Apply the **slide-from-up** animation to dialogs.
- [x] Change the default input text & background color for Brave's autocomplete
- [ ] Create a project-specific logo 
- [ ] Add localization / internationalization (at least: **english** & **french**)
- [x] Add mobile compatibility to all pages (i.e. make it responsive)
- [ ] Optimize `.svg` doodles
- [ ] Optimize all `.php` files
- [ ] Optimize all `.css` files
- [ ] Optimize all `.js` files
- [ ] Remove unnecessary comments
- [ ] Add screenshots

---

## Some Random Screenshots


### On Mobile

| Classic Mode | Light Mode | Dark Mode |
|:-------------|:-----------|:----------|
| N/A | N/A | N/A |


### On Laptop

| Classic Mode | Light Mode | Dark Mode |
|:-------------|:-----------|:----------|
| N/A | N/A | N/A |
