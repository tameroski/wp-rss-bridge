# WP RSS Bridge

Use social network data in you WP project.

Based on [RSS Bridge](https://github.com/RSS-Bridge/rss-bridge/)

Data are cached for better performances.

## Usage

```php
$bridges = array(
    "Facebook" => array(
        'u' => 'zuck',
        'media_type' => 'all'
    ),
    "Twitter" => array(
        'u' => 'Jack',
        'norep' => 'on'
    ),
    "Instagram" => array(
        'u' => 'kimkardashian'
    )
);
$processor = new Wp_Rss_Bridge_Processor($bridges);
$data = $processor->get_data();
```

Default cache timeout is 24h. This can be changed using : 

```php
$processor = new Wp_Rss_Bridge_Processor($bridges, 60); // Second parameter is cache timeout in seconds.
```

Finally, it's also possible to change the user agent ued when querying data : 

```php
$processor = new Wp_Rss_Bridge_Processor($bridges, 60, "User Agent");
```

### Bridges

Each bridge has its own settings, defined in its own PHP class in RSS Bridge. See RSS Bridge Documentation and source code for more informations.

## Filters

Settings can also be changed using filters : 

```
$user_agent = apply_filters('wp-rss-bridge_user_agent', $user_agent);
$bridges = apply_filters('wp-rss-bridge_bridges', $bridges);
$cache_timeout = apply_filters('wp-rss-bridge_cache_timeout', $cache_timeout);
```