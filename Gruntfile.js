module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    less: {
		development: {
			options: {
				paths: ["./less"],
				yuicompress: true,
				sourceMap: true,
      			sourceMapFilename: 'css/pixelgyro-bootstrap.css.map',
      			sourceMapRootpath: '../'
			},
			files: {
				"css/pixelgyro-bootstrap.css": "less/pixelgyro-bootstrap.less"
			}
		}
	},
	watch: {
		files: "./less/*",
		tasks: ["less"]
	}
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Default task(s).
  grunt.registerTask('default', ['watch']);

};