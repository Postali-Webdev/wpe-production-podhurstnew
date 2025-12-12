module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		jshint: {
			options: {
				force: true
			},
			all: ['js/src/*.js']
		},
		
		// Add new js files from the /js/src/ directory to be compiled as well as what they should be output as
		uglify: {
			min: {
				files: {					

				}
			}
		},

		sass: {
			dist: {
				options: {
					style: 'compressed',
					sourcemap: 'none'
				  },
				  files: { // Dictionary of files // 'destination': 'source'
					'css/styles.css': 'sass/styles.scss',      
				  }
			}
		},

		// This can be run as a watch task which looks for changes to files and compiles in real time
		watch: {
			css: {
				files: ['sass/*.scss'],
				tasks: ['sass'],
			},
			scripts: {
				files: ['js/src/*.js'],
				tasks: ['jshint', 'concat', 'uglify']
			},
		},

	});

	// Load tasks
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// Default task(s).
	grunt.registerTask('default', ['jshint', 'uglify', 'sass']);

};