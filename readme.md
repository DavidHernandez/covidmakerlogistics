# Covid Maker Logistic

The system is based on Drupal 8.

## Set up

* First of all, you need the system dependencies. Install them executing `composer install`. One of the dependencies is `drush/drush`. This package allow us to use a cli program to manage Drupal.
* Install Drupal executing `vendor/bin/drush si --db-url=YOUR_DB_URL`. Replace YOUR_DB_URL by something like `root:123@localhost/drupal8`.
* To be allowed to use the same configuration, we need all the instances of the site to use the same UUID: `590ec665-6ebb-4b61-b4cc-146f1b49e4fd`. Execute `vendor/bin/drush --yes config-set "system.site" uuid "590ec665-6ebb-4b61-b4cc-146f1b49e4fd"`
* Update settings.php and change the `config_sync_variable` to be `$settings['config_sync_directory'] = '../config/sync/';`
* Execute the next command: `vendor/bin/drush ev '\Drupal::entityManager()->getStorage("shortcut_set")->load("default")->delete();'`
* Update default content: `vendor/bin/drush migrate-import --tag=migrate_default_content`
* Now you can import the configuration: `vendor/bin/drush cim -y`

## Export your configuration

* For doing this, you just have to execute `vendor/bin/drush cex`

## Generating default content:

* Export content: `vendor/bin/drush mdce`
* Review the exported content and remove whatever is not necessary.
* Generate automatic import files: `vendor/bin/drush mdcby`
* Commit and push
