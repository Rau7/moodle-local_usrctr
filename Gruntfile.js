// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package    local_usrctr
 * @copyright  2024 Alp Toker <tokeralp@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

module.exports = function(grunt) {
    // We need to include the core Moodle grunt file
    // which includes all the tasks we need
    grunt.initConfig({
        uglify: {
            amd: {
                files: {
                    'amd/build/bootstrap.min.js': ['amd/src/bootstrap.js']
                },
                options: {
                    mangle: false,
                    beautify: true,
                    compress: false,
                    preserveComments: 'some'
                }
            }
        },
        watch: {
            // Watch for any changes to less files and recompile
            amd: {
                files: ["amd/src/**/*.js"],
                tasks: ["amd"]
            }
        }
    });

    // Load contrib tasks
    grunt.loadNpmTasks("grunt-contrib-uglify");
    grunt.loadNpmTasks("grunt-contrib-watch");

    // Register tasks
    grunt.registerTask("default", ["amd"]);
    grunt.registerTask("amd", ["uglify:amd"]);
};
