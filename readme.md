# Covid Maker Logistic

The system is based on Drupal 8.

## Set up

* First of all, you need the system dependencies. Install them executing `composer install`. One of the dependencies is `drush/drush`. This package allow us to use a cli program to manage Drupal.
* Install Drupal executing `vendor/bin/drush si --db-url=YOUR_DB_URL`. Replace YOUR_DB_URL by something like `root:123@localhost/drupal8`.
* To be allowed to use the same configuration, we need all the instances of the site to use the same UUID: `590ec665-6ebb-4b61-b4cc-146f1b49e4fd`. Execute `vendor/bin/drush --yes config-set "system.site" uuid "590ec665-6ebb-4b61-b4cc-146f1b49e4fd"`
* Now you can import the configuration: `vendor/bin/drush cim -y`

## Export your configuration

* For doing this, you just have to execute `vendor/bin/drush cex`
