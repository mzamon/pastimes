IIE Module Outline           
WEDE6021 
WEB DEVELOPMENT (INTERMEDIATE) 
WEDE6021/w 
Module Outline 2026 
(First Edition: 2021) 
This guide enjoys copyright under the Berne Convention. In terms of the Copyright Act, no 98 
of 1978, no part of this manual may be reproduced or transmitted in any form or by any means, 
electronic or mechanical, including photocopying, recording or by any other information 
storage and retrieval system without permission in writing from the proprietor. 
The Independent Institute of Education (Pty) Ltd is registered with the 
Department of Higher Education and Training as a private higher 
education institution under the Higher Education Act, 1997 (reg. no. 
2007/HE07/002). Company registration number: 1987/004754/07. 
© The Independent Institute of Education (Pty) Ltd 2026  
Page 1 of 23 
IIE Module Outline           WEDE6021 
© The Independent Institute of Education (Pty) Ltd 2026  Page 2 of 23 
Table of Contents 
 
Introduction ............................................................................................................................... 3 
Using this Module Outline .......................................................................................................... 4 
This Module on Arc .................................................................................................................... 5 
Module Purpose ......................................................................................................................... 8 
Module Outcomes ...................................................................................................................... 8 
Assessments ............................................................................................................................... 9 
Module Pacer ........................................................................................................................... 12 
 
  
IIE Module Outline           
WEDE6021 
Introduction 
This module aims to teach you to develop database driven websites using appropriate server
side scripting and DBMS. 
Up to this point you have been exposed to three important areas with regards to software 
development, namely: Programming (Java and C#), Databases and Web interfaces.  In this 
module you will integrate these types of technologies such that you are able to create a well
designed web-solution that meets given business requirements. 
At this point it is important that you read the PREFACE in the textbook. 
It is also important for you to recap your programming and database skills. Note that MySQL 
syntax is similar to MS SQL Server. 
During this module you must be able to create ERDs and write SQL to create a database. You 
will also be required to write code that will provide users with an interface to the database. 
© The Independent Institute of Education (Pty) Ltd 2026  
Page 3 of 23 
IIE Module Outline           
WEDE6021 
Using this Module Outline 
This module outline has been developed to support your learning. Please note that the content 
of this module is on Arc as well as in the prescribed material. You will not succeed in this 
module if you focus on this document alone. 
 
 
This document does not reflect all the content on Arc , the links to difference resources, 
nor the specific instructions for the group and individual activities.  
Your lecturer will decide when activities are available/open for submission and when 
these submissions or contributions are due. Ensure that you take note of 
announcements made during lectures and/or posted within Arc in this regard. 
© The Independent Institute of Education (Pty) Ltd 2026  
Page 4 of 23 
IIE Module Outline           WEDE6021 
© The Independent Institute of Education (Pty) Ltd 2026  Page 5 of 23 
This Module on Arc  
 
Arc is an online space, designed to support and maximise your learning in an active manner. 
Its main purpose is to guide and pace you through the module. In addition to the information 
provided in this document, you will find the following when you access Arc : 
 
 A list of prescribed material; 
 A variety of additional online resources (articles, videos, audio, interactive graphics, etc.) 
in each learning unit that will further help to explain theoretical concepts; 
 Critical questions to guide you through the module’s objectives; 
 Collaborative and individual activities (all of which are gradable) with time-on-task 
estimates to assist you in managing your time around these; 
 Revision questions, or references to revision questions, after each learning unit. 
 
Kindly note: 
 Unless you are completing this as a distance module, Arc does not replace your contact 
time with your lecturers and/or tutors.  
 WEDE6021 is an Arc module, and as such, you are required to engage extensively with 
the content on the Arc platform. Effective use of this tool will provide you with 
opportunities to discuss, debate, and consolidate your understanding of the content 
presented in this module.  
 You are expected to work through the learning units on Arc in your own time – 
especially before class. Any contact sessions will therefore be used to raise and 
address any questions or interesting points with your lecturer, and not to cover every 
aspect of this module. 
 Your lecturer will communicate submission dates for specific activities in class and/or 
on Arc. 
 
REMEMBER: 
 
You need to log onto Arc to: 
 Access online resources such as articles, interactive graphics, explanations, video clips, 
etc. which will assist you in mastering the content; and 
 View instructions and submit or post your contributions to individual or group activities 
which are managed and tracked on Arc. 
 
  
IIE Module Outline           WEDE6021 
© The Independent Institute of Education (Pty) Ltd 2026  Page 6 of 23 
Module Resources 
Prescribed Material (PM) for 
this Module 
PM1: Gosselin, D., Kokoska, D. and Easterbrooks, R. 2011. 
PHP Programming with MySQL. 2nd edition. Boston, USA. 
Course Technology. ISBN-13: 9780538745840.  
 
Recommended Readings, 
Digital, and Web Resources 
Ullman, L. 2016. PHP for the World Wide Web (Visual 
Quickstart Guides). Peachpit Press. Fifth Edition. ISBN-10: 
0-134-29125-5 
Some useful web links: 
Cloudways references all PHP editors with links to the 
specific sites 
 https://www.cloudways.com/blog/top-ide-and
code-editors-php-development/   
(Accessed 08 February 2021) 
 
W3Schools is a mine of general information on Internet 
development tools 
http://www.w3schools.com/php/default.asp 
(Accessed 08 February 2021) 
 
How to install WAMP Server 3.3.2 on Windows 10/11 [ 
2024 Update ] Step-by-Step Installation guide 
 https://www.youtube.com/watch?v=M2at7D-lciw 
[Accessed 14 August 2024] 
 
 
Apache Friends shows all webservers and tools 
 https://www.apachefriends.org/index.html            
(Accessed 08 February 2021) 
 
Notepad++ is the recommended source used during 
lecturing. 
 https://notepad-plus-plus.org/downloads/ 
 
Netbeans is a holistic editor/compiler 
 https://netbeans.org/  
           (Accessed 08 February 2021) 
 
Sublime is another PHP editor 
 https://www.sublimetext.com/   
IIE Module Outline           WEDE6021 
© The Independent Institute of Education (Pty) Ltd 2026  Page 7 of 23 
           (Accessed 08 February 2021) 
Please note that several additional resources and links to 
resources are provided throughout this module on the Arc 
platform. You are encouraged to engage with these as they 
will assist you in mastering the various objectives of this 
module. They may also be useful resources for completing 
any assignments. You will not, however, be assessed under 
examination conditions on any additional or recommended 
reading material. 
Software required  Wamp or Xampp Webservers as given above and any of 
the editors above. Please note that Notepad++ will be used 
for instruction. In extreme cases the student may install 
Apache webserver, MySQL and PHP as separate software 
applications. It is recommended to use Wamp or Xampp all 
in one software application installations. 
Software Licence 
requirements 
Free and open source cross-platform web server solution 
stack package developed by Apache Friends. 
Some of the editors may be commercially available, but on 
the whole they are free. Please check the status before 
downloading. Notepad++ is free will be used during 
instruction. 
System Requirements Any PC platform from Windows 7 upwards recommended. 
Compatible OS: Windows XP SP3+, Windows Vista SP2+, 
Windows Server 2003 SP2+, Windows 7, Windows Server 
2008, Windows Server 2008 R2, Windows 8, 8.1, Windows 
10. 
Space: Capacity of minimum 1.5GB Hard Disk space. 
 Memory: 1GB RAM. 
Lab minimum requirements The webserver must be installed on each workstation with 
an area where the student can store and run scripts. These 
scripts will only run from the www (wamp) or htdocs 
(xampp) folder, but the folder can be mapped on the 
network as a logical drive per user. 
 
Lab configuration settings Run on host Computer – Standalone Machine. 
Module Overview You will find an overview of this module on Arc under the 
Module Information link in the Course Menu. 
Assessments  
 
Find more information on this module’s assessments in 
this document and on the Student Portal. 
 
  
IIE Module Outline           
WEDE6021 
Module Purpose 
The purpose of this module is to teach students to develop database driven websites using 
appropriate server-side scripting and DBMS. 
Module Outcomes 
MO1 Demonstrate knowledge and understanding of principles, key concepts and 
practices of database driven websites. 
MO2 Apply website development techniques to create appropriate database driven 
websites. 
© The Independent Institute of Education (Pty) Ltd 2026  
Page 8 of 23 
IIE Module Outline           WEDE6021 
© The Independent Institute of Education (Pty) Ltd 2026  Page 9 of 23 
Assessments 
 
Integrated Curriculum Engagement (ICE) 
Minimum number of ICE activities to complete 4 
Weighting towards the final module mark 10% 
 
Formatives Part 1  Part 2 
Weighting 25% 30% 
Duration 10 hours 10 hours 
Period Period 3 Period 5 
Total 
Marks 
100 100 
Group 
Work 
Maximum of two team members Maximum of two team members 
Learning 
Units 
covered 
LU1-4 LU1-5 
Resources 
required 
Textbook; 
Internet; Module’s software; Lab 
time. 
Textbook; 
Internet; Module’s software;  
Lab time. 
 
Summative POE 
Weighting 35% 
Duration 15 hours 
Total marks 100 
Group Work Maximum of two team members 
Open/Closed 
book 
Open Book 
Resources 
required 
POE combined with Part 1 and 2 and additional requirements. 
MS Office/ Visio; Textbook; Module’s software. 
Learning Units 
covered 
All 
 
  
IIE Module Outline           WEDE6021 
© The Independent Institute of Education (Pty) Ltd 2026  Page 10 of 23 
Assessment Preparation Guidelines 
Format of the Assessment Preparation Hints 
Part 1 
This Part will challenge you to 
do some independent reading 
and programming on the 
material covered in LU1–4, as all 
of this may not have been 
covered in class yet. This is a 
generic task so you will be 
expected to submit a task 
uniquely different from your 
classmates although achieving 
the same objectives. It is 
advisable to create the 
documentation for this Part 
while you are busy creating the 
application. This documentation 
is not for submission now but is 
required for your POE.  
 
 It is recommended that you look at PHP and MySQL 
examples when working on your task.  
 Note: Even though you should look at other 
examples of PHP code, you may not copy code 
directly from a source without referencing correctly.  
 You will need a text editor to type in your PHP code 
and an internet connection.  
 Other resources may be required.  
Part 2 
Even though LU1–4 was 
assessed in the first Part, the 
focus in Part 2 will be on LU4-5. 
This is a generic task so you will 
be expected to submit a Part 
uniquely different from your 
classmates although achieving 
the same objectives. It is 
advisable to create the 
documentation for this task 
while you are busy creating the 
application. This documentation 
is not for submission now but is 
required for your POE. 
 It is recommended that you look at PHP and MySQL 
examples when working on your task.  
 Note: Even though you should look at other 
examples of PHP code, you may not copy code 
directly from a source without referencing correctly.  
 You will need an editor to type in your PHP code and 
an internet connection.  
 Other resources may be required. Complete during. 
  
IIE Module Outline           
WEDE6021 
POE 
 
 
 
It is recommended that you look at PHP and MySQL 
examples when working on your task.  
The focus in this task will be 
LU1 – 6. The POE will 
consist of a collection of 
the two previously 
submitted Parts that have 
been improved based on 
the feedback received from 
your lecturer. All the 
supporting documentation 
in the POE specifications 
must also be included. 
Note: Even though you should look at other examples of 
PHP code, you may not copy code directly from a source 
without referencing correctly.  
You will need a text editor to type in your PHP code and 
an internet connection. Other resources may be 
required.  
 
The documentation must be typed using Office Word 
and your charts must be done in Visio or Word. The 
entire POE must be submitted in electronic format on 
Arc – hard copies will not be accepted.  
© The Independent Institute of Education (Pty) Ltd 2026  
Page 11 of 23 
IIE Module Outline           WEDE6021 
© The Independent Institute of Education (Pty) Ltd 2026  Page 12 of 23 
Module Pacer  
Code Programme Contact Sessions Credits 
WEDE6021 DIS3 48 15 
Learning Unit 1 Getting started with PHP 
 
Overview: 
 
This learning unit introduces the basics of PHP coding. We will firstly show the components 
necessary to drive a web application using a webserver such as mamp, lamp, wamp or 
xampp. Developers combine the webserver with some editor such as Notepad++ or the like. 
Once the student understands how these building blocks fit together learning will proceed 
in creating PHP scripts with code blocks. The student will learn to declare variables and 
constants of various data types in PHP code as well as building expressions.  
 
Please work through all the themes on Arc, together with the relevant sections in your 
prescribed source/s. To ensure that you are working towards mastering the objectives for 
this learning unit, please also ensure that you complete the following activities on Arc: 
 
 
Learning Unit 1: Theme Breakdown 
WEDE6021 
Sessions:  
1-2 
Theme 1: Getting started with PHP Prescribed Material (PM)  
WEDE6021w 
Week 1 
LO1: Apply PHP building blocks by 
creating a web application; 
LO2: Create PHP scripts; 
LO3: Create PHP code blocks; 
LO4: Declare variables and constants of 
various data types in PHP code; 
LO5: Build expression in PHPs. 
 
PM1:  
 Introduction  
 Chapter 1, pp.1–72 
 
Related 
Outcomes: 
MO001  
 
 
  
IIE Module Outline           
WEDE6021 
Learning Unit 2 
Functions, control structures and Strings 
Overview: 
The first part of Learning Unit 2 focuses on functions and control structures in PHP scripts. 
We will firstly investigate the use of functions and variable scope. Selection structures will 
be addressed next followed by a look at the use of repetition in PHP code. In the second part 
of this learning unit is dedicated to string manipulation. You will have the opportunity to 
demonstrate your ability to work with strings by writing PHP programs that use strings and 
their functions. 
Please work through all the themes on Arc, together with the relevant sections in your 
prescribed source/s. 
© The Independent Institute of Education (Pty) Ltd 2026  
Page 13 of 23 
IIE Module Outline           WEDE6021 
© The Independent Institute of Education (Pty) Ltd 2026  Page 14 of 23 
 
Learning Unit 2: Theme Breakdown 
WEDE6021 
Sessions: 
3-6 
Theme 1: Functions and control 
structures 
Prescribed Material (PM)  
WEDE6021w 
Week 1 - 2 
LO1: Apply functions in PHP script; 
LO2: Demonstrate the use of variable 
scope; 
LO3: Apply selection structures in PHP 
code; 
LO4: Apply repetition in PHP code. 
PHP 5 Variables. [Online]. 
Available at: 
http://www.w3schools.com
/php/php_variables.asp 
[Accessed 20 September 
2023]. 
 
. PHP 5 if...else...elseif 
Statements. [Online]. 
Available at: 
http://www.w3schools.com
/php/php_if_else.asp 
[Accessed 20 September 
2023]. 
 
PHP 5 switch Statement. 
[Online]. Available at: 
http://www.w3schools.com
/php/php_switch.asp 
[Accessed 20 September 
2023]. 
 
PHP 5 while Loops. [Online]. 
Available at: 
http://www.w3schools.com
/php/php_looping.asp 
[Accessed 20 September 
2023]. 
Related 
Outcomes: 
MO001 
MO002 
 
 
  
IIE Module Outline           WEDE6021 
© The Independent Institute of Education (Pty) Ltd 2026  Page 15 of 23 
 Theme 2: String Manipulation Prescribed Material (PM) 
LO5: Demonstrate competence of string 
manipulation using PHP code; 
LO6: Create PHP programs that make use 
of strings and their functions; 
LO7:  Implement PHP scripts that make 
use of the preg_match() function 
and regular expression to validate. 
 
PM: 
Chapter 2, pp.124–187 
 
PHP 5 
Strings. [Online]. Available 
at: 
http://www.w3schools.com
/php/php_string.asp 
[Accessed 20 September 
2023]. 
 
PHP 5 Operators. [Online]. 
Available at: 
http://www.w3schools.com
/php/php_operators.asp 
[Accessed 20 September 
2023]. 
 
 
  
IIE Module Outline           
WEDE6021 
Learning Unit 3 
Handling User Input and Arrays 
Overview: 
In this Learning Unit we will learn how to handle user input. We will firstly learn how to build 
web forms with PHP. After this we will investigate the processing of the form data and the 
handling of the submitted forms from the web page. At the end of the Learning Unit we will 
create an “all in one” form. 
Please work through all the themes on Arc, together with the relevant sections of your 
prescribed source/s.  
© The Independent Institute of Education (Pty) Ltd 2026  
Page 16 of 23 
IIE Module Outline           WEDE6021 
© The Independent Institute of Education (Pty) Ltd 2026  Page 17 of 23 
Learning Unit 3: Theme Breakdown 
WEDE6021 
Sessions: 
7-13 
Theme 1: Handling User Input Prescribed Material (PM)  
WEDE6021w 
Weeks 2  - 3 
LO1: Build web forms using PHP; 
LO2: Process form data; 
LO3: Handle submitted forms from a web 
page; 
LO4: Create an “all in one” form. 
 
PM: Chapter 4 Prescribed 
text pp.189–232 
 
 Focus on chapter 4 on 
Two Part Form, All in One 
form, Advanced escaping 
from HTML to PHP and 
sticky forms. 
 PHP 5 Form Handling. 
[Online]. Available at: 
http://www.w3schools.co
m/php/php_forms.asp 
[Accessed 20 September 
2023]. 
 
 
 
 
 
 
 
 
 
Related 
Outcomes: 
MO001 
MO002  
 
 
Theme 2: Arrays Prescribed Material (PM) 
LO6: Declare arrays and implement them 
in PHP code; 
LO6: Manipulate arrays and their 
elements on web forms; 
LO7: Construct multidimensional arrays 
within PHP. 
PM: Chapter 6 
 Show normal array 
structure. 
 Understand associative 
arrays. 
 iterate elements inside 
an array on a web form 
(pp.359 – Ch6) and 
store and evaluate user 
answers.  
IIE Module Outline           
 
WEDE6021 
Construct 
multidimensional 
arrays  
© The Independent Institute of Education (Pty) Ltd 2026  
Page 18 of 23 
IIE Module Outline           
WEDE6021 
Learning Unit 4 
Working with databases and MySQL 
Overview: 
The focus of this Learning Unit will be on MySQL databases. We will firstly learn to connect 
to a MySQL database and manage data with it. After this you will have the opportunity to 
demonstrate your competence in using phpMyAdmin or console. Next, we will learn to 
manipulate MySQL databases with PHP. After learning to Connect PHP to MySQL, we will 
create and manage database tables, manipulate database records and finally retrieve 
records.  
Please work through all the themes on Arc, together with the relevant sections of your 
prescribed source/s.  
© The Independent Institute of Education (Pty) Ltd 2026  
Page 19 of 23 
IIE Module Outline           WEDE6021 
© The Independent Institute of Education (Pty) Ltd 2026  Page 20 of 23 
Learning Unit 4: Theme Breakdown 
WEDE6021 
Sessions: 
14-22 
Theme 1: Work with databases and 
MySQL 
Prescribed Material (PM)  
WEDE6021w 
Weeks 4 - 6 
LO1: Create an Entity Relational Diagram 
to design a database; 
LO2: Connect and Manage data using 
MySQL databases; 
LO3: Demonstrate competence using 
phpMyAdmin; 
LO4: Create a database and tables using 
MySQL Workbench. 
PM: Chapter 7 
 
Students know SQL 
statements. Refresh by 
creating Table vehicles in Ch.7 
pp.405 and load data on 
pp.415. Students can 
manipulate table as in 
textbook. Console or 
phpMyAdmin can be used. 
Related 
Outcomes: 
MO001 
MO002 
 
 
 
 
Theme 2: Manipulating MySQL databases 
with PHP 
Prescribed Material (PM) 
LO5: Connect PHP to MySQL; 
LO6: Create and manage database 
tables; 
LO7: Manipulate database records; 
 LO8: Retrieve database records. 
 
PM: Chapter 8 
 
Only use  the company_cars 
table example in Ch.8. 
Students must make a 
connection using mysql but 
should be informed of mysqli 
for later use. Focus on assoc 
arrays on pp.478 and auto 
increment to find ID on 
pp.466. 
PART 1 
  
IIE Module Outline           WEDE6021 
© The Independent Institute of Education (Pty) Ltd 2026  Page 21 of 23 
Learning Unit 5 Manage State Information 
 
Overview: 
 
This learning unit commences with a look at “hidden form” fields. We will explore the 
concepts of query strings and cookies next and then learn to create structures through 
sessions in PHP that will maintain state information. 
 
Please work through all the themes on Arc, together with the relevant sections of your 
prescribed source/s.  
 
 
Learning Unit 5: Theme Breakdown 
WEDE6021 
Sessions: 23 - 30 
Theme 1: Managing state information  Prescribed Material (PM) 
WEDE6021w 
Weeks 6 - 8 
LO1: Implement “hidden form” fields; 
LO2: Discuss the purpose of query 
strings; 
 LO3: Explain the concept and purpose of 
cookies; 
 LO4: Create structures through sessions 
in PHP that will illustrate how state 
information is maintained. 
 
Chapter 9: Prescribed text 
pp.497–555 
 
 Focus must be on 
sessions in Ch.9;  
 Student must know 
how to implement 
hidden form fields and 
query strings. pp.530 
develop a script to 
illustrate how session 
array is created and 
variables stored and 
retrieved when page is 
refreshed; 
 Example must cover 
session_start() and 
session_destroy(). 
 
Related 
Outcomes: 
MO002 
PART 2 
  
IIE Module Outline           
WEDE6021 
Learning Unit 6 
Object-Oriented PHP 
Overview: 
This Learning Unit starts by addressing the use of Object-Oriented PHP. We will firstly learn 
to use classes and objects in PHP. Then we will implement the three stores and finally 
implement Object-Oriented PHP Stores simulating a shopping cart.  
Please work through all the themes on Arc, together with the relevant sections of your 
prescribed source/s.  
© The Independent Institute of Education (Pty) Ltd 2026  
Page 22 of 23 
IIE Module Outline           WEDE6021 
© The Independent Institute of Education (Pty) Ltd 2026  Page 23 of 23 
Learning Unit 6: Theme Breakdown 
WEDE6021 
Sessions: 31-48 
 
Theme 1: Object-Oriented PHP  Prescribed Material (PM)  
WEDE6021w 
Weeks 9 - 12 
LO1: Use classes and objects in PHP; 
LO2: Implement three stores without 
classes; 
LO3: Define a simple class in PHP. 
 
PM: Chapter 10 
 
Students must re-visit the 
concept of classes in Java. 
Focus on mysqli usage of 
objects on pp.566 in Ch.10. 
Develop normal web form 
displaying store info on 
Stores, i.e. Coffee, 
Electronic and Antiques. 
 
Related 
Outcomes: 
MO002 
Theme 2: Implementation of Object
Oriented PHP as an e-Store 
Prescribed Material (PM) 
LO4: Create the class-OnlineStore PHP 
class; 
LO5: Create PHP scripts implementing 
class-OnlineStore class as a 
shopping cart class. 
PM: Chapter 10 
 
Student must identify 
common Store code and 
separate duplicate code on 
Store and add to class 
definition.  Partial 
implementation of 
ShoppingCart. 
POE DUE 
 

 //PART 1

 WEDE6021 
Pt. 1 
Section: 1 
Mzamo Richmond Ndlovu: ST10455453 
Noluthando Ngema: ST10437661 
 
Table of Contents 
Table of Contents .......................................................................................................... 2 
Section1: ...................................................................................................................... 3 
Introduction: ................................................................................................................ 3 
Overview: ..................................................................................................................... 3 
Strengths and Weaknesses:........................................................................................... 6 
Innovative features: ...................................................................................................... 7 
UX Design Evaluation: ................................................................................................... 8 
Visual Comparison:....................................................................................................... 9 
Best Features: .............................................................................................................. 9 
Conclusion: .................................................................................................................. 9 
Section 2: ................................................................................................................... 10 
Introduction: .............................................................................................................. 10 
Overview and Innovative features: ................................................................................ 10 
Functions: .................................................................................................................. 11 
User Interface Design: ................................................................................................. 12 
Sitemap: .................................................................................................................... 27 
Detailed Listing For SQL Server: ................................................................................... 27 
Use Case Diagram: ..................................................................................................... 33 
ERD Diagram: ............................................................................................................. 34 
Project Plan: ............................................................................................................... 35 
Conclusion: ................................................................................................................ 35 
Reference List: ............................................................................................................ 35 
 
Section1: 
Introduction: 
Web applications are software programs that operate on web servers and are accessed through a web 
browser rather than being installed directly onto a device (Mozilla Developer Network (MDN), 2023). 
They enable users to perform online activities such as content management, communication, and 
electronic transactions, while supporting real-time data processing and interactive engagement. 
The purpose of this research is to critically evaluate the functional structures, usability designs, and 
overall system performances of The Changing Room and Yaga. These applications were selected because 
their online clothing resale model closely aligns with the objectives of the proposed Pastimes web 
application, particularly in relation to product listings, user interaction, and purchasing functionality. The 
findings from this evaluation will inform the functional and usability requirements of Pastimes, allowing 
for improved security, enhanced user experience, and the integration of more advanced system 
features. 
Overview: 
The Changing Room: 
Home Page: 
Registration/Login Page: 
User account creation is not mandatory when accessing the application, as users are permitted to 
browse available products without registering, reference Home Page. However, email-based 
authentication is required during the checkout process to complete a purchase transaction, reference 
Registration/Login Page, ensuring that customer details are captured before payment is processed. 
List Items/Browse: 
Item listings are managed exclusively by the application administrator after a user submits a request to 
sell clothing items, reflecting a centrally controlled listing structure. 
Checkout Items: 
The Changing Room web application allows users to access and browse available products without 
mandatory account registration. This lowers the entry barrier for new users and improves accessibility 
across the platform. However, email based authentication is required during the checkout process to 
complete a transaction, ensuring that user details are captured and verified before payment is 
processed. 
Yaga: 
Home Page: 
Similar to the changing room website, creating a user account is not required to access the application, 
as users can explore available products without having to register. 
Catalogue: 
The items listed on the catalogue focuses on showcasing clear, high-resolution images, dimensions, 
materials, and measurements, organized by category, such as men, women, or electronics. Sellers have 
the ability to personalize their shop and listings, incorporating a unique touch. 
Checkout: 
The checkout page is safe and efficient, enabling customers to examine their order, choose delivery 
preferences, and pay using reliable methods. Login/registration is necessary before finalizing the 
checkout process. 
Strengths and Weaknesses: 
The Changing Room: 
Strengths: 
• Dynamic and Beginner-Friendly Interface: Users can browse products and complete transactions 
without requiring advanced technical knowledge. 
• Centralized Administrative Control: Product listings and account management are controlled by 
administrators within the system. 
• Multiple Secure Payment Options: The checkout process supports multiple integrated payment 
systems, providing users with flexible and secure transaction options.  
• Structured Product Categorization: Products are automatically categorized into predefined 
departments, improving organizational clarity, and simplifying navigation. 
Weaknesses: 
• Limited Mobile Responsiveness: Certain layout elements do not effectively utilize available 
mobile space, which may result in compatibility limitations. 
• Potential Administrative Security Risk: While centralized control improves regulation, it may 
present security vulnerabilities if strong authentication and access control measures are not 
consistently enforced. 
• Dependency on External Payment Gateways: The reliance on multiple external payment services 
may lead to temporary unavailability if a third-party gateway experiences downtime. 
• Restrictive Category Allocation: Strict predefined categorization may limit accurate placement of 
items that do not clearly align with existing departments. 
Yaga: 
Strengths: 
• Cross-Platform Compatibility: Available through web browsers on any device, allowing users to 
buy and sell conveniently from anywhere. 
• Easy Updates and Maintenance: Yaga can implement updates effortlessly, guaranteeing users 
have access to the most recent features and security. 
• Scalability: Accommodates rising user demand and data as the platform expands. 
• Cost-Effective Development: Generally, less expensive to create and maintain one unified 
codebase. 
Weaknesses: 
• Internet Dependency: To use the website, user must have a reliable internet connection 
• Security Vulnerabilities: There is a risk of cyberattacks because it handles payments and user 
data. 
• Performance Limitations: May not be as fast as an app, particularly when used frequently. 
• Limited Search Functionality: Users might need to sort through irrelevant stuff, due to limited 
searches available. 
Innovative features: 
The Changing Room: 
The Changing Room provides tailored styling services, allowing customers to receive professional advice 
on products and styling choices. This adds an element of luxury and a personalized shopping experience. 
For Pastimes, this concept highlights the value of incorporating personalization features such as 
recommended listings based on browsing history to differentiate the platform and improve user 
retention. 
Yaga: 
Yaga's direct messaging function enables buyers to connect directly with sellers, simplifying negotiations 
and inquiries. This builds trust and ensures seamless transactions. For Pastimes, this demonstrates the 
importance of integrating an in-platform communication channel to streamline the seller buyer 
relationship and reduce the reliance on external contact methods. 
UX Design Evaluation: 
Both websites are mobile friendly. 
They are not cluttered, Yaga has a clean and simple design, and The Changing Room has a more stylish, 
curated look. 
Both websites load relatively fast 
Hyperlinks on both websites are functional. 
Visual Comparison: 
Best Features: 
• High quality visuals and product showcases: Both websites can inspire our website’s product 
showcasing, making our products stand out using high-quality products. 
• Fast load time: Both websites load instantly, which is a great feature to include into our website, 
fast loading time enhances user satisfaction. 
• User-friendly navigation: The websites both make it easy for the user to find what they are 
looking for, that is another feature we would include in our website. 
Conclusion: 
The evaluation of The Changing Room and Yaga identified key strengths in navigation, checkout security, 
and interface accessibility, alongside notable limitations in search functionality, user autonomy and 
security risk management. These findings directly inform Pastimes' development by adopting the most 
effective features from both platforms and addressing their identified weaknesses, Pastimes aims to 
deliver a more efficient, secure and user centred web application for the online second hand clothing 
market. 
Section 2: 
Introduction: 
E-commerce has changed how people shop by making it more convenient, accessible and flexible 
(Laudon & Traver, 2020) while enabling businesses to reach wider audiences, strengthen customer 
engagement and remain competitive in a rapidly growing digital economy (Chaffey, 2019). In 
the secondhand clothing market, online platforms such as Yaga and The Changing Room have emerged, 
offering functionalities that cater to customer needs, including peer-to-peer exchanges and curated 
vintage selections. Building on the research and evaluation of existing platforms conducted in Section 1, 
this section focuses on the planning and design of Pastimes, a dedicated web application for the pre
owned clothing market. The goal is to develop a user friendly, secure and efficient platform that draws 
on identified strengths while addressing common limitations, outlining its core features, functions, user 
interface design, data requirements, use-case analysis and project schedule.  
Overview and Innovative features: 
The Pastimes platform will be designed with responsiveness and accessibility in mind, ensuring a 
seamless experience across all devices. By drawing on e-commerce best practices and building features 
that address real user pain points, Pastimes aims to become a reliable destination for buyers and sellers 
of secondhand clothing. The following innovative features will set Pastimes apart from competing 
platforms:  
• Guest Browsing with Frictionless Authentication:  
o Pastimes will allow users to browse the full product catalog without needing to create an 
account first. Account verification via email will only be required when a user proceeds to 
checkout or when they want to list an item for sale. This reduces unnecessary barriers and 
creates a more welcoming first experience.  
• Integrated Negotiation System:   
o The platform will include a built-in messaging system that allows buyers and sellers to 
communicate directly within the app. Sellers will have the option to mark a product as 
"Negotiable" signaling to buyers that they are open to offers. This eliminates the need for 
third party communication tools and keeps all dealings within the platform.  
• Dynamic Product Showcasing:   
o The landing page will prioritize high quality visuals and a well-organized layout 
to showcase premium and trending listings. This gives quality items greater visibility and 
makes a strong first impression on new visitors.  
• Context Aware Navigation:   
o The navigation bar will adapt based on the user's status whether they are a guest, a 
registered buyer, or a seller. This makes it easier for each type of user to find relevant pages 
and manage their activity on the platform without unnecessary clutter.  
• Smart Product Categorization:   
o Products will be organized into clearly defined, searchable categories such as Vintage, 
Streetwear, Men's, Women's and Accessories. This reduces the time buyers spend searching 
and improves the overall product discovery experience.  
Functions: 
To support a complete e-commerce experience for both buyers and sellers, Pastimes will include the 
following core pages and features:  
• Home/Landing Page:   
o The home page serves as the main entry point to the platform. It will display the Pastimes 
brand name and tagline, a prominent search bar, and quick links to popular product 
categories. A featured products section will highlight trending or high-quality listings to 
engage visitors immediately upon arrival.  
• Login/Signup Page:   
o This page provides a secure gateway for account creation and access. New users can register 
by providing their name, email address, and a unique username and password. Returning 
users can log in using their existing credentials. Once authenticated, users gain access 
to personalized features such as saved items, seller tools, and order history.  
• Category Page:   
o The category page organizes all available products into clearly defined groups such as shoes, 
accessories, men's clothing, and women's clothing. Buyers can filter and sort results by price 
or date listed, making it easier to find specific items without browsing through unrelated 
products.  
• Product Upload and Sell Page:   
o This page is designed for sellers and provides a structured form for listing new items. Sellers 
can upload product images, write a description, set a price, specify the item's condition and 
size, and select the appropriate category. The form ensures that all listings are consistent 
and contain the necessary details for buyers to make informed decisions.  
• Product Detail Page:   
o The product detail page displays all relevant information about a single item, including 
high resolution images, the full product description, price, size, condition, and the seller's 
rating and profile. From this page, buyers can add the item to their cart or send a direct 
message to the seller to ask questions or negotiate the price.  
• Cart Page:   
o The cart page gives buyers a clear summary of the items they intend to purchase. Buyers can 
update quantities, remove items, and review the subtotal before proceeding. This step 
allows users to confirm their selection before committing a purchase.  
• Delivery and Shipping Page:  
o Before completing a purchase, buyers are required to provide their delivery address through 
a structured form. This information is used to calculate shipping logistics and ensure the 
order is directed to the correct location. Buyers can choose between a residential or work 
address.  
• Checkout and Payment Page:   
o The checkout page presents the buyer with a final review of their order, including 
items, quantities, and the total cost. Buyers can then select a payment method for either 
credit card or debit card and securely complete their transaction.  
• Tracking and Order Status Page:   
o After a purchase is made, buyers can monitor the progress of their order on this page. The 
tracking page displays the current order status, such as Packed, In Transit, or Delivered, 
along with a unique tracking number. This provides transparency and gives buyers 
confidence that their purchase is on its way. 
User Interface Design: 
Mobile App/Web App: 
Pastimes Home Page Mockup 

Login and Sign up 

Pastimes Category Browse Page Mockup 

Pastimes Product Detail Page Mockup 

Pastimes Shopping Cart Page Mockup 

Pastimes Delivery and Shipping Page Mockup 

Pastimes Checkout and Payment Page Mockup 
Pastimes Order Tracking Page Mockup 
\ 
Sitemap: 
Detailed Listing For SQL Server: 
tblUsers 
Field 
Type 
INT (PK) 
user_id 
Description 
first_name 
Unique identifier for each user 
VARCHAR(50) 
last_name 
User's first name 
VARCHAR(50) 
username 
VARCHAR(50) (Unique) 
email 
User's last name 
Chosen display name for the 
platform 
VARCHAR(100) (Unique) 
password_hash 
User's email address used for 
login and verification 
VARCHAR(255) 
Securely hashed version of the 
user's password 
profile_picture_url VARCHAR(255) 
Link to the user's uploaded 
profile image 
phone_number VARCHAR(20) 
Contact number used for 
delivery and account 
verification 
role ENUM 
Defines the user's access level 
and available features 
is_verified BOOLEAN 
Indicates whether the user has 
completed email verification 
date_joined DATETIME 
Timestamp of when the account 
was created 
last_login DATETIME 
Timestamp of the user's most 
recent session 
 
tblSellerProfiles 
Field Type Description 
seller_profile_id INT (PK) 
Unique identifier for the seller 
profile 
user_id INT (FK) 
Links the seller profile to the 
main user account 
store_name VARCHAR(100) 
The name the seller trades 
under on the platform 
store_description TEXT 
A short bio or description of 
what the seller offers 
average_rating DECIMAL(3 
Aggregated buyer rating out of 
5.00 
total_sales INT 
Running count of completed 
transactions 
bank_account_number VARCHAR(50) 
Seller's bank account for 
receiving payouts (encrypted) 
bank_name VARCHAR(100) 
Name of the seller's banking 
institution 
account_holder_name VARCHAR(100) 
Name registered to the seller's 
bank account 
payout_preference ENUM 
Seller's preferred method of 
receiving payment 
 
tblCategories 
Field Type Description 
category_id INT (PK) 
Unique identifier for each 
category 
category_name VARCHAR(100) 
Name of the category e.g. 
Streetwear Vintage Accessories 
category_description TEXT 
Brief description of what the 
category includes 
parent_category_id INT (FK) 
Allows for subcategories e.g. 
Shoes under Women's 
 
tblProducts 
Field Type Description 
product_id INT (PK) 
Unique identifier for each 
product listing 
seller_id INT (FK) 
Links the listing to the seller 
who created it 
category_id INT (FK) 
The category the product 
belongs to 
product_name VARCHAR(150) 
The title of the listing as it 
appears to buyers 
brand VARCHAR(100) 
The clothing brand e.g. Levi's 
Nike Zara 
description TEXT 
Detailed description of the item 
including any flaws or notable 
features 
price DECIMAL(10 Listed selling price 
is_negotiable BOOLEAN 
Indicates whether the seller is 
open to price negotiation 
condition ENUM 
Standardized condition rating 
chosen by the seller 
size VARCHAR(20) 
Clothing size e.g. S M L XL 32W 
or a numeric size 
colour VARCHAR(50) Primary color of the item 
gender ENUM('Men' 
Target gender for the clothing 
item 
quantity_available INT 
Number of units available 
typically 1 for second-hand 
items 
status ENUM 
Current availability status of the 
listing 
date_listed DATETIME 
Timestamp of when the product 
was listed 
date_updated DATETIME 
Timestamp of the most recent 
edit to the listing 
 
tblProductImages 
Field Type Description 
image_id INT (PK) Unique identifier for each image 
product_id INT (FK) 
Links the image to its product 
listing 
image_url VARCHAR(255) 
URL pointing to the stored 
image file 
is_primary BOOLEAN 
Marks the main display image 
for the listing 
upload_date DATETIME 
Timestamp of when the image 
was uploaded 
 
tblOrders 
Field Type Description 
order_id INT (PK) Unique identifier for each order 
buyer_id INT (FK) 
Links the order to the buyer's 
account 
total_amount DECIMAL(10,2) 
The total cost of the order 
including delivery 
delivery_fee DECIMAL(10,2) 
The shipping cost applied to the 
order 
order_status ENUM Current stage of the order 
tracking_number VARCHAR(100) 
Unique code assigned for 
shipment tracking 
payment_status ENUM 
Reflects whether payment has 
been successfully processed 
payment_method ENUM 
The payment method selected at 
checkout 
order_date DATETIME 
Timestamp of when the order 
was placed 
estimated_delivery DATE 
Expected delivery date provided 
at checkout 
 
tblOrderItems 
Field Type Description 
item_id INT (PK) 
Unique identifier for each order 
line item 
order_id INT (FK) Links the item to the parent order 
product_id INT (FK) 
Identifies the specific product 
purchased 
quantity INT 
Number of units of this product 
in the order 
unit_price DECIMAL(10,2) 
Price of the item at the time of 
purchase preserved for record 
accuracy 
 
tblDelveryAddresses 
Field Type Description 
address_id INT (PK) 
Unique identifier for each saved 
address 
user_id INT (FK) 
Links the address to the buyer's 
account 
recipient_name VARCHAR(100) 
Full name of the person receiving 
the delivery 
street_address VARCHAR(255) Street number and name 
suburb VARCHAR(100) Suburb or district 
city VARCHAR(100) City or town 
province VARCHAR(100) Province or region 
postal_code VARCHAR(20) Postal code for the delivery area 
address_type ENUM 
Whether the address is a home 
or workplace 
is_default BOOLEAN 
Marks this address as the buyer's 
preferred delivery location 
 
tblMessages 
Field Type Description 
message_id INT (PK) 
Unique identifier for each 
message 
sender_id INT (FK) The user who sent the message 
receiver_id INT (FK) 
The user who received the 
message 
product_id INT (FK) 
The product the conversation is 
related to 
content VARCHAR(150) The body of the message 
is_read BOOLEAN 
Indicates whether the recipient 
has read the message 
sent_at DATETIME 
Timestamp of when the message 
was sent 
 
tblReviews 
Field Type Description 
review_id INT (PK) Unique identifier for each review 
reviewer_id INT (FK) 
The buyer who submitted the 
review 
seller_id INT (FK) The seller being reviewed 
order_id INT (FK) 
Links the review to a verified 
purchase 
rating 
comment 
TINYINT (1-5) 
TEXT 
Numerical score out of 5 given by 
the buyer 
review_date 
DATETIME 
Written feedback from the buyer 
Timestamp of when the review 
was submitted 
Use Case Diagram: 
ERD Diagram: 
Project Plan: 
Conclusion: 
In conclusion, by establishing important roles for buyers, sellers, and administrators, and specifying 
crucial features such as product browsing, messaging, and secure checkout, this design guarantees that 
Pastimes meets customer needs and requirements for a smooth second-hand shopping experience. 
With well-defined milestones in place, the project is set to offer a functional platform that allows users 
to buy, sell, and engage confidently. 
Reference List: 
Chaffey, D. (2019). Digital Business and E-commerce Management. Pearson Education.  
Interaction Design Foundation. 2023. User experience (UX) design basics. [online] Available at: 
https://www.interaction-design.org/literature/topics/ux-design [Accessed 27 February 2026]. 
Laudon, K.C. and Traver, C.G. (2020) E-commerce: Business, Technology, Society. 16th ed. Pearson 
Education.  
LisaFuze. 2026. 6 visual elements of every well-designed website. [Online]. Available at: 
https://lisafurze.com/blog/visual-elements-website-design/ [Accessed 4 March 2026]. 
LocalTeam. 2025. Web App vs Website: Understanding the Key Differences and Making the Right Choice. 
[Online]. Available at: https://localteam.com.au/web-app-vs-website/ [Accessed 4 March 2026]. 
Mozilla Developer Network (MDN). 2023. What is a web application? [online] Available at: 
https://developer.mozilla.org/en
US/docs/Learn/Common_questions/Web_mechanics/What_is_a_web_application [Accessed 27 
February 2026]. 
The Changing Room. 2024. The Changing Room official website. [online] Available at: 
https://thechangingroom.co.za/ [Accessed 27 February 2026]. 
Yaga. 2026. Yaga Secondhand fashion. Available at: https://www.yaga.co.za/  

 24; 25;26                          2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 1 of 31 
 
 
MODULE NAME: MODULE CODE: 
WEB DEVELOPMENT (INTERMEDIATE) WEDE6021/w 
 
ASSESSMENT TYPE: POE (PAPER ONLY) 
 
TOTAL MARK ALLOCATION: 100 MARKS 
 
TOTAL HOURS: A MINIMUM OF 35 HOURS IS SUGGESTED TO COMPLETE THIS ASSESSMENT 
 
By submitting this assessment, you acknowledge that you have read and understood all the rules 
as per the terms in the registration contract, in particular the assignment and assessment rules in 
The IIE Assessment Strategy and Policy (IIE009), the intellectual integrity and plagiarism rules in 
the Intellectual Integrity Policy (IIE023), as well as any rules and regulations published in the 
student portal. 
 
INSTRUCTIONS: 
 
1. No material may be copied from original sources, even if referenced correctly, unless it is a 
direct quote indicated with quotation marks. No more than 10% of the assignment may 
consist of direct quotes.  
2. Your assignment must be submitted through Turnitin. 
3. Make a copy of your POE before handing it in. 
4. Assignments must be typed unless otherwise specified.  
5. All work must be adequately and correctly referenced. 
6. Begin each section on a new page. 
7. Follow all instructions on the assignment cover sheet. 
8. This is a group assessment. The group size is two (2) members. 
 
  
 24; 25;26                          2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 2 of 31 
Referencing Rubric                                                                                                                                                      
Providing evidence based on valid and referenced academic sources is a 
fundamental educational principle and the cornerstone of high-quality 
academic work. Part of achieving this quality is referencing in a way that is 
consistent and congruent with the requirements of the referencing style being 
used.  
 
Therefore, inconsistent and/or incongruent referencing will result in a penalty 
of a maximum of ten percent being deducted from the overall percentage 
awarded to your assessment submission. 
  
Please note that evidence of plagiarism in the form of copied or unreferenced 
work, absent reference lists, or exceptionally poor referencing may result in 
action being taken in accordance with The IIE’s Intellectual Integrity and 
Property Rights Policy (IIE023). Similarly, evidence of excessive AI usage may 
result in action being taken in accordance with The IIE’s Student Conduct, 
Discipline and Safety Policy (IIE015). 
Markers are required to provide feedback to students by 
circling/underlining the information in the table below that best describes 
the student’s work and by adding constructive commentary where 
appropriate. The examples provided are not exhaustive but illustrate the 
errors. 
 
Deductions 
 Where the student’s work contains five or more errors aligned to the 
minor errors column below, deduct 5% from the overall percentage.  
 
 Where the student’s work contains five or more errors aligned to the 
major errors column below, deduct 10% from the overall percentage.  
 
 Where both minor and major errors (e.g. two minor and three major, 
etc.) are present, deduct 10% only (and not 5% or 15%) from the overall 
percentage.  
Required:  
Consistent and congruent 
referencing  
Minor errors  
Deduct 5% from overall percentage. 
Example: if the response receives 70%, deduct 5%. The 
final mark is 65%. 
Major errors  
Deduct 10% from the overall percentage. 
Example: if the response receives 70%, deduct 10%. 
The final mark is 60%. 
Consistency  
 The correct referencing style 
for the discipline – i.e., either 
Harvard, OR APA (for 
Psychology), OR Law, OR IEEE 
(for ICT/Engineering) – has 
been used consistently for all 
in-text references and in the 
bibliography/reference list. 
 
 Concepts and ideas that are 
quoted and/or paraphrased 
are referenced consistently 
throughout. 
 
 Position of the in-text 
reference: an in-text 
reference is positioned 
consistently where 
appropriate for every quote 
and paraphrase.  
 
Minor inconsistencies: 
 The referencing style used is generally consistent with 
what is required, but there are one or two 
changes/errors in the format of in-text referencing 
and/or in the bibliography/reference list.  
 
 For example, page numbers for direct quotes in-text 
have been provided for one source, but not in another. 
Or, two book chapters in the bibliography/reference 
list have been referenced in two different formats. Or, 
the publication year has been placed after the author 
name in one bibliography/reference list entry, and 
after the source title in another, etc.  
 
 Concepts and ideas in quotes and/or paraphrases are 
typically referenced, but a full in-text reference is 
missing or incomplete from one or two small sections 
of the work.  
 
 Position of the references: in-text references are only 
given at the beginning and/or end of every paragraph. 
Major inconsistencies: 
 Poor and wholly inconsistent referencing style used 
in-text and/or in the bibliography/reference list. 
 
 Multiple referencing styles for the same source 
types have been used. 
 
 For example, the format for direct quotes in-text 
and/or book chapters in the bibliography/reference 
list and/or year of publication in the 
bibliography/reference list is different across 
multiple instances.  
 
 Concepts and ideas in quotes and/or paraphrases 
are haphazardly referenced in-text.  
 
 Position of the references: in-text references are 
only given at the beginning or end of large sections 
of work.  
Feedback on referencing consistency: 
 
 
 
Congruency  
 Each source reflected within 
in-text references is included 
accurately in the 
bibliography/reference list. 
 
 All bibliography/reference list 
entries are in the required 
order for the referencing style 
used (e.g. alphabetical, 
alphabetical under 
subheadings, numerical). 
 
 All direct quotes and 
paraphrases have been 
integrated appropriately into 
the text using introductory 
phrases, accurate grammar, 
etc.  
 
Minor incongruences:  
 There is largely a match between the sources 
presented in-text and those in the 
bibliography/reference list, but one or two sources 
that appear in-text do not appear in the 
bibliography/reference list, or vice versa. Or key source 
information is missing from one or two in-text 
references or bibliography/reference list entries only 
(e.g. publication year, city of publication, URL date 
accessed, etc.). 
 
 There is a clear and largely accurate ordering of 
sources in the bibliography/reference list as required 
by the referencing style used, but with one or two 
references out of order.  
 
 An attempt has been made for source integration into 
the text using appropriate introductory phrases and 
grammar, but one or two quotes or paraphrases do 
not flow as clearly or logically within the sentence 
structure as they could. 
Major incongruences: 
 No relationship/several incongruencies between 
the in-text referencing and the 
bibliography/reference list.  
 
 For example, multiple sources are included in-text, 
but not in the bibliography, and/or vice versa. Key 
source information is missing from multiple in-text 
references and/or reference list entries. A URL link, 
rather than the actual reference, is provided in the 
bibliography. Sources are repeated in the reference 
list, etc.  
 
 Most sources are listed in a haphazard order 
throughout the bibliography/reference list. 
 
 Few to no appropriate introductory phrases or 
rules of grammar have been applied, and many 
direct quotes and/or paraphrases feel disconnected 
from the flow of the text.  
  
Feedback on referencing congruency: 
 
 
 
Overall feedback on referencing, with suggested improvements: 
 
 24; 25;26                          2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 3 of 31 
Portfolio of Evidence (PoE) — Background                                    __ 
 
These days websites play a very critical role in online shopping. Under the Covid-19 restrictions, 
online shopping became very popular and the trend has continued post-lockdown. You have been 
tasked to create an online shop for second hand branded clothing that is very good condition. The 
shop is called “Pastimes”. 
 
Pastimes needs to make it easier for their customers to sell and buy second-hand clothing online. 
The e-store should enable the customers to trade their clothing online. Create a user-friendly web 
application for customers who are buying and selling second-hand clothing. 
 
The features, design and layout of your web application is your personal choice, but the web 
application must be able to complete at least the following Parts: 
 The user must be able to register as a user using the application. The registration information 
must be stored in a MySQL database. 
 Users must fill in their name and email address fields when registering and create a 
username and password. 
 An 8-character password must be created and confirmed as the correct password. 
 The user must be able to login into the application using a username and password. This 
information must be retrieved from the database. 
 Enter delivery details (residential/work address for the courier). 
 
User Functionality (seller): 
Pastimes’ administrators will load the details of the second-hand clothes that users wish to sell. 
For the user to start selling their clothes, the administrators need to confirm the following details of 
the users (sellers): 
 Verify that the seller is registered on the website (seller status) before the options to 
sell/upload the clothes are available to the buyer (on the MySQL database). 
 Remove clothes from the database that have been sold.  
 Communicate with all users (buyers and sellers) regarding clothes that are available for 
selling. 
 Ensure that clothes bought are delivered to the buyers. 
 Liaise between the buyer and the seller. 
 
 24; 25;26                          2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 4 of 31 
User Functionality (buyer): 
Buyers of used clothing must be able to do the following: 
 View pictures of the second-hand clothing that has been loaded onto the application by the 
seller. 
 Send a message to the seller. 
 Buy a second-hand item of clothing. 
 View their shopping cart and edit items in the cart. 
 
These features are the minimum that’s required. Your web application be easy to navigate and use. 
Speak to your lecturer about how best your website can implement all these features. 
 
Your final mark will be calculated as follows: 
 
 
 
 
 
 TOTAL MARK WEIGHTING 
PERCENTAGE 
PART 1 100 25% 
PART 2 100 30% 
POE 100 35% 
ICE 100 10% 
FINAL MARK 100 100% 
  
 24; 25;26                          2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 5 of 31 
Instructions                            __ 
 
This portfolio of evidence consists of three parts (Part 1, Part 2 and the final wrapping together of the 
POE). All feedback provided by your lecturer must be included in subsequent submissions. You 
must include the documentation of your website and database tables. 
 
You may be expected to research topics that were not covered in your lectures for your Parts. Any 
coding obtained from an external source must be referenced within your script at that point of 
usage. Any AI tools such as ChatGPT are NOT allowed and if this applies then disciplinary steps will 
be taken. All code/scripts must contain your student number, name and surname and a declaration 
or statement that the coding is your own work where not referenced.  
 
Categorise your submission documentation in folders, e.g., Root folder with html and PHP root files 
and documentation such as the report, ERD and self-evaluation within a Word document:  
 Research 
 Planning and design of the website 
 Website files 
o CSS sub folder; 
o js sub folder;  
o images sub folder; 
 database  
 
Details for PoE: 
The POE is broken down into three parts that must function as one web application. Your final POE 
will demonstrate your understanding of: 
 
 PHP scripting; 
 Functions and control structures; 
 Manipulation of strings; 
 Handling of user input; 
 Manipulating arrays; 
 Working with databases and MySQL; 
 Manipulating MySQL Databases with PHP; 
 Managing State Information;  
24; 25;26                          
2026 
 
 
Object Oriented PHP; 
Implementation of Object-Oriented PHP on the e-clothes store. 
Please note that you are required to use good coding standards. Refer to the marking rubric which 
indicates how your coding will be assessed. 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 6 of 31 
 24; 25;26                          2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 7 of 31 
PART 1 — Research, Planning and Design                                        (Marks: 100) 
 
This part is composed of two sections:  
 Research (Section 1) 
 Planning and design (Section 2) 
 
It is recommended that you create two separate documents – one for each section. You must 
include the student numbers and names of both group members in the documents. Each separate 
report must be written using the following criteria: Font Calibri, Size 11. The Section 1 document 
must be between 3 and 5 pages long and for Section 2, between 4 and 5 pages long.  
 
Section 1                                                                                                                     (Marks: 50) 
 
In this section, you are required to research two existing online pre-used clothing selling store 
websites and then write up your findings in an essay with the prescribed sections below. You must 
present your findings in a report containing the following items (maximum of 600 words which 
excludes the screenshots and infographic): 
 
1. Introduction. 
2. Research two web applications including: 
2.1 Overview of each of the web applications; include screenshots with descriptions; 
2.2 Strengths and weaknesses of the two web applications; 
2.3 Innovative features; 
2.4 UX Design Evaluation: 
 Are the websites mobile friendly? 
 Are the websites cluttered (too many objects/images on the website to be 
aesthetically pleasing and navigate)? 
 Do the sites load instantly (less than 3 seconds)? 
 Do the hyperlinks work? 
3. Visual (infographic) comparison of both web applications. 
4. List of the best features from both web applications you would like to include in your web 
application. 
5. Conclusion. 
6. References. 
 24; 25;26                          2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 8 of 31 
Referencing must be used for this Part. Make sure that the infographic is sized so that text is 
readable. 
Section 2                                                                                                                                                 (Marks: 50) 
 
For this Part, you must plan and design your website. The purpose of this Part is to ensure you know 
exactly what you need to build and how you will build it before you start with the final Part of the 
POE and implement your online store. You must present your design as a typed, detailed document 
with the following sections: 
 
1. Introduction. 
2. Brief overview of your planned web application including the innovative features. 
3. A list of functions described in detail. 
4. User interface design including: 
o a mock-up for each web page; 
o a description of the purpose of each web page; 
o a sitemap for the entire web application. 
5. Detailed listing of the data that must be captured from the seller and buyer and store in the 
MySQL database. 
6. Identify actors and their role in the system, draw use-case diagrams. 
7. ERD diagram. 
8. Project plan detailing deadlines and milestones for your project. 
9. Conclusion. 
10. References. 
23; 24; 25                             2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 9 of 31 
Assessment Sheet (Marking Rubric) – Part 1___________________________________________________________________________________________ 
 
Please note: Include this rubric when you submit Part 1. 
 
MODULE NAME: MODULE CODE: 
WEB DEVELOPMENT (INTERMEDIATE) WEDE6021/w 
 
STUDENT NAME: 
STUDENT NUMBER: 
GROUP NAME: 
 
PART 1 Levels of Achievement Feedback 
To be awarded full 
marks for these 
elements of Part 1, 
students must have: 
Excellent Good Developing Poor 
Score Ranges Per Level (½ marks possible) 
SECTION 1 
Research: Introduction 
5 
An excellent 
introduction that 
explains the 
purpose of the 
research and the 
sections included 
in the document. 
3—4 
Acceptable and 
links to the rest of 
the document but 
doesn’t explain 
the purpose of the 
research. 
1—2 
Introduction 
doesn’t link to the 
rest of the 
document. 
0 
No introduction 
included. 
 
  
23; 24; 25                             2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 10 of 31 
PART 1 Levels of Achievement Feedback 
To be awarded full 
marks for these 
elements of Part 1, 
students must have: 
Excellent Good Developing Poor 
Score Ranges Per Level (½ marks possible) 
SECTION 1 
Web App 1 research 
7—10 
Excellent, 
comprehensive 
discussion clearly 
differentiating between 
the strengths and 
weaknesses and 
motivating why features 
are considered 
innovative. 
5—6 
All sections included, 
but more details 
could be added to 
some of the sections. 
3—4 
All sections are 
included but 
limited details are 
provided in each 
section. 
0—2 
Not included or 
sections missing. 
 
SECTION 1 
Web App 2 research 
7—10 
Excellent, 
comprehensive 
discussion clearly 
differentiating between 
and the strengths and 
weaknesses and 
motivating why features 
are considered 
innovative. 
5—6 
All sections included, 
but more details 
could be added to 
some of the sections. 
3—4 
All sections are 
included but 
limited details are 
provided in each 
section. 
0—2 
Not included or 
sections missing. 
 
 
23; 24; 25                             2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 11 of 31 
PART 1  Levels of Achievement Feedback 
To be awarded full 
marks for these 
elements of Part 1, 
students need to 
have: 
Excellent Good Developing Poor 
Score Ranges Per Level (½ marks possible) 
SECTION 1 
Research: 
Comparison 
9—10 
An excellent, 
comprehensive 
visual comparison 
that shows all the 
differences and 
similarities at a 
glance. 
7—8  
Comparison in a 
visual format with 
a good number of 
similarities and 
differences. 
4—6  
Comparison in a 
visual format but 
only includes 
either differences 
or similarities. 
0—3 
Comparison not in a 
visual form. 
 
  
23; 24; 25                             2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 12 of 31 
PART 1  Levels of Achievement Feedback 
To be awarded full 
marks for these 
elements of Part 1, 
students need to have: 
Excellent Good Developing Poor 
Score Ranges Per Level (½ marks possible) 
SECTION 1 
Research: List of 
features to include 
8—10 
An excellent list of 
features with 
motivations 
included for why 
these features are 
desirable. 
5—7 
A good list of 
features is 
included but with 
little or no 
motivations. 
1—4 
A very short list 
included with no 
motivations. 
0 
No list of features 
included. 
 
SECTION 1 
Research: Conclusion 
and References 
5 
An excellent 
conclusion that 
links to the 
document and to 
the design. 
AND 
An excellent 
reference list in 
the correct format 
and links to the in
text references. 
3—4  
Acceptable 
conclusion and 
links to the rest of 
the document. 
AND  
Acceptable 
references and 
links to the rest of 
the document. 
1—2 
Conclusion 
doesn’t link to the 
rest of the 
document. 
OR 
Reference list is 
incomplete and 
doesn’t link to the 
references in-line. 
0 
No conclusion 
included. 
OR 
No reference 
included. 
 
  
23; 24; 25                             2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 13 of 31 
PART 1  Levels of Achievement Feedback 
To be awarded full marks for 
these elements of Part 1, students 
need to have: 
Excellent Good Developing Poor 
Score Ranges Per Level (½ marks possible) 
SECTION 2 
Planning and Design: 
Introduction and conclusion 
5 
An excellent 
introduction and 
conclusion that 
clearly links to the 
research 
document as well 
as the content of 
the design 
document. 
3—4 
A good 
introduction and 
conclusion 
included that links 
to the rest of the 
document. 
1—2 
Either introduction 
or conclusion is 
missing. 
0 
No introduction or 
conclusion 
included. 
 
SECTION 2 
Planning and Design: Overview 
of the app 
9—10 
An excellent 
overview that sets 
the stage for the 
rest of the 
document. 
7—8 
A good overview is 
included with 
some innovative 
features. 
4—6 
The overview 
needs more 
details. 
0—3 
No overview 
included or no 
innovative features 
mentioned. 
 
  
23; 24; 25                             2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 14 of 31 
PART 1 Levels of Achievement Feedback 
In order to be awarded full marks 
for these elements of Part 1, 
students need to have: 
Excellent Good Developing Poor 
Score Ranges Per Level (½ marks possible) 
SECTION 2 
Planning and Design: Detailed 
list of requirements 
13—15 
An excellently 
detailed list of 
features that 
describes all the 
features including 
the student’s own 
from research in 
detail. 
9—12 
Required features 
as well as the 
student’s own 
requirements 
included but needs 
more detail in 
places. 
4—8 
Only required 
features are 
included with 
some details, but 
no additional 
features from 
research 
mentioned. 
0—3 
No requirements 
included or 
required features 
are missing.  
SECTION 2 
Planning and Design: User 
interface design 
13—15 
Excellent mock
ups together with 
descriptions and a 
diagram explaining 
navigation. 
9—12 
Mock-ups and 
descriptions 
included but not 
diagram showing 
navigation. 
4-8 
Only mock-ups or 
only reasonably 
detailed 
descriptions 
included, not both. 
0—3 
No design included 
or only very brief 
descriptions with 
no mock-ups. 
 
 
SECTION 2 
Planning and Design: Project 
Plan 
5 
Logical and fully 
detailed with no 
errors. 
3—4 
Logical with minor 
errors. 
1—2 
Not logical. 
0 
No project plan 
included.  
 
END OF PART 1 
[TOTAL MARKS: 100] 
23; 24; 25                      2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 15 of 31 
PART 2 — Prototype                                                                          (Marks: 100) 
 
For this Part, you will need to build a fully working web application prototype. This prototype will 
include all the features listed in the instructions section of this document but based on your own 
design and user interface layout. Make use of your lecturer’s feedback on Part 1 to improve on your 
planned web application. 
 
1. Create a database using PHPMyAdmin and name the database ClothingStore. The database 
may consist of the following tables: 
 tblUser 
 tblAdmin 
 tblAorder  
 tblClothes  
 
OR use the ERD tables you created in Part 1. Simplify the design by analysing the 
relationships among the tables. Ensure that you create the necessary primary keys and 
foreign keys coding the constraints as dictated by the ERD design. 
 
2. Create a connection to the clothesStore database: 
 Create a text file userData.txt and populate the text file with at least five fictitious 
entries, e.g., John Doe     j.doe@abc.co.za     29ef52e7563626a96cea7f4b4085c124.c. 
  Use the console or phpMyAdmin and load the text file manually into the table. 
 The code that creates the connection must be saved in a file called DBConn.php. 
 Create a script called createTable.php that will check if the tblUser exists and if it 
does, delete the table and (re)create the table and load the data into the table using 
userData.txt file as a source file.  
 Embed the DBConn.php as an include file within the createTable.php script. 
 Each time the script is executed the table will be deleted if it exists and reloaded with 
the data stored in the text file. 
 
3. Create a login page for your web application. The login page must: 
 Accept a username and email address. 
 The password must be compared to a hash (e.g., 
29ef52e7563626a96cea7f4b4085c124) in the tblUser table. 
23; 24; 25                      2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 16 of 31 
 When clicking the submit button, use HTML5 for validation. Textboxes and the 
password from the login details must be compared to the stored hashed password 
value in the MySQL database. 
 If the validation confirms that the password is valid, then display the user’s data using 
an associative read approach regarding the column names in a table. However, if the 
password is incorrect, then use a sticky form and redisplay the details entered allowing 
the user to edit the fields instead of re-typing all the fields. Display a string at the top of 
the page that identifies the user and reads: “User John Doe is logged in”. 
 If the user does not exist, they can register themselves and create the hash and login. 
Once a user is registered Administrators need to verify if the user is a customer. A user 
won’t be able to login instantly, unless verified. A new user registration would be 
pending until verified. 
 
4. Create a login page for the admin: 
 When the user clicks the “Admin” button, the user must be prompted to login with 
administrator rights, unless the user with those rights is already logged in. 
 Verify new customer registrations. 
 The admin user should be able to add, update and delete customers. 
 
5. Export your structure of each table to a Word file as part of your POE documentation. 
6. Create a text file for data on each base table and populate the text file with at least five fictitious 
entries for each base table. 
7. Use the console or phpMyAdmin and load the text file (data) manually into each base table. 
8. Export the database structure to a text file called myClothingStore.sql with the DDL 
statements so the lecturer can use the sql-text file to create your database with 30 entries for 
each base table. 
9. Create a script loadClothingStore.php that will create the tables within the ClothingStore 
database. Ensure that all tables are dropped before creating them and that a table is created 
only if it does not exist. Use MySQLi  or improved MySQLl  to create your connection in an 
include file. Hint: Export your database to an SQL file and use the exported code in association 
with PHP code. 
 
23; 24; 25                      
2026 
NB: You must create a demonstration video showing the web application on a browser. You 
may use your phones or a computer to create the video. For the video, make sure that you 
show the app performing the following functions: 
 
 
The user must be able to register using the application. This registration information must be 
stored in a MySQL database. 
The user must be able to login to the application using their username and password. 
 
 
 
All registration fields must be required fields, cannot be left be a blank field when the user 
registers on the application. 
Display the Administrator verifying the user as a customer and finally allowing them to login. 
Also show the code associated with the above functionalities. 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 17 of 31 
23; 24; 25                            2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 18 of 31 
Assessment Sheet (Marking Rubric) – Part 2__________________________________________________________________________________________ 
 
Please note: Include this rubric when you submit Part 2. 
 
MODULE NAME: MODULE CODE: 
WEB DEVELOPMENT (INTERMEDIATE) WEDE6021/w 
 
STUDENT NAME: 
STUDENT NUMBER: 
GROUP NAME: 
 
 
PART 2  Levels of Achievement Feedback 
To be awarded full 
marks for these 
elements, students 
must have: 
Excellent Good Developing Poor 
Score Ranges Per Level (½ marks possible) 
Good Coding 
Standards   
Variable naming and 
user-friendly design 
3 
Variables declared 
and assigned, 
excellently. 
2 
Good: Variable 
declaration and 
assignment. 
1 
Poor variable 
declaration and 
assignment. 
0 
No variables 
declared.  
  
23; 24; 25                            2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 19 of 31 
Comments/Code 
readability 
throughout PHP code; 
3 
Excellent use of 
comments and 
code readability of 
the code. 
2 
Comments and 
readability of the 
code mostly 
completed still 
developing. 
1 
Somewhat 
comments and 
readability of the 
code completed; 
more comments 
could be added. 
0 
No Comments and 
poor readability of 
the code.  
PHP file naming and 
correct folder 
structure 
3 
Excellent file 
naming and correct 
folder structure. 
2 
Good File naming 
and folder 
structure. 
1 
Developing file 
naming and folder 
structure. 
0 
Poor file naming 
structure and folder 
structure. 
 
CSS gives a 
professional look and 
feel to Task as a 
whole, i.e., Login 
Page and Tabular 
display. 
3 
Aesthetically 
pleasing with 
professional look 
and feel. 
2 
Aesthetically 
pleasing with 
mostly 
professional 
construction. 
1 
Some elements are 
professional.  
0 
Very poor attempt 
to make the CSS 
professional. 
 
Submission of a video 
showcasing the web 
application and 
associated code 
7—8 
Fully professional 
video showing all 
the required 
features in detail. 
5—6 
Not completely 
professional but 
all features 
demonstrate. 
1—4 
Informal and 
unprepared, or not 
showing all the 
features or no voice 
over included. 
0 
No demonstration 
video included. 
 
  
23; 24; 25                            2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 20 of 31 
User Table Structure 
and DB Connection      
ClothingStore 
Database Created, 
with tables 
5 
Database created 
with all required 
tables. 
3—4 
Database created 
with some tables 
missing. 
1—2 
Database poorly 
created. 
0 
Database created 
and tables missing.  
Text file created 
correctly with five 
names 
3 
Text file created 
and populated with 
five names. 
2 
Text file created 
with some names 
missing. 
1 
Text file 
incomplete. 
0 
Text file not 
created.  
Data is preloaded into 
a table tbl_user 
3 
All data is 
preloaded in the 
correct format. 
2 
Data is preloaded 
but with some 
discrepancies. 
1 
Data preloaded is 
incomplete. 
0 
Data is not 
preloaded.  
The script 
DBConn.php is 
included within the 
DBConn.php script 
with correct include 
statement. 
3 
Script included 
correctly. 
2 
Script included 
with some bugs. 
1 
Attempt at 
including the script 
but not functional. 
0 
Script is not 
included.  
Code makes a 
connection 
3 
Code connects to 
DB. 
2 
Code connects to 
DB but with some 
bugs. 
1 
Attempt made to 
connect but the 
connection doesn’t 
work. 
0 
No connection 
attempted.  
  
23; 24; 25                            2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 21 of 31 
The script 
createTable.php 
deletes table, creates 
table and load the 
data (Check in 
console). 
5 
Delete, create and 
load works 
correctly. 
3—4 
Delete, create 
and load has 
errors. 
1—2 
Only one function 
implemented. 
0 
No attempt made 
to Delete, create 
and load.  
Login Page   
New user registration 
3 
New user 
successfully 
added. 
2 
Attempt made to 
register a new 
user but with 
limited. 
1 
Failed attempt 
made to register a 
new user. 
0 
No option for a new 
user to register.  
Checks password 
against hashed 
password in tbl_User 
Password is validated 
and if password is 
incorrect the values 
stay – sticky form 
works 
5 
Password has been 
validated and 
action has been 
taken to ask to re
enter of password 
or continue to site if 
password is 
correct. 
3—4 
Password 
validated but not 
all action taken to 
act on validation. 
1—2 
Password 
incorrectly 
validated against 
hashed password 
and no action 
taken. 
0 
No password 
validation. 
 
Associative columns 
are fetched from the 
tbl_User table – 
Check code 
embedded in 
function. 
5 
Correct code 
embedded. 
3-4 
Attempt was 
made but buggy. 
1-2 
Attempt was made 
to embed but it 
does not work. 
0 
No code 
embedded.  
  
23; 24; 25                            2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 22 of 31 
User being added to 
the pending 
registration list, 
waiting for approval 
by Administrator 
 
User page displaying 
after successful login 
and verification by 
Administrator 
7—8 
Successful 
registration with 
validation and 
display of user 
page. 
5—6 
User successfully 
registered but 
user page does 
not display. 
1—4 
User not 
successfully 
registered with 
buggy code. 
0 
Student registration 
and user page does 
not work. 
 
Clothes or 
ClothesItem table 
Structure 
     
 Images folder exists 
and contains 5 jpg 
files with appropriate 
filenames. 
3 
Five images in 
folder. 
2 
Three to four 
images in folder. 
1 
One to two images 
in folder. 
0 
Zero images in 
folder.  
The table tbl_Item is 
(assoc) read into 
array and displayed in 
a table with headers. 
 
5 
Array is correctly 
populated with 
tbl_Item and 
displayed with 
headers. 
3—4 
Array is correctly 
populated with 
tbl_Item but 
headers are not 
displayed. 
1—2 
Array is incorrectly 
populated with 
tbl_Item and 
headers are not 
displayed. 
0 
Array is not 
populated.  
Each line contains the 
picture of the item 
and each line carries 
the AddToCart/ Cart 
Picture button 
5 
Add to cart and line 
item displays 
correctly with 
picture button. 
3—4 
Add to cart 
displays correctly 
with ordinary 
button. 
1—2 
Add to cart and line 
item do not display 
correctly and there 
is no picture button. 
0 
No add to cart 
function.  
23; 24; 25                            2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 23 of 31 
When AddToCart is 
clicked the SellPrice 
is shown in popup 
and returns to table. 
5 
SellPrice is shown 
in popup and 
returned to table. 
3-4 
SellPrice is shown 
in popup but not 
returned to table. 
1-2 
SellPrice is not 
shown in popup 
and not returned to 
table. 
0 
No add to cart 
function  
Admin Login and user 
Verification   
Check 
Administrator’s 
password against 
hashed password and 
username should be 
admin email address 
5 
Administrator’s 
password verified 
against hashed 
password and 
username is  admin 
email address. 
3—4 
Administrator’s 
password verified 
against hashed 
password but 
username is  not 
admin email 
address. 
1—2 
Administrator’s 
password is not 
verified and 
username is  not 
admin email 
address. 
0 
No attempt at 
Administrator’s 
password 
verification.  
Verification of user as 
a customer and user 
being allowed to login 
5 
User verified as a 
customer and 
allowed to login. 
3—4 
User verified as a 
customer but not 
allowed to login. 
1—2 
User not verified as 
a customer and 
allowed to login. 
0 
No attempt to verify 
the user as a 
customer. 
 
Adding, updating and 
deleting users 
8—9 
All Adding, updating 
and deleting of 
users works. 
5—7 
Only two of the 
Adding, updating 
and deleting 
functions work. 
1—4 
Only one of the 
Adding, updating 
and deleting 
functions work. 
0 
No Adding, 
updating and 
deleting functions 
work. 
 
 
[TOTAL MARKS: 100] 
 
                                                                                                                               END OF PART 2                                                         
 
23; 24;l 25                                                                                                                           2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 24 of 31 
PORTFOLIO OF EVIDENCE (POE)                                                                               (Marks: 100) 
 
Complete all sections. 
 
Section 1                                                                                                                                                           (Marks: 75) 
 
For the final submission of the app, you need to include the following features that were not 
required for the prototype: 
 
 The user (Customer) must be able to select items for buying and check them out in the 
shopping cart and select the option to continue shopping. 
 The Administrator user should be able to add, delete and update clothing and users. 
 Customer should be able to edit items in their shopping cart. 
 Seller should be able to send a request to sell clothes, the user should be able add a 
description, an image and the brand of the clothing.  
 The Administrator should communicate with sellers and buyers to make sure the correct 
items are delivered and in good condition. 
 
In addition to these features, you must have: 
 Your own features as described in your design document. 
 Visually appealing website which is easy to navigate. 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
23; 24;l 25                                                                                                                           2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 25 of 31 
Section 2                                                                                                                                          (Marks: 25) 
 
Each individual member of the group must reflect on their learning. Your reflection should be  
±1 500 words (Calibri font, size 11, 1.5 spacing). 
 
Please include this self-reflective report when submitting your final PoE. 
Introduction  
Write an introductory paragraph in which you briefly outline your understanding of the POE. (5) 
Role in the team  
Discuss 
 Your contribution to the team. 
 The group dynamic of the team. 
 Dealing with concerns, complaints, queries and conflict working in a team.                      (5) 
Research, technology, and the presentation of information 
 
Finding information that is both relevant and useful is a much-needed skill: 
 Describe two scenarios in which you were expected to find information for a task or duty 
that you had to complete.                                                                                                             (5) 
Personal strengths (strong points) and weaknesses (areas to do better in) 
 
Comment on the elements, tasks or duties required for the POE: 
 List and describe the tasks that you did really well in. 
 Identify at least five strengths that you realised you have. 
 List and describe the tasks that you did not do well in. 
 Why, in your opinion, did you not perform well in these tasks? 
 Comment on how you think you can improve on the weaknesses that you identified.    (8) 
Conclusion 
 
Write a summary whereby a clear overall impression of the POE group work is discussed.        (2) 
 
 
23; 24; 25                                                                      2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 26 of 31 
Assessment Sheet (Marking Rubric) – POE____________________________________________________________________________________________ 
 
Please note: Include this rubric when you submit your final POE. 
 
MODULE NAME: MODULE CODE: 
WEB DEVELOPMENT (INTERMEDIATE) WEDE6021/w 
 
STUDENT NAME: 
STUDENT NUMBER: 
GROUP NAME: 
 
POE – SECTION 1 Levels of Achievement Feedback 
To be awarded full marks for 
these elements of the POE, 
students need to have: 
Excellent Good Developing Poor 
Score Ranges Per Level (½ marks possible) 
Shopping Cart Class and 
Member Functions   
Member functions AddItem, 
RemoveItem, Checkout, 
EmptyCart, Login, ProcessInput 
are present. As long as the 
student illustrates 
understanding, he/she may use 
own functions. 
5 
All relevant 
functions 
included. 
3—4 
Some functions 
are missing. 
1—2 
Some functions 
are missing or not 
working. 
0 
No functions 
present. 
 
  
23; 24; 25                                                                      2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 27 of 31 
Startup page clearly states type 
of eShop and goals styled on 
some CSS. 
4 
Startup page 
contains the type 
of eShop and 
goals which are 
styled on some 
CSS. 
3 
Startup page 
contains the type 
of eShop but not 
the goals. 
1—2 
Startup page does 
not contain the 
type of eShop 
and/or goals. 
 
0 
No type of 
eshop/goal 
statement.  
eShop button displays Items 
table with  the buttons 
AddToCart and ShowCart. 
 
4 
eShop button 
displays Items 
table with  the 
buttons 
AddToCart and 
ShowCart. 
 
3 
eShop button 
displays Items 
table with only 
one of the  buttons 
AddToCart or 
ShowCart. 
1-2 
eShop button 
displays Items 
table with no 
AddToCart or 
ShowCart 
buttons. 
 
0 
eShop button has 
no functionality. 
  
Clicking on ShowCart to view 
the shopping cart contents. 
3 
ShowCart 
displays shopping 
cart contents. 
2 
ShowCart has 
limited 
functionality 
1 
ShowCart button 
has no 
functionality 
0 
No ShowCart 
button  
Administrator Option to load 
Items and Pictures of the Items   
Prompt for login when Admin 
button is clicked or URL loaded. 
3 
Login is prompted 
when Admin 
button is clicked 
or URL loaded. 
 
2 
Prompting to Login 
only works on 
either the Admin 
button click or the 
URL loading. 
 
1 
No prompting on 
login or URL 
loading. 
0 
No Admin button. 
 
23; 24; 25                                                                      2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 28 of 31 
Admin button/ URL landing page 
displays items table with 
buttons Edit, Delete and Add/ 
Insert. 
3 
Items table 
displayed with 
buttons Edit, 
Delete and Add/ 
Insert. 
2 
Items table 
displayed with 
some buttons 
missing. 
1 
Items table buggy 
and does not 
work. 
0 
No attempt made 
to display Items 
table.  
Add, Delete and Edit buttons 
work for Admin on clothes or 
clothesItems table. 
7—8 
Add, Delete and 
Edit buttons work 
on clothes or 
clothesItems 
table. 
 
5—6 
Not all Add, 
Delete and Edit 
buttons work 
clothes or 
clothesItems 
table. 
3—4 
Buttons only work 
on clothes or 
clothesItems 
table. Very buggy. 
 
0—2 
No buttons to 
add/delete and 
edit.  
Shopping Cart Functionality   
When adding same item to Cart, 
quantity increases, and not new 
item added. 
4 
When adding 
same item to Cart, 
quantity 
increases, and no 
new item added. 
3 
When adding 
same item to Cart, 
quantity 
increases, and a 
new item added. 
1—2 
When adding 
same item to Cart, 
a new item is 
added. 
0 
When adding 
same item to Cart 
it is not added to 
quantity and a 
new item is not 
created. 
 
When continuing to shop, the 
shopping Cart remains available 
with selected Items still intact. 
3—4 
Shopping Cart 
remains available 
with selected 
Items still intact 
when user 
continues 
shopping. 
N/A 1—2 
Shopping Cart is 
zeroed when the 
user continues 
shopping. 
0 
No shopping cart. 
 
23; 24; 25                                                                      2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 29 of 31 
Checkout returns user to 
login/register page  
3 
On checkout, user 
is returned to 
login/register page 
with appropriate 
messaging. 
1—2 
On checkout, user 
is returned to 
login/register 
page. 
N/A 0 
On checkout, user 
is not returned to 
login/register 
page. 
 
checkout shows reference 
number e.g., orderNum and 
sessionId. 
3 
Reference 
numbers 
displayed. 
1—2 
Reference 
numbers 
displayed but not 
in correct format. 
 0 
No attempt made 
to display 
reference 
numbers. 
 
checkout writes entries into 
orderLine table and quantity 
decremented (check tables in 
database). 
7—8 
Entries written to 
orderLine table 
and quantity 
decremented. 
5—6 
Entries written to 
orderLine table 
and quantity not 
decremented. 
3—4 
Entries not written 
to orderLine table 
but quantity is 
decremented. 
0 
Entries not written 
to orderLine table.  
After checkout the Shopping 
Cart array is empty. 
3—4 
Shopping cart is 
zeroed after 
checking out. 
N/A N/A 0—2 
Shopping cart still 
contains items 
after checking out. 
 
features specified in the design 
document implemented 
4 
Design document 
features applied. 
1—3 
Design document 
partially applied to 
final application. 
N/A 0 
Design document 
not applied to final 
design. 
 
User has option to draw history 
of purchases. Report must show 
total of all purchases at bottom 
of page 
7—8 
History report with 
correct totals. 
5—6 
History report 
created but totals 
incorrect. 
3—4 
Attempt made at a 
report. 
0 
No reports 
created.  
23; 24; 25                                                                      2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 30 of 31 
Web application executes 
3 
Executes and 
displays home 
page. 
2 
Executes but 
landing page is not 
home page. 
1 
Buggy loading of 
the home web 
page. 
0 
Does not execute.  
Submission of a final video 
showcasing the web application 
and associated code with a 
“readme” file 
4 
video showing all 
the required 
features in detail 
and a 
comprehensive 
ReadMe file. 
 
3 
Video includes all 
of the functionality 
but and is no 
ReadMe file. 
1—2 
Video includes 
most of the 
functionality but 
and is no ReadMe 
file. 
0 
No video. 
 
  
 
 
POE – SECTION 2 Levels of Achievement Feedback 
To be awarded full marks for 
these elements of the POE, 
students need to have: 
Excellent Good Developing Poor 
Score Ranges Per Level (½ marks possible) 
Self-Reflection   
 
Introduction 
5 
Comprehensive 
and well thought 
out description of 
the POE as a 
whole. 
3—4 
Good description 
of the POE but 
lacking detail. 
1—2 
Brief introduction 
which doesn’t 
answer the brief. 
0 
No introduction. 
 
Role in the team 4—5 
Identified and 
associated 
3 
Identified general 
roles but nothing 
1—2 0 
No roles 
identified. 
 
23; 24; 25                                                                      2026 
© The Independent Institute of Education (Pty) Ltd 2026 
Page 31 of 31 
themselves with a 
specific role. 
specific for 
themselves. 
Difficulty in 
identifying the 
roles. 
Research, technology and the 
presentation of information  
4—5 
Two scenarios 
identified and well 
described. 
3 
Two scenarios 
identified but 
poorly described. 
1—2 
One scenario 
identified. 
0 
No scenarios 
identified.  
Personal strengths (strong 
points) and weaknesses (areas 
to do better in)  
 
6—8 
Excellent self
reflection and 
identification of 
strengths and 
weaknesses. 
4—5 
Some good points 
made on strengths 
and weaknesses 
but it is not a 
comprehensive 
list. 
 
1—3 
Brief discussion of 
strengths and 
weaknesses on 
limited topics. 
0 
No self-reflection 
on duties for the 
POE.  
Conclusion 
 
1—2 
Clear conclusion 
that wraps up the 
report. 
N/A 
 
N/A 0 
No conclusion.  
 
[TOTAL MARKS: 100] 
END OF POE  
 