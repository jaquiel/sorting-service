# sorting-service
-----------------

What is 
-------
This project is a Sorting Service for a Test Assessment designed for sorting data loaded from a ".CSV File".

Requirements
------------
To run this app are necessary this requirements:

* Apache/2.4.18 or Higher

* PHP/5.5.15 or Higher

* Bootstrap 3.2.0

* JQuery 1.8.3

* bootstrap-myfile plugin (http://fernandowobeto.github.io/bootstrap-myfile)

Installation
------------

It's very easy to install this application. After you install and configure the Apache Web Server and PHP, just download the project in the appropriate folder of the web server and run. 


How to use
------------

For run this app just follow the next steps:

* First, if you want to set the parameters for sorting , follow these rules:
  
  * To set paramters open the config.ini file. Open the config.ini file to set parameters. This file  contain 4 sections, corresponding at header titles. Each section contains two settings. They are priority and ordering. Priority defines the priority order in which a title is ordered and ordering defines whether ascending or descending.
  
  Example:
      [Author]
        priority = 2
        ordering = DESC
      [Title]
        priority = 1
        ordering = ASC

  In the example above, the data will first be ordered by "Title" in ascending order and after will be ordered by " Author " in descending order. The absence of any sections or empty parameters are disregarded.

* Second, to run the app:
  
  * Click on the "Select a file" button to select a source file in a ".CSV format" (This project is an example file called "test.csv").
  * Then just click on the "Load Data" button and the data will be displayed as previously configured. 



