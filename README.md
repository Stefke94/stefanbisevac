# stefanbisevac
Simple CMS (Content Managment System) made from pure PHP

This is a simple CMS that I have made for myself and decided to share it. It uses MVC (Model - View - Controller) design.  This particular MVC  design came from Brad Traversy course while I was still learning and grasping the concept of PHP and MVC design pattern. Once I have understood, I added changes (a lot of them) and made this system from ground up. It doesnt use any PHP/JS or any other framework, as stated its pure PHP. This is not a final version of this system as I intend to upgrade it with additional functionalities, but its a basic version that  will do its job. Feel free to use it, change it, study it or whatever your want to do with it. It FREE, as opinion and beer. :)

This CMS has 5 public pages:

1. Homepage
2. About - Page about yourself
3. My work - Page where you can post projects/work that you have done
4. Blog - Page where people can read your blog post
5. Contact - Page where you can put contact info

Also it poses admin area where you can log in and have access to:

6. Adding a post
7. Adding a project
8. See all posts 
9. See all projects

You can add/edit/remove posts and projects. In order to access admin area you have to type in URL yourWebsiteName/users/login so in this case stefanbisevac/users/login . 

So how does all of this works?
-

 Whole CMS is divided into 2 folders:


 - App
 - Public

App is folder that contains files for configurations, controllers, views, models,  libraries (in this case its helpers file, file that has custom made functions), in another words App folder is a place where our applications is. So, this place is not intended for public access and any unwanted guests.

Public is a folder that where users/visitors will go, it posses client-side things like JS, CSS, images etc etc. There is our main file called **index.php** .

 There are htaccess files that are used for hidding extensions of files in URL and for making clean URL and other sort of things. All you have to do is to change the name of website (change **stefanbisevac** to **your website name**) and your are good to go.

Quick recap for newbies  (even pros were newbies once). What is MVC? Its basically making our app modular (making it of parts) and every module aka part has its own job.

MVC = Model - View - Controller
-
Model - Class that is responsible for working with database.

Controller - Class that is responsible for processing input and deciding what to do.

View - Those are files that are output of controller, in another words this is a file that is displayed to users (There is a file that is used for displaying homepage, another one for displaying contact page etc...)


So how our MVC works? If we have our URL like this for example:

    stefanbisevac/blog/showPost/25

you can read it like this

     stefanbisevac/controller/controllerMethod/argumentForMethod

So

	blog = controller // Controller is just a class that is doing something
	showPost = controllerMethod // Method (function in class) of a class
	25 = argumentForFunction // Argument that is going to be passed for method
 
 Some functions demand arguments, some dont. For example, displaying homepage or blog posts, those  do not need arguments but displaying certain blog post it needs to be passes some argument like 5 or any other number.

So basically  our app takes URL, takes it apart and from those parts it starts processing data. In that processing Controller processes data, validates, communicates with Model and lastly it loads View and writes data in View.

Lets say URL is 

	stefanbisevac/blog/showPost/25

Out app, see that **blog** controller is called with its method **showPost** and argument is passed, that is **25** .

So Blog controller starts checking stuff with Model whether that blog post exists, takes data and then it takes View, loads it and passes data that it got from Model and *voila*, you get to see that blog post that you wanted!

File

	index.php
in public folder is main file, that is, its the file where everything happens. That file includes:

	bootstrap.php
this is a file that inlcudes other files that are needed for work (config file, helper file and all Core classes) and it instantiates Core class .

Core class is class that take URL and part it up like I explained up above.

I tried to keep my code readable, clean, concise, well formatted, optimized.
Hope I explained you all of this in a way that you understand.

Oh yeah one more thing. If you want to add user that can access website you have to do it manually in database. It was not laziness,  I did this for myself with intent to have only 1 user on my website, that is me.

Password is encrypted and its stored encrypted in database, so use function

	password_hash('hereGoesYourPassword', PASSWORD_DEFAULT);

to make your password hash and store that into database. For example, you want to create new user, and you say that username will be Thor, so you type in your database, in username field **Thor** and for password you say you want it to be **strongestAvenger** , but in password field we store encrypted password or hash, we dont keep it like this **strongestAvenger** also knows as plain text. Make some php file and write this line of code:

	echo password_hash('strongestAvenger', PASSWORD_DEFAULT);
	
Run it and you will get this kinda output:

	$2y$10$dkzPmUpbWsOG78F0TBETJ.qzkjRIlenUew7BEchFJKKrKcgKO./cq

This is hash of our password **strongestAvenger** that is generated from this functions.  Copy that output and store it in password field.

I have made user for you that uses following credentials:
userName: Thor
password: strongestAvenger



There ya go! :)

If you have any problem or question, feel free to contact me :)
