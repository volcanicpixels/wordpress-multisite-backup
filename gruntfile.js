module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    jshint: {
      gruntfile: {
        src: 'gruntfile.js'
      }
    },
    less: {
      admin: {
        options: {
          sourceMap: true,
          outputSourceFiles: true,
          strictMath: true,
          compress: true
        },
        files: {
          "assets/styles.css": "index.less"
        }
      }
    },
    watch: {
      gruntfile: {
        files: 'gruntfile.js',
        tasks: ['jshint:gruntfile']
      },
      less: {
        files: ['/**/*.less'],
        tasks: ['less']
      }
    }
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');

  // Default task(s).
  grunt.registerTask('default', ['jshint', 'less']);
  grunt.registerTask('test', ['jshint']);

};
