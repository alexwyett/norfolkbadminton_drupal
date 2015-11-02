var fs = require('fs');
var _ = require('lodash');

module.exports = function( grunt ) {

  var themes = ['nbatheme', 'njbatheme'];

  // Task configuration
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    watch: {
      scripts: {
        files: ['../nbatheme/less/**/*.less'],
        tasks: ['generate-css'],
        options: {
          spawn: false
        }
      }
    }
  });

  // Task for generating compressed css and sourcemap files
  grunt.registerTask('generate-css', 'Generate css sourcemap files', function() {
    var allTasks = [];
    var tasks = {};

    _.each(themes, function( theme ) {
      var dir = '../' + theme;

      if( fs.existsSync(dir + '/less') ) {
        grunt.file.recurse(dir + '/less', function( abspath, rootdir, subdir, filename ) {
          if( filename.match(/(styles|print)\.less$/g) ) {
              var name = filename.substring(0, filename.lastIndexOf('.'));
              var taskId = theme + '-' + name;

              tasks[taskId] = {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2,
                    sourceMap: true,
                    sourceMapFilename: dir + '/css/' + name + '.map.css',
                    sourceMapURL: name + '.map.css',
                    sourceMapBasepath: dir + '/css',
                    sourceMapRootpath: '/'
                },
                files: {}
              };

              tasks[taskId]['files'][dir + '/css/' + name + '.css'] = abspath;

              allTasks.push('less:' + taskId);
            }
        });

      }
    });

    grunt.config('less', tasks);
    grunt.task.run(allTasks);
  });

  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Default tasks
  grunt.registerTask('default', ['generate-css', 'watch']);

};