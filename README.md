_This is the Trade Fair project_.
A modern WordPress plugin which uses the [WP Emerge](https://github.com/htmlburger/wpemerge) framework. It is currently available in French and English.

## Summary

- [Documentation](#documentation)
- [Development Team](#development-team)

## Documentation

### How it works

**Adding companies**

Add user in the WP Dashboard with the Exhibitor group.

**Modifying companies information**

If you are an admin, you can do it in the user's settings.
If you are a company, log in with you account and you will be redirected to your Trade Fair Profile. From there you can modify your information. The plugin creates a new endpoint at yoursite.com/trade-fair-profile.

**Modifying Trade Fair Data**

Go to the WP Dashboard and in the Trade Fair section. Make your changes and press save.
You can specify the trade fair name and schedule of the trade fair.

**Displaying companies**

To display the companies you can use the Gutenberg Block if your theme supports Gentenberg.
You can also use the shortcode ```[tf-companies]```. Companies will be rotating during a schedules period in the admin Trade Fair section.

__Attributes available:__

n_cols: specify the number of columns
    
    Values: 1 to 4
    Ex: n_cols=2

location: Specify companies from which locations will be displayed. 
    
    Values: Canada, USA, Europe. You can specify many location by separating them with comma.
    Ex: location=USA,Canada

exclude: do you want to exclude companies in the location specified.

    Values: true or false
    Ex: exclude=true
    
Complete example: ```[tf-companies n_cols=3 location=Canada exclude=true]```

This example will display every companies not in Canada.

### Installation

Upload the released folder using FTP or the zipped version using the dashboard.

N.B: I don't know why, but on some installations the exhibitor role has to have the delete_users permission to be able to see and upload images in the Trade Fair Profile section.

### Suggested plugins

Here are some plugins to improve/complete the Trade Fair plugin:

- [WP Users Media](https://wordpress.org/plugins/wp-users-media/): give each user it's media folder. Go to settings and enable it for only the Exhibitor group.
- [Loco translate](https://wordpress.org/plugins/loco-translate/): French and English are available, but you can translate the plugin in more languages. Feel free to add your translations to the repo.
- [Loginer](https://fr-ca.wordpress.org/plugins/loginer-custom-login-page-builder/): Customise your login page. You can disable Dashboard bar by going to Loginer > settings > General and add the Exhibitor group in the Restrict User From Dashboard 

### Customisation

You can customise the colors in the trade fair profile by setting css variable. Current css variables are:

--tf-accent-color
--tf-text-accent-color //Text color when used on --tf-accent-color background color
--tf-error-color

To modifify the company grid:

--tf-border-width
--tf-border-radius
--tf-border-style
--tf-border-color

The current css is very light. You can easily modify the appearance by overriding the css in your theme's css or by cloning the project.

### WPEmerge doc
[http://docs.wpemerge.com/#/starter/plugin/overview](http://docs.wpemerge.com/#/starter/plugin/overview)
[http://docs.wpemerge.com/#/starter/plugin/quickstart](http://docs.wpemerge.com/#/starter/plugin/quickstart)

## Development Team

This Trade Fair plugin is developped by [Michael Duchesne](https://github.com/Mick00) from [Propulsion Carrière](https://propulsioncarriere.ca) a practice enterprise.
WPEmerge is developped by [Atanas Angelov](https://atanas.dev/) at [htmlBurger](http://htmlburger.com).
