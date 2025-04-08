<?php
namespace Deployer;

require 'recipe/laravel.php';

/*
task('test', function () {
  writeln('Hello world 2');
});*/

// Project name
//set('application', 'mints');
set('application', 'recruiting');
// Project repository
//set('repository','git@github.com:MintsSolutions/recruiting.git');
set('repository','https://abukhaled0401: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@github.com/MintsSolutions/recruiting.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false); 

set('ssh_multiplexing', false);

// overwrite path to php and composer
set('bin/php', 'php');
set('bin/composer', 'composer');

// Number of releases to preserve in releases folder.
set('keep_releases', 5);

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// set composer setting for deploy:vendors task
env('composer_options', 'install --no-dev --verbose --prefer-dist --optimize-autoloader --no-progress --no-interaction --no-scripts');



// Hosts
host('157.230.221.11')
    ->user('abuyazeed')
   // ->password('Mints@123')
    //->identityFile('~/.ssh/y')
  //  ->port(22) 
    ->set('use_sudo', false)
    ->set('bin/php', 'php')
    ->set('bin/composer', 'composer')
   ->set('deploy_path', '/var/www/html/recruiting_test');

  
     

task('build', function () {
    run('cd {{release_path}} && build');

/*
    within('{{release_path}}', function () {
      run('npm run build');   
    });
     
    within('{{release_path}}', function () {
      run('composer run build');   
    });*/
});
//task('deploy:vendors',function(){});



 
// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

//before('deploy:symlink', 'artisan:migrate');
