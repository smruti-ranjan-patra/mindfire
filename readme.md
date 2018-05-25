1. Create a directory named as "loan_tap" in the root directory with proper access.

2. Create a database names as "loan_tap" with proper user privilege and set the DB configuration in "constants.php" file.

3. Before running "composer install", The following software is required to develop using PhpSpreadsheet:

- PHP version 7.0 or newer
- PHP extension php_zip enabled
- PHP extension php_xml enabled
- PHP extension php_gd2 enabled (if not compiled in)

4. run "composer install", which will create the vendor file and grant necessary permission to the vendor directory.

5. Give proper permission to "storage" directory as generated reports will be stored there.

6. The excel report will be downloaded to the specific directory as per the configuration of browser (if not configured then default will be downloads directory of the system)
