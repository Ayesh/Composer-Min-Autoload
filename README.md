<div align="center">
	<img src="https://ayesh.me/files/static/composer-min-autoload/banner.png">
	<br>
</div>


# Composer Min Autoload
A Composer plugin to generate slightly minimal Autoloader with a new `dump-min-autoload` command

---

> Composer autoloader is too stable to my taste.

> Composer's autoloader files are so huuge, and they take a big portion of my 20KB hard disk.

> Composer autoloader needs to load FOUR files to load? Only THREE is ACCEPTABLE!

> A composer plugin a random bored guy put together during COVID-19 pandemic? Put it in prod!


Any of these sound like you? Say no more fam, **Composer Min Autoload** has got you covered.

**Composer Min Autoload is a Composer plugin that generates a slightly minimal Autoloader.**

### Wha? Composer Autoloader is bloated?

Composer Autoloader is stable and well-thought. It even works on PHP 5.2 even though Composer itself requires PHP 5.2.

When you generate Composer Autoloader, these files are created:

```
 vendor
    |--- autoload.php: This is the file that you include
    |--- composer
           |--- autoload_real.php: Coordinates the autoloader class
           |--- ClassLoader.php: The `ClassLoader` class itself
           |--- autoload_static.php: Opcache-frendly `static` arrays of autoload directives. Requires PHP >= 5.6 && !hhvm
           |--- autoload_psr4.php: `PSR-4` mappings. Only used when `static` is not used.
           |--- autoload_classmap.php: Classmap. Only used when `static` is not used.
           |--- autoload_files.php: Always-include files. Only used when `static` is not used.
           |--- autoload_namespaces.php: Namespace mappings. Only used when `static` is not used.
```

If you use PHP 5.6 or later, only the first 4 files are used, and the last 4 files become dead-code.

This plugin attempts to optimize the autoloader by reorganizing the code:

 - Removes `autoload_psr4.php`, `autoload_classmap.php`, `autoload_files.php`, `autoload_namespaces.php`
 - Moves the `autoload_real.php` logic to `autoload.php` file, and removes `autoload_real.php`
 
With **Composer Min Autoload**, you will get a slightly optimized autoloader:

```
 vendor
    |--- autoload.php: This is the file that you include. Also coordinates ClassLoader class with static list.
    |--- composer
           |--- ClassLoader.php: The `ClassLoader` class itself
           |--- autoload_static.php: Opcache-frendly `static` arrays of autoload directives. Requires PHP >= 5.6 && !hhvm
```



### But, Why?

 - COVID-19 boredom
 - I commit `vendor` directory Git in CI/CF setup, and I'd like slightly smaller diffs.
 - I know that I will never run this code in PHP < 7.4, Zend encoder, or HHVM
 - GitHub stars are cool

### Is it production-ready?

¯\\_(ツ)_/¯

This plugin copies almost entirety of its autoload generator code from Composer itself. Take precautions and run your test suits. You have tests, right? RIGHT?

### How to use

Now we are talking!

```bash
composer require ayesh/composer-min-autoload
composer dump-min-autoload
```

When installed, this will add a new command `dump-min-autoload` to Composer. You can install this plugin globally (hey Satan) by adding `--global` flag to `composer require` command. You can also use `composer dma` that's aliased to the same command.

**`dump-min-autoload` command takes and behaves exactly the same way as `dump-autoload` command. It has same parameters, and inherits `composer.json configuration options.**

### Getting original autoloader

Every time you change packages (require/update/remove), Composer will generate the standard autoloader. You can run `composer dmo` to overwrite with your fancy minimal autoloader.

