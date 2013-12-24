# Sirportly Wordpress Short Code Plugin
A simple Wordpress short code plugin to submit tickets to Sirportly.

## Installation Instructions 
* Uncompress the zip file and upload to your Wordpress installation /wp-content/plugins/sirportly 
* Navigate to Plugins > Installed Plugins and click the "Activate" link 
* Navigate to 'Settings > General' where you'll find three new settings, you need to generate a new API Token from the admin area of your Sirportly account that only has the permission to 'Submit Ticket' then fill out the API token and API Secret.

## Usage

Once the plugin has been configured you can then edit the page you wish the form to be on by placing the following code:

```PHP
[sirportly brand="test" department="Technical Support" status="New" priority="Low" confirmation="Thanks for contacting us! We will get in touch with you shortly."]
```

The options required for the shortcode to work are:

* `brand` - the name or ID of a brand 
* `department` - the name or ID of a department 
* `status` - the name or ID of a status 
* `priority` - the name or ID of a priority 
* `confirmation` - text to display after the form has been submitted
