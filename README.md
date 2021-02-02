<img src="https://media-exp1.licdn.com/dms/image/C560BAQEUERSyZ7Czuw/company-logo_200_200/0/1585067951462?e=2159024400&v=beta&t=yZTy6SnnR4xeNlhF0KKN_FRECfTKf2ywfp0WP-6cm1I">

<h1>Fullcomms Technical Test</h1>

<h3>Introduction</h3>
<small>The scenario is purely fiction</small>
<p> </p>
<p>At Fullcomms our developers within the development team are not the greatest cooks. Majority of the time they
 prefer to order some food in to eat whilst working away at code or like to wonder to a restaurant where someone will
  cook for them because why waste time cooking food when you can spend it on coding.
</p>

<p>The one thing the team all agrees on is that where ever they go to eat at or they choose to order from, the
 establishment chosen must have a good food hygiene rating as they would rather not find chefs hair or unclean food
  in their orders.
</p>

<p>Looking up various restaurants on Google and searching for their Food Hygiene rating can be time consuming so would
 like to develop a quick web application they can use to find all the cleanest places to eat (disregarding location
 ), however they've not got the time to do it.</p>
 
 <p>Fortunately for you, you've discovered their is <b>Food Hygiene Rating Scheme (FHRS) <a href="https://api.ratings.food.gov.uk/help">API</a></b> available
  where
  this
  information is widely available for use.
 </p>
 
 <h3>Task</h3>
 <p>Using your spare time and development skill set, you are going to develop a small system which will consume the
  <b>FHRS API</b> and store the information locally using a database of your choosing. You will use the <b>Laravel
   Framework</b> to utilise its features and deliver the solution using this framework.</p>
   
   <p>Your work will also allow for the developers to interact with the database using your own exposed API within
    the framework so they can Create, Update and Delete the information saved to the database without having to
     directly interacting with the FHRS API.
   </p>
  
 <h5>Requirements</h5>
 <p>To break down the task into smaller sections, the following requirements are expected to be implemented</p>
 <ul>
 <li>A way in which the FHRS API can be consumed and saved to a MySQL database or one of your choosing.</li>
 <li>A small web form view where the lazy developers can put in a location / region and see the information. e.g
 . Manchester will return all data relating to manchester
  </li>
  <li>A way of ordering the data from highest rating to lowest as well as alphabetically.</li>
 <li>A small RESTful API which other developers can then use to access your saved database and make changes.</li>
 </ul>
 
 <h5>Setup & Notes</h5>
 <p>A suitable environment either locally, with a VM or using Docker to be able to run the following;</p>
 <ul>
 <li>PHP</li>
 <li>Database e.g. MySQL</li>
 <li>Composer</li>
 </ul>
 
 <p>To get you started a basic Laravel (version 8.X) has been setup with a sample API controller, routing and database
  table with seeder. We've also included a debug bar so you can see what the application is doing.</p>
  <p>Once copied down you can run <code>composer install</code> which will install all the foundations, additionally
   you can also run <code>php artisan migrate --seed</code> this will make a users table with 1 Admin and 10 fake
    users which you can then use the sample api route to see what type of response is returned.
   </p>
   
   <p>You should take some time to look at the FHRS API and see what type of data is returned, you should also use
    this data to define your database tables and models to be created by you.
   </p>
   
   <p>Documentation for the framework can be found here <a href="https://laravel.com/docs/8.x/installation">Laravel Docs</a></p>
   <p>FHRS API documents can be found here <a href="https://api.ratings.food.gov.uk/Help/Index">FHRS API</a></p>
   
<h3>Delivery & Assessment</h3>
<p>Once you've completed this task you should inform us as well as provide us with a copy of the code either via
 repository or via a .ZIP file, please do not upload any node_modules or vendor folders as we would like to see if
  you've used any additional packages and observe how the application runs from fresh.
</p>

<p>We are looking at your ability to work with PHP & Laravel framework, how well you leverage the built in features
 as well as how you write your code and the logic behind it.
</p>

<p>The frontend visuals are not important though
 if you want to show off any additional skill set you are fee to do so as long as the end result works.
</p>
