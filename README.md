# Mail My Friend

*tell-a-friend form emailer, that also writes the submitted data to the database.*

### specification
- a front-end made to good standards (mobile responsiveness, accessibility etc.)
- a form that lets a visitor enter a friend's details in order to send the friend an email with the URL of the site.
- the visitor's name & email, as well as the friend's name & email are also written to a database.

## technologies used:

- [PHP 7.2.8](http://php.net/)
- [MySQL](https://www.mysql.com/)
- CSS with flexbox

## installation:

1. The easiest way to test the site is to have an all-in-one web service stack such as [XAMPP](https://www.apachefriends.org/index.html), [MAMP](https://www.mamp.info/en/), [LAMP](https://en.wikipedia.org/wiki/LAMP_(software_bundle)) or [WampServer](http://www.wampserver.com/en/) in place.

2. The demo works with a MySQL database containing a recommendations table, which you need to manually set up first. You can choose their names and then specify these in *form.php* under the *$mydatabase* and *$mytable*. *$mytable* needs the following column names (you must set ID as primary key & to auto-increment):

		ID
        customername
        customeremail
        friendsname
        friendsemail

3. When in production, make sure to comment out the database connection debugging messages in *form.php* (as indicated in the comments).

4. The website text of the demo is in Italian, but the backend is entirely in English, so it should be fairly straightforward to change the front-end into your local language.