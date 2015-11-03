module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        less: {
            dev: {
                files: {
                    "web/dist/css/all.css": [
                        "web/less/*.less"
                    ],
                    "web/admin/dist/css/all.css": [
                         "web/admin/less/*.less"
                    ]
                }
            },
            prod: {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2,
                    report: 'gzip'
                },
                files: {
                    "web/dist/css/all.min.css": [
                        "web/less/*.less"
                    ],
                    "web/admin/dist/css/all.css": [
                       "web/admin/less/*.less"
                    ]
                }
            }
        },
        uglify: {
            dev: {
                options: {
                    beautify: true,
                    banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
                        '<%= grunt.template.today("yyyy-mm-dd") %> */\n'
                },
                files: {
                    "web/dist/js/all.js": [
                        "web/js/*.js"
                    ],
                    "web/admin/dist/js/all.js": [
                       "web/admin/js/*.js"
                    ]
                }
            },
            prod: {
                options: {
                    compress: true,
                    banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
                        '<%= grunt.template.today("yyyy-mm-dd") %> */\n'
                },
                files: {
                    "web/dist/js/all.min.js": [
                        "web/js/*.js"
                    ],
                    "web/admin/dist/js/all.min.js": [
                       "web/admin/js/*.js"
                    ]
                }
            }
        },
        watch: {
            files: [
                'web/js/*.js',
                'web/less/*.less',
                'web/admin/js/*.js',
                'web/admin/less/*.less'
            ],
            tasks: ['uglify', 'less']
        }
    });

    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['less', 'uglify']);
    grunt.registerTask('dev', ['less:dev', 'uglify:dev']);
    grunt.registerTask('prod', ['less:prod', 'uglify:prod']);
};