System overview
==================
The Virtual Cash Register System was written to provide a simple alternative to a paper driven procedure.  Searching the internet for inexpensive cash registers that could be easily moved, netted no results. Any software found was tied to a particular hardware device or some other accounting software.

Both accounting and marketing requirements were addressed. Accounting wants control and financial information, they do not need information about products sold whereas the marketing people need that information.

 Therefore, the following criteria was used to develop the Virtual Cash Register.

- Simplicity
- Minimum Security
- Portability

The system was developed with the idea that other organizations might want to use some components of the system. We submitted this system to Github and PHP,both open source enablers,so that others can use and improve the system.
System features
------------------
- Price look-up for items.
- Automatic  Michigan Sales Tax computation. (SimpleCart has other tax plans)
- Allows manual entry of items not on the look-up list.
- Provides product movement visibility.
- Provides purchased product accountability.

System Requirements
------------------
- Devices that can connect to the internet.
- Devices that have javascript enabled (desktops, laptops, tablets and cell phones)
- Trained Virtual Cash Register users or a person to transcribe the paper records after the shift.
- PHP 
- MySql
- javascript enabled
- Jquery
- Jqueryui
- Dough(nathansearles/Dough) for jquery cookies
- jTable.org
- Bootstrap (getbootstrap.com)
- SimpleTest (http://www.simpletest.org/)
- simpleCart.js (http://simpleCart.org)

System Possibilities
--------------------
With the incorporation simpleCart.js, it is possible to install credit card payments using Paypal, Google Pay, Yahoo Pay, and Amazon.

Things To Do
------------------
- Automated void and return procedure
- Spreadsheet output
- Pop up for items not in the Price Lookup table.

 
System Components
================== 
Clerk file
------------------
Has fields for name, password, phone number and role. There are presently three roles, clerk, manager and administrator.
Department File
------------------
Has fields for name and tax calculation data.
Product Look-up file (PLU)
------------------
Has fields for name, department, unit price and a price override field to allow clerk to modify the unit price. (Currently not implemented)
Tax file
------------------
 Contains tax calculation data for various taxes. Currently only has Michigan Sales tax information.
Transaction File
------------------ 
Collects information pertaining to:
- Date of transaction 
- Transaction type (currently only sale)
- Clerk identification number
- Department identification number
- Product Look-up identification number(PLU)
- Quantity
- Description of item
- Unit Price
- Tax
- Transaction amount

Configuration File
------------------
This file must be created at implementation time and it should contain the following entries:

- define('ORGNAME_DEF','The name of your organization');
- define('ORGADDRESS_DEF', 'Address');
- define('ORGCITY_DEF', 'City');
- define('ORGSTATE_DEF' , 'state');
- define('ORGZIP_DEF' , 'zip');
- define('ORG_TOP_PHRASE' , 'A phrase that you would want to be on top of a printed receipt');
- define('ORG_BOTTOM_PHRASE' , 'A Phrase that you would want to be on the bottom of a printed receipt');
- define('HOST_SERVER', 'The jost server');
- define('DATABASE_USERNAME', 'username');
- define('DATABASE_PASSWORD', 'password');
- define('DATABASE_NAME' , 'data base name');
- define('WEBMASTER_ADDRESS' , 'your webmasters email address');


Proxy Entry
-----------
This system is designed to capture transactions as they occur by the operator of the Virtual Cash Register which not only provides the accounting control but also provides marketing information. However, the Proxy Entry function allows some authorized person to enter only the accounting information from the paper shift reports provided by operators who either lack the hardware, and/or skill to use the Virtual Cash Register, at a later time.



Index screen
------------------
![Index screen](http://www.graynwhite.com/cashRegister/indexLogin.png "Index screen")
- controls log in validation
- Provides Managers with reporting and control features.
![](http://www.graynwhite.com/cashRegister/indexManager.png "Manager screen")


Register screen
------------------
![Register Screen](http://www.graynwhite.com/cashRegister/register.png "Register")
Provides register personnel with transaction input capabilities and a log out button to end their shift.

Log out screen
------------------
Presents a mini-report of the actions taken during their shift and a button to send the information to their manager.