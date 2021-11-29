module.exports = (grunt) => {
    /**
    * Project configuration.
    */
    grunt.registerTask('compress-file', 'Minify CSS code and JS code.', () => {

        /**
        * Load NPM tasks.
        */
        grunt.loadNpmTasks('grunt-contrib-cssmin')
        grunt.loadNpmTasks('grunt-contrib-uglify')

        /**
        * Create configuration.
        */
        grunt.initConfig({
            /**
            * Minify CSS code.
            */
            cssmin: {
                options: {
                    level: { 1: { specialComments:0 } }
                },
                main: {
                    files: [{
                        expand:true,
                        cwd:'assets/css_module',
                        src:['*.css'],
                        dest:'build/css',
                        ext:'.min.css'
                    }]
                },
                // joka properti combine dijalankan, maka otomatis di minify
                // combine: {
                //     files: {
                //         'build/css/bundle.min.css': ['assets/css_module/*.css']
                //     }
                // },
            },

            /**
            * Minify JS code.
            */
            uglify: {
                main: {
                    files: [{
                        expand:true,
                        cwd:'assets/js_module',
                        src:['*.js'],
                        dest:'build/js',
                        ext:'.js'
                    }]
                }
            },

            
        })

        /**
        * Run tasks.
        */
        grunt.task.run(['cssmin', 'uglify'])
    })
}