/*!
 * Gruntfile
 * http://see8ch.com
 * @author Chris Holder
 */

'use strict';

// Grunt Module
module.exports = function (grunt) {

  // Dynamically load npm tasks
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  // Show elapsed time
  require('time-grunt')(grunt);


  // Grunt config
  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),


    // Project Info
    project: {
      assets: 'assets',
      css : 'style.css',
      sass: '<%= project.assets %>/sass/style.scss',
      jsmain : '<%= project.assets %>/js/_main.js',
      jsplugins : '<%= project.assets %>/js/plugins/*.js',
      jsvendor: '<%= project.assets %>/js/vendor/*.js',
      jsconcatSource: [
        '<%= project.jsplugins %>',
        '<%= project.jsmain %>'
      ],
      jsconcatTarget : '<%= project.assets %>/js/scripts.js',
      jsuglifySource: [
        '<%= project.jsvendor %>',
        '<%= project.jsconcatTarget %>'
      ],
      jsuglifyTarget : '<%= project.assets %>/js/scripts.min.js',
      bowerPath : 'bower_components',
      bowerscriptsSource : [
        '<%= project.bowerPath %>/modernizr/modernizr.js',
        '<%= project.bowerPath %>/jquery/dist/jquery.js'
      ],
      bowerscriptsTarget : '<%= project.assets %>/js/vendor/bower.js',
    },



    // Project Banner
    // Dynamically appended to CSS/JS files (Inherits text from package.json)
    tag: {
      banner: '/*\n' +
              ' Theme Name: <%= pkg.themename %>\n' +
              ' Theme URI: <%= pkg.url %>\n' +
              ' Author: <%= pkg.author %>\n' +
              ' Description: <%= pkg.description %>\n' +
              ' Version: <%= pkg.version %>\n' +
              ' Copyright <%= pkg.copyright %>\n' +
              ' Text Domain: <%= pkg.name %>\n' +
              ' */\n'
    },


    // JSHint (https://github.com/gruntjs/grunt-contrib-jshint)
    // Manage the options inside .jshintrc file
    jshint: {
      files: ['<%= project.jsmain %>'],
      options: {
        jshintrc: '.jshintrc'
      }
    },

    // Concatenate JavaScript files (https://github.com/gruntjs/grunt-contrib-concat)
    // Imports all .js files and appends project banner
    concat: {
      dev: {
        files: {
          '<%= project.jsconcatTarget %>' : '<%= project.jsconcatSource %>'
        }
      },
      bowerScripts: {
        files: {
          '<%= project.bowerscriptsTarget %>' : '<%= project.bowerscriptsSource %>'
        }
      },
      options: {
        stripBanners: true,
        nonull: true,
        banner: '<%= tag.banner %>'
      }
    },

    // Uglify JavaScript files (https://github.com/gruntjs/grunt-contrib-uglify)
    // Compresses and minifies all JavaScript files into one
    uglify: {
      options: {
        banner: "<%= tag.banner %>"
      },
      dist: {
        files: {
          '<%= project.jsuglifyTarget %>' : '<%= project.jsuglifySource %>'
        }
      }
    },

    // Compile Sass/SCSS files (https://github.com/gruntjs/grunt-contrib-sass)
    // Compiles all Sass/SCSS files and appends project banner
    sass: {
      dev: {
        options: {
          style: 'expanded',
          banner: '<%= tag.banner %>'
        },
        files: {
          '<%= project.css %>': '<%= project.sass %>'
        }
      },
      dist: {
        options: {
          style: 'compressed',
          banner: '<%= tag.banner %>'
        },
        files: {
          '<%= project.css %>': '<%= project.sass %>'
        }
      }
    },


    // Autoprefixer (https://github.com/nDmitry/grunt-autoprefixer)
    autoprefixer: {
        options: {},
        global: {
            options: {
                // Target-specific options go here.
                // browser-specific info: https://github.com/ai/autoprefixer#browsers
                browsers: ['> 1%', 'last 2 versions', 'ff 17', 'opera 12.1', 'ie 8', 'ie 9']
            },
            src: '<%= project.css %>'
        },
    },


    // Grunt failure notifications (https://github.com/dylang/grunt-notify)
    notify_hooks: {
      options: {
        enabled: true,
        max_jshint_notifications: 5, // maximum number of notifications from jshint output
        title: "<%= pkg.name %>" // defaults to the name in package.json, or will use project directory's name
      }
    },


    // Browser Sync (works with 'watch')
    browserSync: {
        dev: {
            bsFiles: {
                src : '<%= project.css %>'
            },
            options: {
                proxy: "<%= pkg.localhost %>",
                watchTask: true
            }
        }
    },

    // Runs tasks against changed watched files (https://github.com/gruntjs/grunt-contrib-watch)
    // Watching development files and run concat/compile tasks
    watch: {
      concat: {
        files: [
          '<%= project.jsmain %>',
          '<%= project.jsplugins %>',
          '<%= project.bowerPath %>'
        ],
        tasks: ['jshint', 'concat:dev', 'concat:bowerScripts', 'uglify']
      },
      sass: {
        files: '<%= project.assets %>/sass/{,*/}*.{scss,sass}',
        tasks: ['sass:dev', 'autoprefixer']
      }
    }
  });

  // Default Grunt Task
  grunt.registerTask('default', [
    'sass:dev',
    'concat:dev',
    'concat:bowerScripts',
    'uglify',
    'browserSync:dev',
    'watch'
  ]);
};
