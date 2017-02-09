# Goggle #

```plain
      /)        /)
     /__   ___/
    (_._)-(_._)
```

Not to be confused with Google. Google finds anything, Goggle will help you
look at anything.

Nearly anything ;)

## What is it? ##

A command line tool to easily read values from config files and output them in
several different formats, with chaining through piping in mind.

## Supported formats ##

* Input: `json`, `yaml` and `ini`
* Output: `json`, `yaml`, `ini`, `text` (column based), formatted console
  table, markdown table

## Usage ##

### Read a 'deep' value from a configuration file

```
goggle get -i FILE element0..elementN [-O=FORMAT]
```

Read value FILE from path `element0..elementN` and output it in the specified format.

For example given a JSON string `{"a": {"b": {"c": 123}}}`, reading the value
'123' would be done by executing `goggle get a b c`
 
### Process a set of values
  
```
# Each of the records in the file FILE will be mapped by key `name`, and only fields
# 'author' and 'name'  are kept, other fields are dropped.

goggle process -i FILE mapBy name fields author name 
```

## Example ##


### Example 1 ###
Show package names, versions and authors, extracted from composer.lock

```
goggle get -i ./composer.lock packages \
    | goggle process -I json fields name version authors \
    | goggle process -I json mapBy name 
```

Or only get the one for `symfony/symfony`:

```
goggle get -i ./composer.lock packages | goggle process -I json fields name version authors | goggle process -I json mapBy name | goggle get "symfony/symfony"
```

### Example 2 ###
Read the database host name from the following file and output it's value:

```
goggle get -I yaml parameters database_host -O json -O text < app/config/parameters_staging.yml
```

Given the following file:
```
parameters:
    database_host: foo
```
This would output:
```
foo
```

### Example 3 ###
See all values available in a composer lock file

```
goggle get -i composer.lock -O dump
```

Or read all package names and versions from a composer lockfile:

```
goggle get -i composer.lock | goggle fields name version
``` 

### Example 4 ###
Or simply convert yml to json:

```
goggle get app/config/parameters.yml -O json
```
or:

```
goggle get -I yaml -o json < ./app/config/parameters.yml
```

### Example 5 ###
Set the database host name in the following file:

```
goggle set -e app/config/parameters_staging.yml parameters database_host remote_host
```

Given the following file:
```
parameters:
    database_host: remote_host
```

This would output:

```
foo
```

## More documentation by example ##

Read the behat features to see more possibilities.

## Reference

Read the [wiki](https://github.com/zicht/goggle/wiki) for a more detailed
reference.
