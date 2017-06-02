# Private Site Plugin  ( ON DEVELOPMENT )


The **Private Site** Plugin is for [Grav CMS](http://github.com/getgrav/grav). It provide an authentification form to keep private your Grav site or part of it.


**Requires Login, Form, Email plugins, and integrated with Admin plugin, on Page=>Options**

 - Adding and Managing user : https://learn.getgrav.org/admin-panel/faq#adding-and-managing-users
 - ACL : https://learn.getgrav.org/advanced/groups-and-permissions
 - Allow User Registration : https://github.com/getgrav/grav-plugin-login/blob/develop/README.md#allow-user-registration


## Installation

Installing the Private Site plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install private-site

This will install the Private Site plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/private-site`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `private-site`. You can find these files on [GitHub](https://github.com/di-yzzuf/grav-plugin-private-site) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/private-site
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/private-site/private-site.yaml` to `user/config/plugins/private-site.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
```

## Usage

**Describe how to use the plugin.**

## Credits

**Did you incorporate third-party code? Want to thank somebody?**

## To Do

- [ ] Future plans, if any

