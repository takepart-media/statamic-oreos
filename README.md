# Oreos

> Cookie consent manager for Statamic 3

## Features

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require takepart/oreos
```

## How to Use

### Form and popup usage

To add the popup with the included form to your layout, use the `oreos:popup` tag to place it at it's belonging position (usually near the end of the body as first-level child):

**resources/views/layout.antlers.html**
```
        ...

        {{ oreos:popup }}
    </body>
</html>
```

When saved, the page gets reloaded (technically, we got redirected to the referers page after saving within the posted controller's action at `/!/oreos/save`).

To recall the settings, usually within the privacy statements, add the `oreos:form` tag. This can be done within your content, but be sure to allow antlers to be parsed:

```
{{ oreos:form }}
```

This will show just the form from the popup, not everything around.

### Custom views

Pretty sure you want to customize the experience for your visitors: we got you covered. With the help of our tags, you can pretty easily overwrite and customize both the popup as well as the form – or just some part of it.

(tbd)

### Check for consents

To check if a cookie group was given consent to, use the `oreos:check` tag:

```
{{ if {oreos:check key="yourgrouphandle"} }}
    do something if yourgrouphandle is checked
{{ else }}
    do something if yourgrouphandle is *not* checked
{{ /if }}
```

## Authors

- Dennis Dick, <dick@takepart-media.de>
- Jakob Plöns, <jploens@takepart-media.de>

© 2021 TAKEPART MEDIA
