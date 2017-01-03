# Goggle #

```plain
      /)        /)
     /__   ___/
    (_._)-(_._)
```

Not to be confused with Google. Google finds anything, Goggle will help you look at anything.

Nearly anything ;)

## What is it? ##

A command line tool to easily read values from config files and output them in several different formats, with chaining through piping in mind.

## Supported formats ##

* Input: `json`, `yaml` and `ini`
* Output: `json`, `yaml`, `ini`, `text` (column based)

## Usage ##

### Read a 'deep' value from a configuration file

```
goggle get -i FILE element0..elementN [-o=FORMAT]
```

Read value FILE from path `element0..elementN` and output it in the specified format.
 
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
goggle get -i ./composer.lock packages | goggle process -t json fields name version authors | goggle process -t json mapBy name 
```

Or only get the one for `symfony/symfony`:

```
goggle get -i ./composer.lock packages | goggle process -t json fields name version authors | goggle process -t json mapBy name | goggle get "symfony/symfony"
```



### Example 2 ###
Read the database host name from the following file and output it in JSON:

```
cat app/config/parameters_staging.yml | goggle get -t yaml parameters database_host -o json
```

Given the following file:
```
parameters:
    database_host: foo
```
This would output:
```
"foo"
```

### Example 3 ###
See all values available in a composer lock file

```
goggle get -i composer.lock -o=dump
```

Or read all package names and versions from a composer lockfile:

```
goggle get -i composer.lock | goggle fields name version
``` 

### Example 4 ###
Or simply convert yml to json:

```
goggle get app/config/parameters.yml -o json
```
or:

```
goggle get - -t yaml -o json < ./app/config/parameters.yml
```

