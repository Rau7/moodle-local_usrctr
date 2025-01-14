/**
 * Grunt configuration
 */
module.exports = function(grunt) {
    // Load all grunt tasks.
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.initConfig({
        clean: {
            amd: {
                src: ['amd/build']
            }
        },
        uglify: {
            amd: {
                files: {
                    'amd/build/bootstrap.min.js': ['amd/src/bootstrap.js']
                },
                options: {
                    mangle: false,
                    compress: false,
                    beautify: true
                }
            }
        },
        watch: {
            amd: {
                files: ['amd/src/**/*.js'],
                tasks: ['amd']
            }
        }
    });

    // Register tasks.
    grunt.registerTask('default', ['amd']);
    grunt.registerTask('amd', ['clean:amd', 'uglify:amd']);
});
