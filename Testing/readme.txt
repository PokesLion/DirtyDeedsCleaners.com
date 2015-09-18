# DirtyDeedsCleaners.com
Mock cleaning business


This contains php files for many things : 


-----------------------------------------------------
CORE FILES
=====================================================
index.php                         : Index homepage
theme.css                         : Style 
html.php                          : Meat and potatoes   (functions : htmlHeader , htmlBody , htmlEnd)
functions.php                     : Meat and potatoes
main.php                          : The common file    ( File creates a html header and inclues all commonly necessary functions and files )
-----------------------------------------------------

404page.php                       : .htaccs points here            
admin.php                         : Contains a dropdown  ul with some tools
adminCommand.php                  : Allows the entry of SQL commands into a form
checkout.php                      : Final Appointment Page Contains javascript to total the price and has addon items on click with div hilighting    
contact.php                       : Allows users to enter email information
emailInfo.php                     : Displays Information entered in AdminCommand.php
findDB.php                        : Finds the name of the SQL database currently connected to
findTables.php                    : Finds the tables and datatypes of the current database
highlightCity.html                : Study file for creating a service map with google API's using ( lat, lng)
lessMonths.php                    : Adds ++ to a variable that determines the current month to view on scheduleAppointment.php  
loginPage.php                     : Login page  > submits to process.php
logout.php                        : Destroys session
LosAngelesCities.txt              : Text file for building a service map and zip code limitation for addresses
map.php                           : Google maps API  100% of screen
moreMonths.php                    : Subtracts 1 from a variable that determines the current month to view on scheduleAppointment.php  
my_script.js                      : Intterupts form submits,  from a jQuery, AJAX, PHP tutorial
process.php                       : Verifies login details
processCheckout.php               : Adds the data from Finalize into appointments for SQL database
quote.php                         : Handles what happens when a user is scheduling an appointment & when not logged in yet. Sends the user to the login page but stores the information entered
remove.php                        : Kills the timer on cookies
resetSql1.php                     : Resests all the SQL data for function dynamicSQLCommand()
resetSql2.php                     : Resets the table of dynamicSQLCommand()
scheduleAppointment.php           : Displays a calendar which can be clicked on and the values saved
scheduleDay.php                   : Asks for the remainder of the appintment information except for address & payment & extras
services.php                      : Shows what services are offered for cleaning  
showSQL.php                       : Prints data of the SQL command in adminCommand.php
sqlColumns.php                    : Modify the SQL table selected with dynamicSQLCommand()
sqlCommand.php                    : Asks SQL COMMANDS in form
sqlTable.php                      : Displays the connection settings of dynamicSQLCommand()
testPortal.php                    : Switches the directory to a testing enviornment and back
useLastSQL.php                    : Connects to SQL database for loading what the last settings were of file sqlTable.php 
userInfo.php                      : Querys database for users
viewData.php                      : Used with file (sqlTable.php) retrieves collumnsfrom the SQL table
viewInvoice.php                   : Shows recorded SQL invoice data
