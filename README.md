# `tdl`
> IMPORTANT: This is a working progress and subject to major changes until the specified deadline below.

A school project to create a simple **to-do list** Web App using `PHP` and `JavaScript`.

For this project, I decided to create a MySQL Database named **`tdl`** obv. 😜 with the following tables:

- *`users`*: All currently registered users.
- *`todolists`*: All created to-do lists by registered users.
- *`todolists_owners`*: All to-do lists and their corresponding owners.
- *`tasks`*: All tasks created by a user in relation to a previously created `todolist`.
- *`tasks_audit`*: To keep changes made to the `tasks` table.
- *`priv`* (Privileges) : All users allowed to create a `todolist` for another user / owner / host.

> NOTE: For more info, [read the Database section](#Database) of this *README*. 


## Description 
> Original text in French: 

You

## Requirements

These are a couple of the main requirements for this school project:

1. Create  


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
- - *Todo.php*
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
- - * *ddd-studio-styles.css*
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
> ⚠️  WARNING: This table does not contain any TRIGGERs (for now 😉)

| No. | Name | Type | Length | Null | Default | Extra |
|:----|:-----|:-----|:-------|:-----|:--------|:-------|
| 1 | *`id`* 🔑 | **INT** | 10 | No | NULL | **AUTO_INCREMENT** | 
| 2 | *`login`* | **VARCHAR** | 30 | No | NULL | - | 
| 3 | *`password`* | **VARCHAR** | 255 | No | NULL | - | 
| 4 | *`firstname`* | **VARCHAR** | 30 | No | NULL | - | 
| 5 | *`lastname`* | **VARCHAR** | 30 | No | NULL | - | 
| 6 | *`created_at`* | **DATETIME** | - | Yes | NULL | - |  



### `todolists` - MySQL Table
> ⚠️  WARNING: This table contains one or more TRIGGERs

| No. | Name | Type | Length | Null | Default | Extra |
|:----|:-----|:-----|:-------|:-----|:--------|:-------|
| 1 | *`id`* 🔑  | **INT** | 10 | No | NULL | **AUTO_INCREMENT** |
| 2 | *`name`* | **VARCHAR** | 60 | No | NULL | - |
| 3 | *`user_id`* ⨁ | **INT** | 10 | No | NULL | - |
| 4 | *`created_at`* | **DATETIME** | - | Yes | NULL | - |



### `todolists_owners` - MySQL Table
> ⚠️  WARNING: This table is used by one or more TRIGGERs from the `todolists` table.

| No. | Name | Type | Length | Null | Default | Extra |
|:----|:-----|:-----|:-------|:-----|:--------|:-------|
| 1 | *`id`* 🔑  | **INT** | 10 | No | NULL | **AUTO_INCREMENT** |
| 2 | *`todolist_id`* ⨁  | **INT** | 10 | No | NULL | - |
| 3 | *`user_id`* ⨁  | **INT** | 10 | No | NULL | - |
| 4 | *`action`* | **VARCHAR** | 30 | Yes | NULL | - |



### `tasks` - MySQL Table
> ⚠️  WARNING: This table contains one or more TRIGGERs

| No. | Name | Type | Length | Null | Default | Extra |
|:----|:-----|:-----|:-------|:-----|:--------|:-------|
| 1 | *`id`* 🔑  | **INT** | 10 | No | NULL | **AUTO_INCREMENT** |
| 2 | *`description`* | **VARCHAR** | 255 | No | NULL | - |
| 3 | *`todolist_id`* ⨁ | **INT** | 10 | No | NULL | - |
| 4 | *`completed`* | **BOOLEAN** | 0 | Yes | NULL | - |
| 5 | *`completed_at`* | **DATETIME** | - | Yes | NULL | - |
| 6 | *`created_at`* | **DATETIME** | - | Yes | NULL | - |



### `tasks_audit` - MySQL Table
> ⚠️  WARNING: This table is used by one or more TRIGGERs from the `tasks` table.

| No. | Name | Type | Length | Null | Default | Extra |
|:----|:-----|:-----|:-------|:-----|:--------|:-------|
| 1 | *`id`* 🔑  | **INT** | 10 | No | NULL | **AUTO_INCREMENT** |
| 2 | *`task_id`* ⨁ | **INT** | 10 | No | NULL | - |
| 3 | *`task_description`* ⨁ | **VARCHAR** | 255 | No | NULL | - |
| 4 | *`task_completed`* ⨁ | **BOOLEAN** | 0 | Yes | NULL | - |
| 5 | *`changed_at`* | **DATETIME** | - | Yes | NULL | - |
| 6 | *`action`* | **VARCHAR** | 30 | Yes | NULL | - |



### `priv` - MySQL Table

| No. | Name | Type | Length | Null | Default | Extra |
|:----|:-----|:-----|:-------|:-----|:--------|:-------|
| 1 | *`grantor_id`* ⨁ | **INT** | 10 | No | NULL | - |
| 2 | *`user_id`* | **INT** | 10 | No | NULL | - |
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
| 5 | *`SplashScreen - Page`* | **splash-screen.php** | Pending |
| 6 | *`Logout - Page`* | **logout.php** | Pending |
| 7 | *`Database - API`* | **Database.php** | Pending |
| 8 | *`User - API`* | **User.php** | Pending |
| 9 | *`ResponseHandler - API`* | **ResponseHandler.php** | Pending |
| 10 | *`TodoList - API`* | **TodoList.php** | Pending |
| 11 | *`Pop In - Animation`* | **pop-in-animation.css** | Pending |
| 12 | *`Fade In - Animation`* | **fade-in-animation.css** | Pending |
| 13 | *`Slide From Down - Animation`* | **slide-from-down-animation.css** | Pending |
| 14 | *`Language Update - API`* | **lang_update.php** | Pending |
| 15 | *`Theme Update - API`* | **theme_update.php** | Pending |
| 16 | *`Internationalization - API`* | **internationalization.php** | Pending |
| 17 | *`Settings - Page`* | **settings.php** | Pending |
| 18 | *`Welcome - Page`* | **welcome.php** | Pending |
| 19 | *`Goodbye - Page`* | **goodbye.php** | Pending |
| 20 | *`Slide From Up - Animation`* | **slide-from-up-animation.css** | Pending |
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
