* Visit the link and click "Enable the Google Analytics Data API v1"
https://developers.google.com/analytics/devguides/reporting/data/v1/quickstart-client-libraries
* Type the name and click Next then Download the json file after setup process
* Read json file and copy client_email value & copy it

* Go the Google Analytics, open the project / property which you want to track stats for
https://analytics.google.com/analytics
* After opening the property / project, click Setting or Gear icon in the bottom left
* Click "Account" then click "Account access management"
* Click Blue icon or "Add access permissions to new user" then click "Add User"
* Now paste the email in "Email Address" then select Standard Role as "Administrator" then click "Add"
* Now where you clicked "Account", Click "Property" then click "Property Details" and copy "PROPERTY ID"

* Now in laravel project, open .env file and paste "PROPERTY ID" in "PROPERTY_ID"
* Copyname of the JSON file, open .env file and paste file name as value in "JSON_FILENAME"
* In laravel project store your JSON file in /storage/app/google/ folder (create google folder if not present)

<!-- Ignore it :) -->
starting-account-r6kbawh98rci.
quicksignage-eb280410ad4b.json
