# Zicht configtool #

A command line tool to easily read values from config files and output them in several different formats.

## Usage ##

```
cfg get FILE element0..elementN [--format=FORMAT] [--each=e1 [--each e2 [...]]] [--property p1 [--property p2 [...]]]
```

Read value FILE from path `element0..elementN` and output it in the specified format. If `--each` is specified, iterate over that path. If `-p` is specified, filter those properties from the found objects.

## Example ##

### Example 1 ###
Read the database host name from the following file and output it in JSON:

```
cfg app/config/parameters_staging.yml parameters database_host --format=json
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

### Example 2 ###
See all values available in a composer lock file

```
cfg get composer.lock --format=dump
```

Or read all package names and versions from a composer lockfile:

```
cfg get composer.lock --each packages -p name -p version
``` 

### Example 3 ###
Or simply convert yml to json:

```
cfg get app/config/parameters.yml -o json
```
or:

```
cfg get - -t yaml -o json < ./app/config/parameters.yml
```
