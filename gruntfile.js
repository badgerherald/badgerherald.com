module.exports = function(grunt){
	grunt.initConfig({
		watch:{
			all : {
  			files : ["**/**/*.js","**/**/*.html", "**/**/*.css"],
  			options : { livereload : true }
  			}
		}
	});
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.registerTask('default',['watch']);
}