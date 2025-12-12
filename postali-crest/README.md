## README ##

When installing theme on WordPress site be sure to do the following:
- Rename the downloaded theme folder from postali-crest-main to just **postali-crest**.
- Download and install required plugins: https://drive.google.com/drive/folders/18we_0hSqLgh6wzwmYK4vcU6U52y9Xkw-?usp=sharing
- Install required ACF JSON: Located in this theme folder under **the acf-json-import-files** folder in root. Download this file to your desktop, then in the WP Admin Dashboard, navigate to the ACF Plugin > Tools and import the file.

Editing the theme:
- Edits can be made directly to the parent theme.
- All JavaScript is complied using Grunt and Sass is compiled using Compass.
- After downloading the theme and opening it up in your development environment, initialize npm in the project terminal and install dependencies.
- Run Grunt Watch --force to activate your JavaScript watcher.
- Run Compass Watch to activate your Sass watcher.
