Welcome to the AWS CodeStar sample web application
==================================================

This sample code helps get you started with a simple PHP Laravel web
application deployed by AWS Elastic Beanstalk.

What's Here
-----------

This sample includes:

* README.md - this file
* .ebextensions/ - this directory contains the PHP configuration file that
  allows AWS Elastic Beanstalk to deploy your PHP application.  Note that this
  directory contains a Laravel config file (00laravel.config) that includes a
  pre-defined Laravel application key.  This application key should be replaced
  with one you generate (see
  http://laravel-recipes.com/recipes/283/generating-a-new-application-key) for
  details.
* index.php - this file contains the sample application


Getting Started
---------------

These directions assume you want to develop on your local computer, and not
from the Amazon EC2 instance itself. If you're on the Amazon EC2 instance, the
virtual environment is already set up for you, and you can start working on the
code.

To work on the sample code, you'll need to clone your project's repository to your
local computer. If you haven't, do that first. You can find instructions in the
AWS CodeStar user guide.

1. Install PHP.  See http://php.net/manual/en/install.php for details.

2. Install composer.  See https://getcomposer.org/doc/00-intro.md for
   details.

3. Install your dependencies:

        $ php composer.phar install

4. Start the PHP development server:

        $ php artisan serve

5. Open http://127.0.0.1:8000/ in a web browser to view your application.

What Do I Do Next?
------------------

Once you have a virtual environment running, you can start making changes to
the sample PHP web application. We suggest making a small change to index.php
first, so you can see how changes pushed to your project's repository are automatically
picked up by your project pipeline and deployed to the Amazon EC2 instance by AWS Elastic
Beanstalk. (You can watch the pipeline progress on your project dashboard.) Once you've
seen how that works, start developing your own code, and have fun!

Learn more about AWS CodeStar by reading the [user guide][User Guide].  Ask
questions or make suggestions on our [forum][Forum].

[User Guide]: http://docs.aws.amazon.com/codestar/latest/userguide/welcome.html

[Forum]: https://forums.aws.amazon.com/forum.jspa?forumID=248

What Should I Do Before Running My Project in Production?
------------------

AWS recommends you review the security best practices recommended by the framework
author of your selected sample application before running it in production. You
should also regularly review and apply any available patches or associated security
advisories for dependencies used within your application.
