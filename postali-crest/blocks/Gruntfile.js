module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		jshint: {
			options: {
				force: true
			},
			all: ['assets/js/src/*.js']
		},
		
		// Add new js files from the /assets/js/src/ directory to be compiled as well as what they should be output as
		uglify: {
			min: {
				files: {					
                    'assets/js/accordions.min.js': ['assets/js/src/accordions.js'],
                    'assets/js/accordions-horizontal.min.js': ['assets/js/src/accordions-horizontal.js'],
                    'assets/js/slick-custom.min.js': ['assets/js/src/slick-custom.js'],
                    'assets/js/results-scroller.min.js': ['assets/js/src/results-scroller.js'],
                    'assets/js/process-slider.min.js': ['assets/js/src/process-slider.js'],
                    'assets/js/tabs.min.js': ['assets/js/src/tabs.js'],
                    'assets/js/video-block.min.js': ['assets/js/src/video-block.js'],
                    'assets/js/awards-slider.min.js': ['assets/js/src/awards-slider.js'],
                    'assets/js/countup-custom.min.js': ['assets/js/src/countup-custom.js'],
                    'assets/js/banner-carousel.min.js': ['assets/js/src/banner-carousel.js'],
                    'assets/js/testimonials-scroller.min.js': ['assets/js/src/testimonials-scroller.js'],
                    'assets/js/links-scroller.min.js': ['assets/js/src/links-scroller.js'],
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
					'assets/css/styles.css': 'assets/sass/styles.scss',      
					'assets/css/slick.css': 'assets/sass/slick.scss'
				  }
			}
		},

		// This can be run as a watch task which looks for changes to files and compiles in real time
		watch: {
			css: {
				files: ['assets/sass/*.scss'],
				tasks: ['sass'],
			},
			scripts: {
				files: ['assets/js/src/*.js'],
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