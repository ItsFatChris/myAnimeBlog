# myAnimeBlog
Anime blog that ties into the Jikan API using PHP and Javascript.

Written in PHP, Javascript, HTML, and CSS. 

To run you are going to need have PHP installed and be running a mySQL server.

In dbo.php you need to change the host, user, password, and database name to that of the database which you set up.
The schema for the database is:

Table name: article
Colummns:
articleID BIGINT   PK  NN  UN  AI
articleTitle  VARCHAR(100)  NN
userID  BIGINT  NN  UN
animeID INT NN  UN
starRating  INT NN
body  LONGTEXT  NN
date  TIMESTAMP NN
imageURL  VARCHAR(400)  NN
animeName VARCHAR(200)  NN

Table name: user
Columns:
userID  BIGINT  PK  NN  UQ  UN  AI
username VARCHAR(45)  NN  UQ
password VARCHAR(255) NN
dateCreated TIMESTAMP

It is currently set up to run locally on localhost:8000.

This was our first real web developement project outside of classroom exercises and one that we developed from the ground up without any guidence.  We have spent time learning how to work more in depth with API's as well as set up user sign up and user content submission. We plan to continue working on the project and know that we have a lot of work to do to make our user system more robust for things like reseting passwords and verifying that actual people are signing up.We still need to implement prepared statements for the signup and login pages, but have implemented it throughout the rest of the website. If we were to start over we would probably use something like Firebase for authentication just to make sure everything is secure.
