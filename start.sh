#!/bin/bash

cwd=$(pwd)

# Create drupal instance
if [ -d site ]; then
    echo 'site folder found. Not running drush make.'
    cd site
else
    cp nba.make /tmp/
    mkdir site
    chmod +x site
    cd site
    drush make /tmp/nba.make .
fi

# Check tabs_api folder is present.  If not, create symlinks
if [ ! -d sites/all/modules/nbacontent ]; then
    echo "Creating symlinks"

    cd sites/all/modules

    # Setup a symlink to the install profile
    ln -s $cwd/nbaprofile $cwd/site/profiles

    # Setup a symlink to the themes folder
    ln -s $cwd/nbatheme ../themes
    ln -s $cwd/njbatheme ../themes
    ln -s $cwd/nba_theme ../themes

    # Setup a symlink to the modules folder
    ln -s $cwd/nbacontent .
    ln -s $cwd/imageshortcode .
    ln -s $cwd/fb_feed .
    ln -s $cwd/nbaclubs .
    ln -s $cwd/nbaleague .

    cd ../../../
fi

echo "Clearing cache"
drush cc all

echo "Ready to go!"

